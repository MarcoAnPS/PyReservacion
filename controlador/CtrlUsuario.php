<?php
require_once SYS . DIRECTORY_SEPARATOR . 'Controlador.php';
require_once MOD .DIRECTORY_SEPARATOR . 'Usuario.php';
require_once MOD .DIRECTORY_SEPARATOR . 'Carrito.php';
require_once REC . DIRECTORY_SEPARATOR . 'Libreria.php';
/*
* Clase CtrlPais
*/
class CtrlUsuario extends Controlador {
    
    public function index($msg=array('titulo'=>'','cuerpo'=>'')){
        $menu= Libreria::getMenu();
        $migas = array(
            '?'=>'Inicio',
            '#'=>'Listado'
        );

        $obj = new Usuario();
        $resultado = $obj->leer();
        //var_dump($resultado);exit();
        $datos = array(
            'titulo'=>"Usuarios",
            'contenido'=>Vista::mostrar('usuario/mostrar.php',$resultado,true),
            'menu'=>$menu,
            'migas'=>$migas,
            'msg'=>$msg,
            'cssGbl'=>Libreria::cssGlobales(),
            'jsGbl'=>Libreria::jsGlobales()
        );
        //var_dump($obj->leerUno());exit();
        $this->mostrarVista('template.php',$datos);
    }

    public function validar(){
        if (isset($_POST['usuario']) && isset($_POST['clave'])) {
            $obj = new Usuario();
            $obj->setLogin($_POST['usuario']);
            $obj->setClave($_POST['clave']);
            $obj->setEstado($_POST['Estado']);
            $datos=$obj->validarUsuario();
            //var_dump($datos);exit();
            if (isset($datos['data']))
                if($datos['data']!=null){
                    $_SESSION['nombre']=$datos['data'][0]['nombre'];
                    $_SESSION['email']=$datos['data'][0]['email'];
                    $_SESSION['id']=$datos['data'][0]['idUsuario'];
                    $_SESSION['Estado']=$datos['data'][0]['Estado']!='1';
                    $_SESSION['tipo']=$datos['data'][0]['idtipoUsuario']!='1';
                    // echo $_SESSION['nombre'];
                }
            //var_dump($datos);exit();
        }
        header("Location: ?");
        exit();
    }
    public function cerrarSesion()
    {
        session_destroy();
        header("Location: ?");
        exit();
    }

    public function nuevo(){
        $menu = Libreria::getMenu();
        $msg= array(
            'titulo'=>'Nuevo...',
            'cuerpo'=>'Ingrese información para nuevo Pais');
        $migas = array(
            '?'=>'Inicio',
            '?ctrl=CtrlUsuario'=>'Listado',
            '#'=>'Nuevo'
        );
        $obj = new Usuario();
        $datos1=array(
            'encabezado'=>'Nuevo Usuario',
            'usuarios'=>$obj
            );

        $datos = array(
                'titulo'=>'Nuevo Usuario',
                'contenido'=>Vista::mostrar('usuario/frmNuevo.php',$datos1,true),
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
        $obj = new Usuario (
                $_POST["idUsuario"],
                $_POST["Nickname"],
                $_POST["Contraseña"],
                $_POST["nombre"],
                $_POST["email"],
                $_POST["Estado"],
                $_POST["tipousuario"],
                );
        //var_dump($obj);exit();
        $respuesta=$obj->nuevo();
        
        
        $this->mostrarVista('Correo.php',$obj);
        //$this->index($respuesta['msg']);
        header("Location: ?");
        exit();
        
    }
    
    public function eliminar(){
        if (isset($_REQUEST['idUsuario'])) {
            $obj = new Usuario($_REQUEST['idUsuario']);
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
            'cuerpo'=>'Iniciando edición para: '.$_REQUEST['idUsuario']);
        $migas = array(
            '?'=>'Inicio',
            '?ctrl=CtrlUsuario'=>'Listado',
            '#'=>'Editar',
        );
        if (isset($_REQUEST['idUsuario'])) {

            $obj = new Usuario($_REQUEST['idUsuario']);
            $miObj = $obj->leerUno();
            // var_dump($obj->leerUno());exit();
            if (is_null($miObj['data'])) {
                $this->index(array(
                    'titulo'=>'Error',
                    'cuerpo'=>'ID Requerido: '.$_REQUEST['idUsuario']. ' No Existe')
                );
            }else{
                $datos1 = array(
                    'usuarios'=>$obj
                );
                $datos = array(
                'titulo'=>'Editando Usuario: '. $_REQUEST['idUsuario'],
                'contenido'=>Vista::mostrar('usuario/frmEditar.php',$datos1,true),
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
                'titulo'=>'Editando Turno... DESCONOCIDO',
                'contenido'=>'...El Id a Editar es requerido',
                'menu'=>$menu,
                'migas'=>$migas,
                'msg'=>$msg
            );
        }
        
        $this->mostrarVista('template.php',$datos);

        
    }
    public function guardarEditar(){
        $obj = new Usuario (
                $_POST["idUsuario"],
                $_POST["Nickname"],
                $_POST["Contraseña"],
                $_POST["nombre"],
                $_POST["email"],
                $_POST["tipousuario"],
                );
        //var_dump($obj->leerUno());exit();
        $respuesta=$obj->editar();
        
        $this->index($respuesta['msg']);
    }
    private function _getMigas($operacion=null)     {
        $retorno=null;
        switch ($operacion) {
            case 'nuevo':
                $retorno = array(
                    '?'=>'Inicio',
                    '?ctrl=CtrlUsuario'=>'Listado',
                    '#'=>'Nuevo',
                );
                break;
            case 'editar':
                $retorno = array(
                    '?'=>'Inicio',
                    '?ctrl=CtrlUsuario'=>'Listado',
                    '#'=>'Editar',
                );
                break;
            
            default:
                $retorno = array(
                    '?'=>'Inicio',
                );
                break;
        }
        return $retorno;
    }
    private function _getMsg($titulo=null,$msg=null){
        return array(
            'titulo'=>$titulo,
            'cuerpo'=>$msg
        );
    }
    public function perfil($msg=null)     {
        $menu= Libreria::getMenu();
        
        $obj = new Usuario();
        $resultado = $obj->leer();
        $msg = ($msg==null)?$this->_getMsg():$msg;
        $datos = array(
            'titulo'=>"Perfil del Usuario",
            'contenido'=>Vista::mostrar('usuario/perfil.php',$resultado,true),
            'menu'=>$menu,
            'migas'=>$this->_getMigas(),
            'msg'=>$msg,
            'cssGbl'=>Libreria::cssGlobales(),
            'jsGbl'=>Libreria::jsGlobales()
        );
        
        $this->mostrarVista('template.php',$datos);
    }
    public function validarCorreo() {
        $obj = new Usuario ();
        $respuesta = $obj -> ConfirmarCorreo();
        header("Location: ?");
        exit();
    }
    
}