<?php session_start(); ?>
<?php
// comprobar variables de sesión
if( isset($_SESSION["valid_user"]) != NULL || isset($_SESSION["valid_user"]) != '' )
{
    require_once("../View/Navegacion.php");	

    require_once("../model/clienteModel.php");
    require_once("../model/mensajesModel.php");

    $objeCliente = new ClienteModel();
    $objeMensaje = new Mensaje();

    $listCliente = $objeCliente->Listar();
    $cantCliente = $objeCliente->contar();
    $registroXpagina = 10;
    $mensaje = "";
    $cNombre = "";
    $cApellido = "";

    $paginas = $cantCliente/$registroXpagina;
    $paginas = ceil($paginas);

    if(isset($_POST['BORRAR']) || isset($_POST['MODIFICAR']) || isset($_POST['REGISTRAR'])){}
    else{
        if(isset($_GET['a'])){
            $idCliente = $_GET['a'];
            $listCliePorId = $objeCliente->ListarPorId($idCliente);
            $cNombre = $listCliePorId[0][1];
            $cApellido = $listCliePorId[0][2];
            $iniciar = 0;
            $listClieLimit = $objeCliente->ListarLimit($iniciar,$registroXpagina); 
        }

        if(!$_GET){
            header('location: ../controller/clienteController.php?pagina=1');
        }

        if(isset($_GET['pagina'])){
            if($_GET['pagina']>$paginas || $_GET['pagina']<=0){
                header('location: ../controller/clienteController.php?pagina=1');
            }

            $iniciar = ($_GET['pagina']-1)*$registroXpagina;
            $listClieLimit = $objeCliente->ListarLimit($iniciar,$registroXpagina);
        }
    }

    if(isset($_POST['REGISTRAR'])){
        $registar = $_POST['REGISTRAR'];
        if($registar)
        {	
            $modiNombre =  $_POST['modiNombre'];
            $modiApellido =  $_POST['modiApellido'];

            if($modiNombre == "" || $modiApellido == ""){$mensaje = $objeMensaje->IngresarTodo();}
            else{
                $guardar = $objeCliente->Registrar($modiNombre,$modiApellido);
                if($guardar)
                {
                    $mensaje = $objeMensaje->RegistroExitoso();		
                    $iniciar = 0;
                    $listClieLimit = $objeCliente->ListarLimit($iniciar,$registroXpagina); 
                }else{$mensaje = $objeMensaje->RegistroNoExitoso();}    
            }
        } 
    }

    if(isset($_POST['MODIFICAR'])){
        $modificar = $_POST['MODIFICAR'];
        if($modificar)
        {
            $modiIdCliente =  $_POST['modiIdCliente'];
            $modiNombre =  $_POST['modiNombre'];
            $modiApellido =  $_POST['modiApellido'];

            if($modiNombre == "" || $modiApellido == ""){$mensaje = $objeMensaje->IngresarTodo();}
            else{
                $cambiar = $objeCliente->Modificar($modiIdCliente,$modiNombre,$modiApellido);
                if($cambiar)
                {
                    $mensaje = $objeMensaje->RegistroModificado();		
                    $iniciar = 0;
                    $listClieLimit = $objeCliente->ListarLimit($iniciar,$registroXpagina);   
                }else{$mensaje = $objeMensaje->RegistroNoModificado();}    
            }

        } 
    }

    if(isset($_POST['BORRAR'])){
        $modificar = $_POST['BORRAR'];
        if($modificar)
        {
            $modiIdCliente =  $_POST['modiIdCliente'];

            if($modiIdCliente == "" || $modiIdCliente == 0){$mensaje = $objeMensaje->IngresarTodo();}
            else{
                $eliminar = $objeCliente->Eliminar($modiIdCliente);
                if($eliminar)
                {
                    $mensaje = $objeMensaje->RegistroEliminado();		
                    $iniciar = 0;
                    $listClieLimit = $objeCliente->ListarLimit($iniciar,$registroXpagina);   
                }else{$mensaje = $objeMensaje->RegistroNoEliminado();}    
            }

        } 
    }

    require_once("../view/clienteView.php"); 

}
else
{
	require_once("../Controller/iniciarSesionController.php");
}
?>