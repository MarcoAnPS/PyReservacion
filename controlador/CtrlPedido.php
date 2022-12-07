<?php
require_once SYS . DIRECTORY_SEPARATOR . 'Controlador.php';
require_once MOD .DIRECTORY_SEPARATOR . 'Producto.php';
require_once MOD .DIRECTORY_SEPARATOR . 'Pedido.php';
require_once MOD .DIRECTORY_SEPARATOR . 'Carrito.php';
require_once REC . DIRECTORY_SEPARATOR . 'Libreria.php';
/*
* Clase CtrlCiudad
*/
class CtrlPedido extends Controlador {
    
    public function index($msg=''){
        $menu= Libreria::getMenu();
        $migas = array(
            '?'=>'Inicio',
        );

        $obj = new Pedido();
        $resultado = $obj->leer();

        $datos = array(
            'titulo'=>"Pedidos",
            'contenido'=>Vista::mostrar('pedido/mostrar.php',$resultado,true),
            'menu'=>$menu,
            'migas'=>$migas,
            'msg'=>$msg,
            'cssGbl'=>Libreria::cssGlobales(),
            'jsGbl'=>Libreria::jsGlobales()
        );
        //var_dump($obj->leerUno());exit();
        $this->mostrarVista('template.php',$datos);
    }
    public function nuevo(){
        $menu = Libreria::getMenu();
        $msg= array(
            'titulo'=>'Nuevo...',
            'cuerpo'=>'Ingrese información para nueva Ciudad');
        $migas = array(
            '?'=>'Inicio',
            '?ctrl=CtrlPedido'=>'Listado',
            '#'=>'Nuevo',
        );
        $obj = new Pedido();
        $datos1=array(
            'encabezado'=>'Nueva Pedido',
            'pedido'=>$obj
            );

        $datos = array(
                'titulo'=>'Nuevo Pedido',
                'contenido'=>Vista::mostrar('pedido/frmNuevo.php',$datos1,true),
                'menu'=>$menu,
                'migas'=>$migas,
                'msg'=>$msg,
                'cssGbl'=>Libreria::cssGlobales(),
            'jsGbl'=>Libreria::jsGlobales()
            );
        //var_dump ($sql);exit();
        $this->mostrarVista('template.php',$datos);
    }

    public function guardarNuevo(){
        $obj = new Pedido (
                $_POST["idPedido"],
                $_POST["Numero"],
                $_POST["Fecha"],
                $_POST["Pago"],
                $_POST["Estado"],
                $_POST["cliente"],
                $_POST["mesa"],
                $_POST["usuario"],
                );
        $respuesta=$obj->nuevo();

        $this->index($respuesta['msg']);
    }
    public function guardarNuevoPedido(){
        $obj = new Producto();
        $data=$obj->getProductosCarrito();
        $total=0;
        $datosDetalle=null;
        //var_dump($data);exit(); 
        foreach ($data['data'] as $p) {
            $cant = $_SESSION['carrito']->getCantidad($p['idProducto']);
            $pu = $p['Pu'];
            $subTotal = $cant * $pu;
            
            $datosDetalle[]=array(
                'Cantidad'=>$cant,
                'Pu'=>$pu,
                'Subtotal'=>$subTotal,
                'idProducto'=>$p['idProducto']
                );
            $total += $cant * $pu;
        }
        //var_dump($_SESSION);exit();
        $obj = new Pedido();
        $obj->nuevo($total, $_SESSION['id'],$datosDetalle);

        $this->registrarReserva();
    }

    public function registrarReserva(){
        $obj = new Pedido();
        $data=$obj->getUltimoPedidoCliente($_SESSION['id']);

        $menu= Libreria::getMenu();
        $migas = array(
            '?'=>'Inicio',
        );
        // $datosGraf= $this->getGraficoModelosXMarcas();
        unset($_SESSION['carrito']);
        
        $datos = array(
            'titulo'=>"Registro de Reserva Realizado",
            'contenido'=>Vista::mostrar('pedido/registroPedido.php',$data,true),
            'menu'=>$menu,
            'migas'=>$migas,
            'msg'=>array(
                    'titulo'=>'',
                    'cuerpo'=>''
            ),
            
            'cssGbl'=>Libreria::cssGlobales(),
            'jsGbl'=>Libreria::jsGlobales()
        );
        
        $this->mostrarVista('template.php',$datos);

    }

    public function imprimir(){
        $obj = new Pedido();
        $data=$obj->getUltimaFacPeDetalleCliente($_SESSION['id']);
        Vista::mostrar('pedido/facPedido.php',$data);
    }

    public function eliminar(){
        if (isset($_REQUEST['idPedido'])) {
            $obj = new Pedido($_REQUEST['idPedido']);
            $resultado=$obj->eliminar();
            $this->index($resultado['msg']);
        } else {
            echo "...El Id a ELIMINAR es requerido";
        }
    }
    public function editar(){
        #Mostramos el Formulario de Editar
        $menu = Libreria::getMenu();
        $msg= array(
            'titulo'=>'Editando...',
            'cuerpo'=>'Iniciando edición para: '.$_REQUEST['idPedido']);
        $migas = array(
            '?'=>'Inicio',
            '?ctrl=CtrlProducto'=>'Listado',
            '#'=>'Editar',
        );
        if (isset($_REQUEST['idPedido'])) {
            $obj = new Pedido($_REQUEST['idPedido']);
            $miObj = $obj->leerUno();
            if (is_null($miObj['data'])) {
                $this->index(array(
                    'titulo'=>'Error',
                    'cuerpo'=>'ID Requerido: '.$_REQUEST['idPedido']. ' No Existe')
                );
            }else{

                $datos1 = array(
                        'pedido'=>$obj
                    );

                $datos = array(
                    'titulo'=>'Editando Ciudad: '. $_REQUEST['idPedido'],
                    'contenido'=>Vista::mostrar('pedido/frmEditar.php',$datos1,true),
                    'menu'=>$menu,
                    'migas'=>$migas,
                    'msg'=>$msg,
                    'cssGbl'=>Libreria::cssGlobales(),
                    'jsGbl'=>Libreria::jsGlobales()
                );
            }
        }else {
            $msg= array(
            'titulo'=>'Error',
            'cuerpo'=>'No se encontró al ID requerido');

            $datos = array(
                'titulo'=>'Editando Ciudad... DESCONOCIDO',
                'contenido'=>'...El Id a Editar es requerido',
                'menu'=>$menu,
                'migas'=>$migas,
                'msg'=>$msg);
        }
        
        $this->mostrarVista('template.php',$datos);

        
    }
    public function guardarEditar(){
        $obj = new Pedido (
                $_POST["idPedido"],    #El id que enviamos
                $_POST["Numero"],
                $_POST["Fecha"],
                $_POST["Pago"],
                $_POST["Estado"],
                $_POST["cliente"],
                $_POST["mesa"],
                $_POST["usuario"],
                );

        //var_dump($obj->leerUno());exit();
        $respuesta=$obj->editar();
        
        $this->index($respuesta['msg']);
    }
}