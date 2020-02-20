<?php session_start(); ?>
<?php
//modelo
require_once("../model/mensajesModel.php");
require_once("../model/usuarioModel.php");

$objeMensaje = new Mensaje();
$objeUsuario = new UsuarioModel();

$mensaje ="";

if(isset($_POST['INICIAR'])){
    $iniciar = $_POST['INICIAR'];
    if($iniciar)
    {	
        $modiUsuario =  $_POST['modiUsuario'];
        $modiContrasena =  $_POST['modiContrasena'];

        $validarContrasena = $objeUsuario->Validar($modiUsuario,$modiContrasena);

        if($validarContrasena != 0 || $validarContrasena != ""){
            $_SESSION["valid_user"] = $modiUsuario;     
            header("location: ../view/principalView.php");
        }else{$mensaje = $objeMensaje->contrasenaIncorrecta();
            header("location: iniciarSesionController.php");
            }
    }else{
        //vista
        require_once("controller/iniciarSesionController.php");
    }  
}
else
{
//vista
?>
<?php
    require_once("../view/inicioSesionView.php");
}
?>
