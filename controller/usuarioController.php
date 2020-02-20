<?php session_start(); ?>
<?php
// comprobar variables de sesión
if( isset($_SESSION["valid_user"]) != NULL || isset($_SESSION["valid_user"]) != '' )
{
    require_once("../View/Navegacion.php");	
	   			
    //Model
    require_once("../model/usuarioModel.php");
    require_once("../model/mensajesModel.php");

    $objeUsuario = new UsuarioModel();
    $objeMensaje = new Mensaje();

    $listUsuarios = $objeUsuario->Listar();
    $cantUsuarios = $objeUsuario->contar();
    $registroXpagina = 10;
    $mensaje = "";
    $usuario = "";
    $contrasena = "";

    $paginas = $cantUsuarios/$registroXpagina;
    $paginas = ceil($paginas);

    //echo $paginas;

    if(isset($_POST['BORRAR']) || isset($_POST['MODIFICAR']) || isset($_POST['REGISTRAR'])){}
    else{

        if(isset($_GET['a'])){
            $idUsuario = $_GET['a'];
            $listUsuaPorId = $objeUsuario->ListarPorId($idUsuario);
            $usuario = $listUsuaPorId[0][1];
            $contrasena = $listUsuaPorId[0][2];
            $iniciar = 0;
            $listUsuaLimit = $objeUsuario->ListarLimit($iniciar,$registroXpagina);
            
        }

        if(!$_GET){
            header('location: ../controller/usuarioController.php?pagina=1');
        }

        if(isset($_GET['pagina'])){
            if($_GET['pagina']>$paginas || $_GET['pagina']<=0){
                header('location: ../controller/usuarioController.php?pagina=1');
            }

            $iniciar = ($_GET['pagina']-1)*$registroXpagina;
            $listUsuaLimit = $objeUsuario->ListarLimit($iniciar,$registroXpagina);
        }

    }

    if(isset($_POST['REGISTRAR'])){
        $registar = $_POST['REGISTRAR'];
        if($registar)
        {	
            $modiUsuario =  $_POST['modiUsuario'];
            $modiContrasena =  $_POST['modiContrasena'];

            if($modiUsuario == "" || $modiContrasena == ""){$mensaje = $objeMensaje->IngresarTodo();}
            else{
                $guardar = $objeUsuario->Registrar($modiUsuario,$modiContrasena);
                if($guardar)
                {
                    $mensaje = $objeMensaje->RegistroExitoso();		
                    $iniciar = 0;
                    $listUsuaLimit = $objeUsuario->ListarLimit($iniciar,$registroXpagina);  
                }else{$mensaje = $objeMensaje->RegistroNoExitoso();}    
            }
        } 
    }

    if(isset($_POST['MODIFICAR'])){
        $modificar = $_POST['MODIFICAR'];
        if($modificar)
        {
            $modiIdUsuario =  $_POST['modiIdUsuario'];
            $modiUsuario =  $_POST['modiUsuario'];
            $modiContrasena =  $_POST['modiContrasena'];

            if($modiUsuario == "" || $modiContrasena == ""){$mensaje = $objeMensaje->IngresarTodo();}
            else{
                $cambiar = $objeUsuario->Modificar($modiIdUsuario,$modiUsuario,$modiContrasena);
                if($cambiar)
                {
                    $mensaje = $objeMensaje->RegistroModificado();		
                    $iniciar = 0;
                    $listUsuaLimit = $objeUsuario->ListarLimit($iniciar,$registroXpagina);  
                }else{$mensaje = $objeMensaje->RegistroNoModificado();}    
            }

        } 
    }

    if(isset($_POST['BORRAR'])){
        $modificar = $_POST['BORRAR'];
        if($modificar)
        {
            $modiIdUsuario =  $_POST['modiIdUsuario'];

            if($modiIdUsuario == "" || $modiIdUsuario == 0){$mensaje = $objeMensaje->IngresarTodo();}
            else{
                $eliminar = $objeUsuario->Eliminar($modiIdUsuario);
                if($eliminar)
                {
                    $mensaje = $objeMensaje->RegistroEliminado();		
                    $iniciar = 0;
                    $listUsuaLimit = $objeUsuario->ListarLimit($iniciar,$registroXpagina);  
                }else{$mensaje = $objeMensaje->RegistroNoEliminado();}    
            }

        } 
    }

    require_once("../view/usuarioView.php"); 
}
else
{
	require_once("../Controller/iniciarSesionController.php");
}
?>