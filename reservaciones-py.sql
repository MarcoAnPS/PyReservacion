-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-12-2022 a las 01:34:59
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `reservaciones-py`
--

DELIMITER $$
--
-- Funciones
--
CREATE DEFINER=`root`@`localhost` FUNCTION `GetNroPedidoMax` () RETURNS INT(11) NO SQL BEGIN
Declare Contador int DEFAULT 0;
Select max(idPedido) into Contador from Pedido;
return Contador;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `idPedidoCliente` (`id` INT) RETURNS INT(11)  BEGIN
DECLARE contador int;

Select max(p.idPedido) into contador from pedido p
WHERE p.idCliente=id;

RETURN contador;

END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `NuevoIdPedido` () RETURNS INT(11)  BEGIN
Declare Contador int DEFAULT 0;

Select max(idPedido) into Contador from pedido;
IF (Contador IS NULL) THEN
	set Contador=0;
end if;	
return Contador+1;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `NuevoNroPedido` () RETURNS VARCHAR(10) CHARSET latin1  BEGIN
Declare Contador int DEFAULT 0;

Select max(right(Numero,8)) into Contador from pedido;
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
(1, 'Sopas y entrada', 'Lleva una variedad de papas y ajis'),
(2, 'Bebidas', 'Bebidas Frias');

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
(1, 'Daymer', 'Apaza Maquera', '73647517', '946659049', 'Av Siglo 0 14', 'valeria.luz@gmail.com', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallepedido`
--

CREATE TABLE `detallepedido` (
  `iddetallepedido` int(11) NOT NULL,
  `Cantidad` varchar(45) DEFAULT NULL,
  `idPedido` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `Pu` decimal(19,7) DEFAULT NULL,
  `Subtotal` decimal(19,7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Disparadores `detallepedido`
--
DELIMITER $$
CREATE TRIGGER `SetNroPedido` BEFORE INSERT ON `detallepedido` FOR EACH ROW begin
	set new.idPedido = GetNroPedidoMax();
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
  `nombre` varchar(100) NOT NULL,
  `idProducto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `imagenes_producto`
--

INSERT INTO `imagenes_producto` (`idImagen`, `url`, `nombre`, `idProducto`) VALUES
(1, 'covid.PNG', 'Producto covid', 1);

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
(1, 1, 'libre', 5, 5),
(2, 2, 'libre', 5, 0),
(3, 3, 'libre', 8, 0),
(4, 4, 'ocupado', 10, 0),
(5, 5, 'ocupado', 126, 0);

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
  `idUsuario` int(11) NOT NULL,
  `NumeroFac` varchar(45) DEFAULT NULL,
  `FechaFac` datetime DEFAULT NULL,
  `Total` decimal(19,7) DEFAULT NULL,
  `IGV` decimal(19,7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Disparadores `pedido`
--
DELIMITER $$
CREATE TRIGGER `NuevoPedido` BEFORE INSERT ON `pedido` FOR EACH ROW begin
	set new.idPedido=NuevoIdPedido();
    set new.Numero=NuevoNroPedido();
    set new.FechaFac=now();
 end
$$
DELIMITER ;

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
  `Pu` decimal(19,7) NOT NULL,
  `Estado` varchar(45) NOT NULL,
  `idCategoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idProducto`, `Nombre`, `Descripcion`, `Cantidad`, `Costo`, `Pu`, `Estado`, `idCategoria`) VALUES
(1, 'Aji de gallina', 'Lleva una variedad de papas y ajis', '3', '20.0000000', '51.0000000', 'completo', 1),
(2, 'Caldo de Pollo', 'Pollo de granja', '3', '50.0000000', '20.0000000', 'completo', 1),
(3, 'Arroz con leche', 'leche de vaca', '12', '15.0000000', '8.0000000', 'libre', 2);

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
(1, 'Administrador'),
(2, 'Cliente'),
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
  `Estado` varchar(1) NOT NULL,
  `idtipoUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `Nickname`, `Contraseña`, `nombre`, `email`, `Estado`, `idtipoUsuario`) VALUES
(1, 'Daymer', 'daymer123', 'Daymer Maquera', 'Daymer@gmail.com', '1', 2),
(2, 'Valeria', 'valeria123', 'Valeria   Luz Valdivia Herrera', 'valerialuz@gmail.com', '1', 1),
(3, 'Jenny', 'jenny123', 'Jenny Glenda', 'Jenny@gmail.com', '1', 3),
(13, 'jhonatan', '123456', 'jhonatan duran', 'yadmer.apaza01@gmail.com', '1', 2);

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
,`Pu` decimal(19,7)
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
-- Estructura Stand-in para la vista `v_graf_modelos_x_marca`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_graf_modelos_x_marca` (
`Categorias` varchar(30)
,`Cantidad` bigint(21)
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
,`Pu` decimal(19,7)
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
,`Estado` varchar(1)
,`idtipoUsuario` int(11)
,`tipo` varchar(50)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `v_categorias01`
--
DROP TABLE IF EXISTS `v_categorias01`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_categorias01`  AS SELECT `producto`.`idProducto` AS `idProducto`, `producto`.`Nombre` AS `Nombre`, `producto`.`Descripcion` AS `Descripcion`, `producto`.`Cantidad` AS `Cantidad`, `producto`.`Costo` AS `Costo`, `producto`.`Pu` AS `Pu`, `producto`.`Estado` AS `Estado`, `producto`.`idCategoria` AS `idCategoria`, `categoria`.`Nombre` AS `name` FROM (`producto` join `categoria` on(`producto`.`idCategoria` = `categoria`.`idCategoria`))  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_clientes`
--
DROP TABLE IF EXISTS `v_clientes`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_clientes`  AS SELECT `cliente`.`idCliente` AS `idCliente`, `cliente`.`Nombre` AS `Nombre`, `cliente`.`Apellido` AS `Apellido`, `cliente`.`DNI` AS `DNI`, `cliente`.`Telefono` AS `Telefono`, `cliente`.`Direccion` AS `Direccion`, `cliente`.`Email` AS `Email`, `cliente`.`idUsuario` AS `idUsuario`, `usuario`.`Nickname` AS `Nickname` FROM (`cliente` join `usuario` on(`cliente`.`idUsuario` = `usuario`.`idUsuario`))  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_graf_modelos_x_marca`
--
DROP TABLE IF EXISTS `v_graf_modelos_x_marca`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_graf_modelos_x_marca`  AS SELECT `categoria`.`Nombre` AS `Categorias`, count(`producto`.`idProducto`) AS `Cantidad` FROM (`categoria` join `producto` on(`categoria`.`idCategoria` = `producto`.`idCategoria`)) GROUP BY `categoria`.`Nombre``Nombre`  ;

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

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_productos`  AS SELECT `producto`.`idProducto` AS `idProducto`, `producto`.`Nombre` AS `Nombre`, `producto`.`Descripcion` AS `Descripcion`, `producto`.`Cantidad` AS `Cantidad`, `producto`.`Costo` AS `Costo`, `producto`.`Pu` AS `Pu`, `producto`.`Estado` AS `Estado`, `producto`.`idCategoria` AS `idCategoria`, `categoria`.`Nombre` AS `name`, `imagenes_producto`.`url` AS `url` FROM ((`producto` join `categoria` on(`producto`.`idCategoria` = `categoria`.`idCategoria`)) left join `imagenes_producto` on(`imagenes_producto`.`idProducto` = `producto`.`idProducto`))  ;

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

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_usuarios`  AS SELECT `usuario`.`idUsuario` AS `idUsuario`, `usuario`.`Nickname` AS `Nickname`, `usuario`.`Contraseña` AS `Contraseña`, `usuario`.`nombre` AS `nombre`, `usuario`.`email` AS `email`, `usuario`.`Estado` AS `Estado`, `usuario`.`idtipoUsuario` AS `idtipoUsuario`, `tipousuario`.`Nombre` AS `tipo` FROM (`usuario` join `tipousuario` on(`usuario`.`idtipoUsuario` = `tipousuario`.`idtipoUsuario`))  ;

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
  ADD PRIMARY KEY (`iddetallepedido`),
  ADD KEY `fk_detallepedido_pedido1_idx` (`idPedido`),
  ADD KEY `fk_detallepedido_producto1_idx` (`idProducto`);

--
-- Indices de la tabla `imagenes_producto`
--
ALTER TABLE `imagenes_producto`
  ADD PRIMARY KEY (`idImagen`),
  ADD KEY `fk_imagenes_producto_producto1_idx` (`idProducto`);

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
  ADD KEY `fk_Producto_Categoria1_idx` (`idCategoria`);

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
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `idCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `detallepedido`
--
ALTER TABLE `detallepedido`
  MODIFY `iddetallepedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `imagenes_producto`
--
ALTER TABLE `imagenes_producto`
  MODIFY `idImagen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `mesa`
--
ALTER TABLE `mesa`
  MODIFY `idMesa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `idPedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `idProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `reserva`
--
ALTER TABLE `reserva`
  MODIFY `idReserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tipousuario`
--
ALTER TABLE `tipousuario`
  MODIFY `idtipoUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
  ADD CONSTRAINT `fk_detallepedido_pedido1` FOREIGN KEY (`idPedido`) REFERENCES `pedido` (`idPedido`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detallepedido_producto1` FOREIGN KEY (`idProducto`) REFERENCES `producto` (`idProducto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `imagenes_producto`
--
ALTER TABLE `imagenes_producto`
  ADD CONSTRAINT `fk_imagenes_producto_producto1` FOREIGN KEY (`idProducto`) REFERENCES `producto` (`idProducto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `fk_Producto_Categoria1` FOREIGN KEY (`idCategoria`) REFERENCES `categoria` (`idCategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
