-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-11-2022 a las 02:33:24
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbreservacion2`
--

DELIMITER $$
--
-- Funciones
--
CREATE DEFINER=`root`@`localhost` FUNCTION `GetNroBoletaMax` () RETURNS INT(11) NO SQL BEGIN
Declare Contador int DEFAULT 0;
Select max(idFactura) into Contador from factura;
return Contador;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `NuevoIdBoleta` () RETURNS INT(11)  BEGIN
Declare Contador int DEFAULT 0;

Select max(idFactura) into Contador from factura;
IF (Contador IS NULL) THEN
	set Contador=0;
end if;	
return Contador+1;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `NuevoNroBoleta` () RETURNS VARCHAR(10) CHARSET latin1  BEGIN
Declare Contador int DEFAULT 0;

Select max(right(Numero,8)) into Contador from factura;
IF (Contador IS NULL) THEN
	set Contador=0;
end if;	
return concat('B-',right(concat('00000000',Contador+1),8)) ;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `idCategoria` int(11) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `Descripcion` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idCategoria`, `Nombre`, `Descripcion`) VALUES
(1, 'Sopas y entrada', 'Agua con verduras'),
(2, 'Refrescos', 'Helados y al Tiempo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `idCliente` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Apellido` varchar(50) NOT NULL,
  `DNI` varchar(12) NOT NULL,
  `Telefono` varchar(15) NOT NULL,
  `Direccion` varchar(80) NOT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`idCliente`, `Nombre`, `Apellido`, `DNI`, `Telefono`, `Direccion`, `Email`, `idUsuario`) VALUES
(1, 'Daymer Santos', 'Apaza Maquera Paredes', '73647517', '946659049', 'Av Siglo 0 14', 'yadmer.apaza01@gmail.com', 2),
(2, 'Marco', 'Porras Silva', '73647554', '946659190', 'Av. Florales 123', 'marco.porras@gmail.com', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallepedido`
--

CREATE TABLE `detallepedido` (
  `Pedido_id` int(11) NOT NULL,
  `Producto_id` int(11) NOT NULL,
  `Cantidad` varchar(45) DEFAULT NULL,
  `Observacion` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallesboletas`
--

CREATE TABLE `detallesboletas` (
  `iddetalle` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `pu` decimal(19,7) DEFAULT NULL,
  `subtotal` decimal(19,7) DEFAULT NULL,
  `idboleta` int(11) DEFAULT NULL,
  `idproducto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detallesboletas`
--

INSERT INTO `detallesboletas` (`iddetalle`, `cantidad`, `pu`, `subtotal`, `idboleta`, `idproducto`) VALUES
(6, 3, '2500.0000000', '7500.0000000', 1, 2),
(7, 1, '35.0000000', '35.0000000', 1, 3);

--
-- Disparadores `detallesboletas`
--
DELIMITER $$
CREATE TRIGGER `SetNroBoleta` BEFORE INSERT ON `detallesboletas` FOR EACH ROW begin
	set new.idboleta = GetNroBoletaMax();
 end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `idFactura` int(11) NOT NULL,
  `Numero` int(11) NOT NULL,
  `Fecha` datetime NOT NULL,
  `Subtotal` decimal(19,7) NOT NULL,
  `Total` decimal(19,7) NOT NULL,
  `IGV` int(11) NOT NULL,
  `idPedido` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`idFactura`, `Numero`, `Fecha`, `Subtotal`, `Total`, `IGV`, `idPedido`, `idUsuario`) VALUES
(1, 1, '2022-10-11 20:04:00', '1888888888.0000000', '120.0000000', 20, 1, 1);

--
-- Disparadores `factura`
--
DELIMITER $$
CREATE TRIGGER `NuevaBoleta` BEFORE INSERT ON `factura` FOR EACH ROW begin
	set new.idFactura=NuevoIdBoleta();
    set new.Numero=NuevoNroBoleta();
    set new.fecha=now();
 end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes_producto`
--

CREATE TABLE `imagenes_producto` (
  `idImagen` int(11) NOT NULL,
  `url` varchar(45) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `imagenes_producto`
--

INSERT INTO `imagenes_producto` (`idImagen`, `url`, `idProducto`, `nombre`) VALUES
(1, 'covid.PNG', 1, 'producto covid');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesa`
--

CREATE TABLE `mesa` (
  `idMesa` int(11) NOT NULL,
  `Numero` int(11) NOT NULL,
  `Estado` varchar(12) NOT NULL,
  `Capacidad` int(11) NOT NULL,
  `NroPersonas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `mesa`
--

INSERT INTO `mesa` (`idMesa`, `Numero`, `Estado`, `Capacidad`, `NroPersonas`) VALUES
(1, 1, 'ocupado', 10, 8),
(2, 2, 'libre', 5, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `idPedido` int(11) NOT NULL,
  `Numero` int(11) NOT NULL,
  `Fecha` datetime NOT NULL,
  `Pago` decimal(19,7) NOT NULL,
  `Estado` varchar(20) DEFAULT NULL,
  `idCliente` int(11) NOT NULL,
  `idMesa` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`idPedido`, `Numero`, `Fecha`, `Pago`, `Estado`, `idCliente`, `idMesa`, `idUsuario`) VALUES
(1, 2, '2022-10-10 17:32:39', '120.0000000', 'en proceso', 1, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `idProducto` int(11) NOT NULL,
  `Nombre` varchar(20) NOT NULL,
  `Descripcion` varchar(150) DEFAULT NULL,
  `Cantidad` varchar(45) NOT NULL,
  `Costo` decimal(19,7) NOT NULL,
  `Precio` decimal(19,7) NOT NULL,
  `Estado` varchar(45) NOT NULL,
  `idCategoria` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idProducto`, `Nombre`, `Descripcion`, `Cantidad`, `Costo`, `Precio`, `Estado`, `idCategoria`, `idUsuario`) VALUES
(1, 'Pescado frito', 'lleva pescado frito y papa', '4', '150.0000000', '50.0000000', 'libre', 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva`
--

CREATE TABLE `reserva` (
  `idReserva` int(11) NOT NULL,
  `Fecha` varchar(45) NOT NULL,
  `Estado` varchar(45) NOT NULL,
  `idCliente` int(11) NOT NULL,
  `idMesa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `reserva`
--

INSERT INTO `reserva` (`idReserva`, `Fecha`, `Estado`, `idCliente`, `idMesa`) VALUES
(1, '14/10/2022', 'ocupado', 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipousuario`
--

CREATE TABLE `tipousuario` (
  `idtipoUsuario` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipousuario`
--

INSERT INTO `tipousuario` (`idtipoUsuario`, `Nombre`) VALUES
(1, 'Cliente'),
(2, 'Administrador'),
(3, 'Trabajador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `Nickname` varchar(20) NOT NULL,
  `Contraseña` varchar(20) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `email` varchar(50) NOT NULL,
  `idtipoUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `Nickname`, `Contraseña`, `nombre`, `email`, `idtipoUsuario`) VALUES
(1, 'Daymer', 'daymer123', 'Daymer Maquera', 'yadmer.apaza01@gmail.com', 1),
(2, 'marco', 'marco123', 'Marco Porras', 'marco_porras@gmail.com', 2);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_categorias01`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_categorias01` (
`idProducto` int(11)
,`Nombre` varchar(20)
,`Descripcion` varchar(150)
,`Cantidad` varchar(45)
,`Costo` decimal(19,7)
,`Precio` decimal(19,7)
,`Estado` varchar(45)
,`idCategoria` int(11)
,`name` varchar(30)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_clientes`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_clientes` (
`idCliente` int(11)
,`Nombre` varchar(50)
,`Apellido` varchar(50)
,`DNI` varchar(12)
,`Telefono` varchar(15)
,`Direccion` varchar(80)
,`Email` varchar(50)
,`idUsuario` int(11)
,`Nickname` varchar(20)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_facturas`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_facturas` (
`idFactura` int(11)
,`Numero` int(11)
,`Fecha` datetime
,`Subtotal` decimal(19,7)
,`Total` decimal(19,7)
,`IGV` int(11)
,`idPedido` int(11)
,`idUsuario` int(11)
,`number` int(11)
,`Nickname` varchar(20)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_pedidos`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_pedidos` (
`idPedido` int(11)
,`Numero` int(11)
,`Pago` decimal(19,7)
,`Estado` varchar(20)
,`idCliente` int(11)
,`idMesa` int(11)
,`idUsuario` int(11)
,`Nombre` varchar(50)
,`Number` int(11)
,`Nickname` varchar(20)
,`Fecha` datetime
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_productos`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_productos` (
`idProducto` int(11)
,`Nombre` varchar(20)
,`Descripcion` varchar(150)
,`Cantidad` varchar(45)
,`Costo` decimal(19,7)
,`Precio` decimal(19,7)
,`Estado` varchar(45)
,`idCategoria` int(11)
,`name` varchar(30)
,`url` varchar(45)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_reservas`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_reservas` (
`idReserva` int(11)
,`Fecha` varchar(45)
,`Estado` varchar(45)
,`idCliente` int(11)
,`idMesa` int(11)
,`Nombre` varchar(50)
,`Numero` int(11)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_usuarios`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_usuarios` (
`idUsuario` int(11)
,`Nickname` varchar(20)
,`Contraseña` varchar(20)
,`nombre` varchar(45)
,`email` varchar(50)
,`idtipoUsuario` int(11)
,`name1` varchar(50)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `v_categorias01`
--
DROP TABLE IF EXISTS `v_categorias01`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_categorias01`  AS SELECT `producto`.`idProducto` AS `idProducto`, `producto`.`Nombre` AS `Nombre`, `producto`.`Descripcion` AS `Descripcion`, `producto`.`Cantidad` AS `Cantidad`, `producto`.`Costo` AS `Costo`, `producto`.`Precio` AS `Precio`, `producto`.`Estado` AS `Estado`, `producto`.`idCategoria` AS `idCategoria`, `categoria`.`Nombre` AS `name` FROM (`producto` join `categoria` on(`producto`.`idCategoria` = `categoria`.`idCategoria`))  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_clientes`
--
DROP TABLE IF EXISTS `v_clientes`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_clientes`  AS SELECT `cliente`.`idCliente` AS `idCliente`, `cliente`.`Nombre` AS `Nombre`, `cliente`.`Apellido` AS `Apellido`, `cliente`.`DNI` AS `DNI`, `cliente`.`Telefono` AS `Telefono`, `cliente`.`Direccion` AS `Direccion`, `cliente`.`Email` AS `Email`, `cliente`.`idUsuario` AS `idUsuario`, `usuario`.`Nickname` AS `Nickname` FROM (`cliente` join `usuario` on(`cliente`.`idUsuario` = `usuario`.`idUsuario`))  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_facturas`
--
DROP TABLE IF EXISTS `v_facturas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_facturas`  AS SELECT `factura`.`idFactura` AS `idFactura`, `factura`.`Numero` AS `Numero`, `factura`.`Fecha` AS `Fecha`, `factura`.`Subtotal` AS `Subtotal`, `factura`.`Total` AS `Total`, `factura`.`IGV` AS `IGV`, `factura`.`idPedido` AS `idPedido`, `factura`.`idUsuario` AS `idUsuario`, `pedido`.`Numero` AS `number`, `usuario`.`Nickname` AS `Nickname` FROM ((`factura` join `pedido` on(`factura`.`idPedido` = `pedido`.`idPedido`)) join `usuario` on(`factura`.`idUsuario` = `usuario`.`idUsuario`))  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_pedidos`
--
DROP TABLE IF EXISTS `v_pedidos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pedidos`  AS SELECT `pedido`.`idPedido` AS `idPedido`, `pedido`.`Numero` AS `Numero`, `pedido`.`Pago` AS `Pago`, `pedido`.`Estado` AS `Estado`, `pedido`.`idCliente` AS `idCliente`, `pedido`.`idMesa` AS `idMesa`, `pedido`.`idUsuario` AS `idUsuario`, `cliente`.`Nombre` AS `Nombre`, `mesa`.`Numero` AS `Number`, `usuario`.`Nickname` AS `Nickname`, `pedido`.`Fecha` AS `Fecha` FROM (((`pedido` join `cliente` on(`pedido`.`idCliente` = `cliente`.`idCliente`)) join `mesa` on(`pedido`.`idMesa` = `mesa`.`idMesa`)) join `usuario` on(`pedido`.`idMesa` = `usuario`.`idUsuario`))  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_productos`
--
DROP TABLE IF EXISTS `v_productos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_productos`  AS SELECT `producto`.`idProducto` AS `idProducto`, `producto`.`Nombre` AS `Nombre`, `producto`.`Descripcion` AS `Descripcion`, `producto`.`Cantidad` AS `Cantidad`, `producto`.`Costo` AS `Costo`, `producto`.`Precio` AS `Precio`, `producto`.`Estado` AS `Estado`, `producto`.`idCategoria` AS `idCategoria`, `categoria`.`Nombre` AS `name`, `imagenes_producto`.`url` AS `url` FROM ((`producto` join `categoria` on(`producto`.`idCategoria` = `categoria`.`idCategoria`)) left join `imagenes_producto` on(`imagenes_producto`.`idProducto` = `producto`.`idProducto`))  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_reservas`
--
DROP TABLE IF EXISTS `v_reservas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_reservas`  AS SELECT `reserva`.`idReserva` AS `idReserva`, `reserva`.`Fecha` AS `Fecha`, `reserva`.`Estado` AS `Estado`, `reserva`.`idCliente` AS `idCliente`, `reserva`.`idMesa` AS `idMesa`, `cliente`.`Nombre` AS `Nombre`, `mesa`.`Numero` AS `Numero` FROM ((`reserva` join `cliente` on(`reserva`.`idCliente` = `cliente`.`idCliente`)) join `mesa` on(`reserva`.`idMesa` = `mesa`.`idMesa`))  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_usuarios`
--
DROP TABLE IF EXISTS `v_usuarios`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_usuarios`  AS SELECT `usuario`.`idUsuario` AS `idUsuario`, `usuario`.`Nickname` AS `Nickname`, `usuario`.`Contraseña` AS `Contraseña`, `usuario`.`nombre` AS `nombre`, `usuario`.`email` AS `email`, `usuario`.`idtipoUsuario` AS `idtipoUsuario`, `tipousuario`.`Nombre` AS `name1` FROM (`usuario` join `tipousuario` on(`usuario`.`idtipoUsuario` = `tipousuario`.`idtipoUsuario`))  ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idCategoria`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idCliente`),
  ADD KEY `fk_Clientes_Usuario_idx` (`idUsuario`);

--
-- Indices de la tabla `detallepedido`
--
ALTER TABLE `detallepedido`
  ADD PRIMARY KEY (`Pedido_id`,`Producto_id`),
  ADD KEY `fk_Pedido_has_Producto_Producto1_idx` (`Producto_id`),
  ADD KEY `fk_Pedido_has_Producto_Pedido1_idx` (`Pedido_id`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`idFactura`),
  ADD KEY `fk_Factura_Pedido1_idx` (`idPedido`),
  ADD KEY `fk_Factura_Usuario1_idx` (`idUsuario`);

--
-- Indices de la tabla `imagenes_producto`
--
ALTER TABLE `imagenes_producto`
  ADD PRIMARY KEY (`idImagen`);

--
-- Indices de la tabla `mesa`
--
ALTER TABLE `mesa`
  ADD PRIMARY KEY (`idMesa`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`idPedido`),
  ADD KEY `fk_Pedido_Cliente1_idx` (`idCliente`),
  ADD KEY `fk_Pedido_Mesa1_idx` (`idMesa`),
  ADD KEY `fk_Pedido_Usuario1_idx` (`idUsuario`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`idProducto`),
  ADD KEY `fk_Producto_Categoria1_idx` (`idCategoria`),
  ADD KEY `fk_Producto_Usuario1_idx` (`idUsuario`);

--
-- Indices de la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`idReserva`),
  ADD KEY `fk_Reserva_Cliente1_idx` (`idCliente`),
  ADD KEY `fk_Reserva_Mesa1_idx` (`idMesa`);

--
-- Indices de la tabla `tipousuario`
--
ALTER TABLE `tipousuario`
  ADD PRIMARY KEY (`idtipoUsuario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `fk_tipousuario` (`idtipoUsuario`) USING BTREE;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `fk_Clientes_Usuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detallepedido`
--
ALTER TABLE `detallepedido`
  ADD CONSTRAINT `fk_Pedido_has_Producto_Pedido1` FOREIGN KEY (`Pedido_id`) REFERENCES `pedido` (`idPedido`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Pedido_has_Producto_Producto1` FOREIGN KEY (`Producto_id`) REFERENCES `producto` (`idProducto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `fk_Factura_Pedido1` FOREIGN KEY (`idPedido`) REFERENCES `pedido` (`idPedido`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Factura_Usuario1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `fk_Pedido_Cliente1` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`idCliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Pedido_Mesa1` FOREIGN KEY (`idMesa`) REFERENCES `mesa` (`idMesa`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Pedido_Usuario1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `fk_Producto_Categoria1` FOREIGN KEY (`idCategoria`) REFERENCES `categoria` (`idCategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Producto_Usuario1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `fk_Reserva_Cliente1` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`idCliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Reserva_Mesa1` FOREIGN KEY (`idMesa`) REFERENCES `mesa` (`idMesa`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_tipo_usuario` FOREIGN KEY (`idtipoUsuario`) REFERENCES `tipousuario` (`idtipoUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
