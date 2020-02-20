<?php
session_start();
// comprobar variables de sesión
if( isset($_SESSION["valid_user"]) != NULL || isset($_SESSION["valid_user"]) != '' )
{
    require_once("../View/Navegacion.php");	

    //Model
    require_once("../model/productoModel.php");
    require_once("../model/mensajesModel.php");

    $objeProducto = new ProductoModel();
    $objeMensaje = new Mensaje();

    $listarProducto = $objeProducto->Listar();
    $cantProducto = $objeProducto->contar();
    $registroXpagina = 10;
    $mensaje ="";
    $producto = "";
    $precio = "";

    $paginas = $cantProducto/$registroXpagina;
    $paginas = ceil($paginas);
    
    if(isset($_POST['BORRAR']) || isset($_POST['MODIFICAR']) || isset($_POST['REGISTRAR'])){}
    else{
        if(isset($_GET['a'])){
            $idProducto = $_GET['a'];
            $listproduPorId = $objeProducto->ListarPorId($idProducto);
            $producto = $listproduPorId[0][2];
            $precio = $listproduPorId[0][1];
            $iniciar = 0;
            $listProdLimit = $objeProducto->ListarLimit($iniciar,$registroXpagina);
            
        }

        if(!$_GET){
            header('location: ../controller/productoController.php?pagina=1');
        }

        if(isset($_GET['pagina'])){
            if($_GET['pagina']>$paginas || $_GET['pagina']<=0){
                header('location: ../controller/productoController.php?pagina=1');
            }

            $iniciar = ($_GET['pagina']-1)*$registroXpagina;
            $listProdLimit = $objeProducto->ListarLimit($iniciar,$registroXpagina);
        }
    }

    if(isset($_POST['REGISTRAR'])){
        $registar = $_POST['REGISTRAR'];
        if($registar)
        {	
            $modiNombre =  $_POST['modiNombre'];
            $modiPrecio =  $_POST['modiPrecio'];

            if($modiNombre == "" || $modiPrecio == ""){$mensaje = $objeMensaje->IngresarTodo();}
            else{
                $guardar = $objeProducto->Registrar($modiNombre,$modiPrecio);
                if($guardar)
                {
                    $mensaje = $objeMensaje->RegistroExitoso();		
                    $iniciar = 0;
                    $listProdLimit = $objeProducto->ListarLimit($iniciar,$registroXpagina); 
                }else{$mensaje = $objeMensaje->RegistroNoExitoso();}    
            }
        } 
    }

    if(isset($_POST['MODIFICAR'])){
        $modificar = $_POST['MODIFICAR'];
        if($modificar)
        {	
            $modiIdProducto =  $_POST['modiIdProducto'];
            $modiNombre =  $_POST['modiNombre'];
            $modiPrecio =  $_POST['modiPrecio'];

            if($modiNombre == "" || $modiPrecio == 0){$mensaje = $objeMensaje->IngresarTodo();}
            else{
                $cambiar = $objeProducto->Modificar($modiIdProducto,$modiNombre,$modiPrecio);
                if($cambiar)
                {
                    $mensaje = $objeMensaje->RegistroModificado();		
                    $iniciar = 0;
                    $listProdLimit = $objeProducto->ListarLimit($iniciar,$registroXpagina);
                }else{$mensaje = $objeMensaje->RegistroNoModificado();}    
            }
        } 
    }

    if(isset($_POST['BORRAR'])){
        $modificar = $_POST['BORRAR'];
        if($modificar)
        {
            $modiIdProducto =  $_POST['modiIdProducto'];

            if($modiIdProducto == "" || $modiIdProducto == 0){$mensaje = $objeMensaje->IngresarTodo();}
            else{
                $eliminar = $objeProducto->Eliminar($modiIdProducto);
                if($eliminar)
                {
                    $mensaje = $objeMensaje->RegistroEliminado();		
                    $iniciar = 0;
                    $listProdLimit = $objeProducto->ListarLimit($iniciar,$registroXpagina);  
                }else{$mensaje = $objeMensaje->RegistroNoEliminado();}    
            }

        } 
    }

    require_once("../view/productoView.php"); 

}
else
{
	require_once("../Controller/iniciarSesionController.php");
}
?>