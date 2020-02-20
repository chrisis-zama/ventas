<?php session_start(); ?>
<?php
// comprobar variables de sesión
if( isset($_SESSION["valid_user"]) != NULL || isset($_SESSION["valid_user"]) != '' )
{
    require_once("../View/Navegacion.php");
    require_once("../model/mensajesModel.php");
    require_once("../model/facturaModel.php");
    require_once("../model/productoModel.php");
    require_once("../model/clienteModel.php");
    require_once("../model/usuarioModel.php");
    require_once("../model/FechaModel.php");
    require_once("../model/ventaModel.php");

    $objeFactura = new FacturaModel();
    $objeCliente = new ClienteModel();
    $objeProducto = new ProductoModel();
    $objeUsuario = new UsuarioModel();
    $objeMensaje = new Mensaje();
    $objFecha = new FechaModel();
    $objeVenta = new VentaModel();

    $listCliente = $objeCliente->Listar();
    $listProducto = $objeProducto->Listar();
    $listUsuario = $objeUsuario->Listar();

    $totalTotal = 0;
    $totalCantidad = 0;
    $totalPrecio = 0;
    $idVent = 0;
    $mensaje = "";

    $idFact = $_GET['a'];
    $listFactura = $objeFactura->ListarVentaPorId($idFact);
    $listUltiVenta = $objeVenta->ListarUltima(); 

    if(isset($_POST['BORRAR']) || isset($_POST['MODIFICAR']) || isset($_POST['REGISTRAR'])){}
    else{
        if(isset($_GET['b'])){
            $idVent = $_GET['b'];
            $listFactPorId = $objeFactura->ListarPorId($idVent);
            $clienteId = $listFactPorId[0][2];
            $cliente = $listFactPorId[0][1];
            $productoId = $listFactPorId[0][6];
            $Producto = $listFactPorId[0][5];
            $fecha = $listFactPorId[0][4];
            $usuarioId = $listFactPorId[0][7];
            $usuario = $listFactPorId[0][3];
            $precio = $listFactPorId[0][8];
            $cantida = $listFactPorId[0][9];
            $ventaId = $listFactPorId[0][11];  
            $listFactura = $objeFactura->ListarVentaPorId($idFact);
        }
    }

    if(isset($_POST['REGISTRAR'])){
        $registar = $_POST['REGISTRAR'];
        if($registar)
        {
            $fecha = $objFecha->fechaActual();
            $modiCantidad =  $_POST['modiCantida'];
            $seleProducto =  $_POST['modiIdProducto'];
            $ventaId = $_POST['modiIdVenta'];
            $inser = $objeFactura->Registrar($ventaId,$seleProducto,$modiCantidad,$fecha);
            if($inser)
            {
                $mensaje = $objeMensaje->RegistroExitoso();	
                $listFactura = $objeFactura->ListarVentaPorId($idFact); 
            }else{$mensaje = $objeMensaje->RegistroNoExitoso();}

        }    
    }

    if(isset($_POST['MODIFICAR'])){
        $idVenta = $_POST['modiIdFactura'];
        $listFactPorId = $objeFactura->ListarPorId($idVenta);
        $clienteId = $listFactPorId[0][2];
        $usuarioId = $listFactPorId[0][7];
        if($_POST['modiIdCliente'] == $clienteId && $_POST['modiIdUsuario'] == $usuarioId){

            $modificar = $_POST['MODIFICAR'];
            if($modificar)
            {
                $modiIdVenta = $_POST['modiIdVenta'];
                $modiIdFactura =  $_POST['modiIdFactura'];
                $modiIdCliente =  $_POST['modiIdCliente'];
                $modiIdProducto =  $_POST['modiIdProducto'];
                $modiFecha =  $_POST['modiFecha'];
                $modiIdUsuario =  $_POST['modiIdUsuario'];
                $modiCantida =  $_POST['modiCantida'];
            

                if($modiIdVenta == "" || $modiIdProducto == ""){$mensaje = $objeMensaje->IngresarTodo();}
                else{
                    $cambiar = $objeFactura->Modificar($modiIdFactura,$modiIdVenta,$modiIdProducto,$modiCantida,$modiFecha);
                    if($cambiar)
                    {
                        $mensaje = $objeMensaje->RegistroModificado();			
                        $listFactura = $objeFactura->ListarVentaPorId($idFact); 
                    }else{$mensaje = $objeMensaje->RegistroNoModificado();}    
                }
            }
        }else{
            
            $modificar = $_POST['MODIFICAR'];
            if($modificar)
            {
                $modiIdVenta = $_POST['modiIdVenta'];
                $modiIdFactura =  $_POST['modiIdFactura'];
                $modiIdCliente =  $_POST['modiIdCliente'];
                $modiIdProducto =  $_POST['modiIdProducto'];
                $modiFecha =  $_POST['modiFecha'];
                $modiIdUsuario =  $_POST['modiIdUsuario'];
                $modiCantida =  $_POST['modiCantida'];
            

                if($modiIdVenta == "" || $modiIdProducto == ""){$mensaje = $objeMensaje->IngresarTodo();}
                else{
                    $alterar = $objeVenta->Modificar($modiIdVenta,$modiIdCliente,$modiIdUsuario);
                    $cambiar = $objeFactura->Modificar($modiIdFactura,$modiIdVenta,$modiIdProducto,$modiCantida,$modiFecha);                     
                    if($cambiar && $alterar)
                    {
                        $mensaje = $objeMensaje->RegistroModificado();			
                        $listFactura = $objeFactura->ListarVentaPorId($idFact);  
                    }else{$mensaje = $objeMensaje->RegistroNoModificado();}    
                }
            }
        }    
    }

    if(isset($_POST['BORRAR'])){
        $modiIdVenta = $_POST['modiIdVenta'];
        $cont = $objeVenta->contarPorId($modiIdVenta);
        if($cont==1){
            $modificar = $_POST['BORRAR'];
            if($modificar)
            {
                $modiIdFactura =  $_POST['modiIdFactura'];
                $modiIdVenta = $_POST['modiIdVenta'];

                if($modiIdFactura == "" || $modiIdFactura == 0){$mensaje = $objeMensaje->IngresarTodo();}
                else{
                    $eliminar = $objeFactura->Eliminar($modiIdFactura);
                    $borrar = $objeVenta->Eliminar($modiIdVenta);
                    if($eliminar)
                    {
                        $mensaje = $objeMensaje->RegistroEliminado();			
                        $listFactura = $objeFactura->ListarVentaPorId($idFact);
                    }else{$mensaje = $objeMensaje->RegistroNoEliminado();}    
                }
            }
        }else{ 
            $modificar = $_POST['BORRAR'];
            if($modificar)
            {
                $modiIdFactura =  $_POST['modiIdFactura'];

                if($modiIdFactura == "" || $modiIdFactura == 0){$mensaje = $objeMensaje->IngresarTodo();}
                else{
                    $eliminar = $objeFactura->Eliminar($modiIdFactura);
                    if($eliminar)
                    {
                        $mensaje = $objeMensaje->RegistroEliminado();			
                        $listFactura = $objeFactura->ListarVentaPorId($idFact); 
                    }else{$mensaje = $objeMensaje->RegistroNoEliminado();}    
                }
            }  
        }
    }
    require_once("../view/facturaIndividualView.php"); 
}
else
{
	require_once("../Controller/iniciarSesionController.php");
}