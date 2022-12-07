<?php
require_once SYS . DIRECTORY_SEPARATOR . 'Controlador.php';
require_once MOD .DIRECTORY_SEPARATOR . 'Categoria.php';
require_once MOD .DIRECTORY_SEPARATOR . 'Carrito.php';
require_once REC . DIRECTORY_SEPARATOR . 'Libreria.php';
/*
* Clase CtrlPais
*/
class CtrlCategoria extends Controlador {
    
    public function index($msg=array('titulo'=>'','cuerpo'=>'')){
        if(!isset($_SESSION['nombre'])){
            header("Location: ?");
            exit();
        }
        $menu= Libreria::getMenu();
        $migas = array(
            '?'=>'Inicio',
            '#'=>'Listado'
        );

        $obj = new Categoria();
        $resultado = $obj->leer();
        //var_dump($resultado);exit();
        $datos = array(
            'titulo'=>"Categorias",
            'contenido'=>Vista::mostrar('categoria/mostrar.php',$resultado,true),
            'menu'=>$menu,
            'migas'=>$migas,
            'msg'=>$msg,
            'cssGbl'=>Libreria::cssGlobales(),
            'jsGbl'=>Libreria::jsGlobales(),
            'data'=>$resultado['data']
        );
        
        
        $this->mostrarVista('template.php',$datos);
    }
    public function nuevo(){
        if(!isset($_SESSION['nombre'])){
            header("Location: ?");
            exit();
        }
        echo Vista::mostrar('categoria/frmNuevo.php');
    }

    public function guardarNuevo(){
        if(!isset($_SESSION['nombre'])){
            header("Location: ?");
            exit();
        }
        $obj = new Categoria (
                $_POST["id"],
                $_POST["Nombre"],
                $_POST["Descripcion"],
                );
        $respuesta=$obj->nuevo();

        $this->index($respuesta['msg']);
    }
    public function eliminar(){
        if(!isset($_SESSION['nombre'])){
            header("Location: ?");
            exit();
        }
        if (isset($_REQUEST['id'])) {
            $obj = new Categoria($_REQUEST['id']);
            $resultado=$obj->eliminar();
            $this->index($resultado['msg']);
        } else {
            echo "...El Id a ELIMINAR es requerido";
        }
    }
    public function editar(){
        #Mostramos el Formulario de Editar
        if(!isset($_SESSION['nombre'])){
            header("Location: ?");
            exit();
        }
        $datos=null;
        $menu = Libreria::getMenu();
        
        $migas = array(
            '?'=>'Inicio',
            '?ctrl=CtrCategoria'=>'Listado',
            '#'=>'Editar',
            'cssGbl'=>Libreria::cssGlobales(),
            'jsGbl'=>Libreria::jsGlobales(),
        );
        if (isset($_REQUEST['id'])) {

            $obj = new Categoria($_REQUEST['id']);
            $miObj = $obj->leerUno();
            // var_dump($obj->leerUno());exit();
            $datos1 = array(
                'categoria'=>$obj
            );
            echo Vista::mostrar('categoria/frmEditar.php',$datos1);
            
        }
        
        
    }
    public function guardarEditar(){
        if(!isset($_SESSION['nombre'])){
            header("Location: ?");
            exit();
        }
        $obj = new Categoria (
                $_POST["id"],    #El id que enviamos
                $_POST["Nombre"],
                $_POST["Descripcion"],
                );
        $respuesta=$obj->editar();
        
        $this->index($respuesta['msg']);
    }
    public function reporte()
    {
        $obj = new Categoria();
        $resultado = $obj->leer();

        if(isset($_GET['app'])){
            switch ($_GET['app']) {
                case 'excel':
                    $datos=array(
                        'app'=>'excel',
                        'filename'=>'Categorias.xls',
                        'data'=>$resultado['data']
                    );
                    break;
                
                default:
                    $datos=array(
                        'app'=>'word',
                        'filename'=>'Categorias.doc',
                        'data'=>$resultado['data']
                    );
                    break;
            }
            
            Vista::mostrar('categoria/reporteXLSX.php',$datos);
        }
        
    }

}