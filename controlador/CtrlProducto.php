<?php
require_once SYS . DIRECTORY_SEPARATOR . 'Controlador.php';
require_once MOD .DIRECTORY_SEPARATOR . 'Producto.php';
require_once MOD .DIRECTORY_SEPARATOR . 'Mesa.php';
require_once MOD .DIRECTORY_SEPARATOR . 'Carrito.php';
require_once REC . DIRECTORY_SEPARATOR . 'Libreria.php';
/*
* Clase CtrlCiudad
*/
class CtrlProducto extends Controlador {
    
    public function index($msg=array('titulo'=>'','cuerpo'=>'')){
        $menu= Libreria::getMenu();
        $migas = array(
            '?'=>'Inicio',
        );

        $obj = new Producto();
        $resultado = $obj->leer();
       // var_dump($resultado);exit();
        $datos = array(
            'titulo'=>"Productos",
            'contenido'=>Vista::mostrar('producto/mostrar.php',$resultado,true),
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
            '?ctrl=CtrlProducto'=>'Listado',
            '#'=>'Nuevo',
        );
        $obj = new Producto();
        $datos1=array(
            'encabezado'=>'Nueva Producto',
            'producto'=>$obj
            );

        $datos = array(
                'titulo'=>'Nuevo Producto',
                'contenido'=>Vista::mostrar('producto/frmNuevo.php',$datos1,true),
                'menu'=>$menu,
                'migas'=>$migas,
                'msg'=>$msg,
                'cssGbl'=>Libreria::cssGlobales(),
                'jsGbl'=>Libreria::jsGlobales()
            );
        //var_dump ($sql);exit();
        $this->mostrarVista('template.php',$datos);
        //var_dump ($sql);exit();
    }

    public function guardarNuevo(){
        $obj = new Producto (
                $_POST["idProducto"],
                $_POST["Nombre"],
                $_POST["Descripcion"],
                $_POST["Cantidad"],
                $_POST["Costo"],
                $_POST["Pu"],
                $_POST["Estado"],
                $_POST["categoria"],
                );
        $respuesta=$obj->nuevo();
        $this->index($respuesta['msg']);
        // var_dump ($sql);exit();
    }
    public function eliminar(){
        if (isset($_REQUEST['idProducto'])) {
            $obj = new Producto($_REQUEST['idProducto']);
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
            'cuerpo'=>'Iniciando edición para: '.$_REQUEST['idProducto']);
        $migas = array(
            '?'=>'Inicio',
            '?ctrl=CtrlProducto'=>'Listado',
            '#'=>'Editar',
        );
        if (isset($_REQUEST['idProducto'])) {
            $obj = new Producto($_REQUEST['idProducto']);
            $miObj = $obj->leerUno();
            if (is_null($miObj['data'])) {
                $this->index(array(
                    'titulo'=>'Error',
                    'cuerpo'=>'ID Requerido: '.$_REQUEST['idProducto']. ' No Existe')
                );
            }else{
                $datos1 = array(
                        'producto'=>$obj
                    );

                $datos = array(
                    'titulo'=>'Editando Ciudad: '. $_REQUEST['idProducto'],
                    'contenido'=>Vista::mostrar('producto/frmEditar.php',$datos1,true),
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
        $obj = new Producto (
                $_POST["idProducto"],    #El id que enviamos
                $_POST["Nombre"],
                $_POST["Descripcion"],
                $_POST["Cantidad"],
                $_POST["Costo"],
                $_POST["Pu"],
                $_POST["Estado"],
                $_POST["categoria"],
                );

        //var_dump($obj->leerUno());exit();
        $respuesta=$obj->editar();
        
        $this->index($respuesta['msg']);
    }
    public function getProductoesSelect(){
        $idProducto = $_GET['idProducto'];
        $obj = new Producto();
        $datos = $obj->leerXPais($idProducto)['data'];
        $html = '<option value="0">Seleccionar...</option>';
        foreach ($datos as $d) {
            $html .= '<option value="'.$d['idProducto'].'">'.$d['Nombre'].'</option>';
        }
        echo $html;
    }
    public function getCatalogo(){
        $menu= Libreria::getMenu();
        $migas = array(
            '?'=>'Inicio',
            '#'=>'Catálogo',
        );

        $obj = new Producto();
        $resultado = $obj->leer();

        $obj= new Mesa();
        $resultado1 = $obj->leer();
        $data = array(
            'productos'=> $resultado['data'],
            'mesas'=> $resultado1['data']
        );
        //var_dump($data);exit();
        $msg=array(!isset($_GET['idProducto']))?array('titulo'=>'','cuerpo'=>''):array('titulo'=>'Nuevo elemento','cuerpo'=>'Se agregó un elemento al Carrito');
        $datos = array(
            'titulo'=>"Catálogo",
            'contenido'=>Vista::mostrar('producto/catalogo.php',$data,true),
            'menu'=>$menu,
            'migas'=>$migas,
            'msg'=>$msg,
            'cssGbl'=>Libreria::cssGlobales(),
            'jsGbl'=>Libreria::jsGlobales()
        );
        
        $this->mostrarVista('template.php',$datos);
    }
    public function verDetalles(){
        $menu= Libreria::getMenu();
        $migas = array(
            '?'=>'Inicio',
            '?ctrl=CtrlProducto&accion=getCatalogo'=>'Catálogo',
            '#'=>'Detalles',
        );
        $idProducto = $_GET['idProducto'];
        $jsVista = array(
                array(
                'url'=>'recursos/js/jsImagenes.js'
                )
            );

        $obj = new Producto($idProducto);
        $resultado = $obj->getDetalles();
       // var_dump($resultado);exit();
        $msg=array('titulo'=>'','cuerpo'=>'');
        $datos = array(
            'titulo'=>"Detalles",
            'contenido'=>Vista::mostrar('producto/detalles.php',$resultado,true),
            'menu'=>$menu,
            'migas'=>$migas,
            'msg'=>$msg,
            'js'=>$jsVista,
            'cssGbl'=>Libreria::cssGlobales(),
            'jsGbl'=>Libreria::jsGlobales()
        );
        
        $this->mostrarVista('template.php',$datos);
    }
}