<?php session_start(); ?>
<?php
// comprobar variables de sesión
if( isset($_SESSION["valid_user"]) != NULL || isset($_SESSION["valid_user"]) != '' )
{
    require_once("../View/Navegacion.php");
    require_once("../model/facturaModel.php");
    require_once("../model/fechaModel.php");
    require_once("../model/mensajesModel.php");

    $objeFactura = new FacturaModel();
    $objeFecha = new FechaModel();
    $objeMensaje = new Mensaje();

    $listFactura = $objeFactura->ListarVentas();

    $mensaje = "";
    $totalPrecio = 0;
    $totalCantidad = 0;
    $totalTotal = 0;
    $fechaInicial = $objeFecha->fechaActual();
    $fechaFinal = $objeFecha->fechaActual();

    if(isset($_POST['BUSCAR'])){
        if(isset($_POST['fechaFinal']) && isset($_POST['fechaInicial'])){
            if($_POST['fechaFinal'] != $_POST['fechaInicial']){
                $fechaInicial = $_POST['fechaInicial'];
                $fechaFinal = $_POST['fechaFinal'];
                $listFactura = $objeFactura->ListarVentasPorFechas($fechaInicial,$fechaFinal);
                $count = mysqli_num_rows($listFactura);
                if($count == 0){
                    $mensaje = $objeMensaje->RegistroNoExistente();
                    $listFactura = $objeFactura->ListarVentas();
                }
            }else{
                $fecha = $_POST['fechaFinal'];
                $listFactura = $objeFactura->ListarVentasPorFecha($fecha);
                $count = mysqli_num_rows($listFactura);
                $fechaInicial = $fecha;
                $fechaFinal = $fecha;
                if($count == 0){
                    $mensaje = $objeMensaje->RegistroNoExistente();
                    $listFactura = $objeFactura->ListarVentas();
                }
            }
        }
    }

    require_once("../view/facturaView.php"); 
}
else
{
	require_once("../Controller/iniciarSesionController.php");
}
?>