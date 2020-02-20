<?php session_start(); ?>
<?php
// comprobar variables de sesión
if( isset($_SESSION["valid_user"]) != NULL || isset($_SESSION["valid_user"]) != '' )
{
    require_once("../pdf/fpdf/fpdf.php");
    require_once("../model/facturaModel.php");

    $objeFactura = new FacturaModel();
    $pdf = new FPDF();

    $idFact = $_GET['a'];
    $precioTotal = 0;
    $cantidadTotal = 0;
    $totalTotal = 0;
    $factura = '';
    $cliente = '';
    $vendedor = '';
    $fecha = '';
    $listarFactura = $objeFactura->ListarVentaPorId($idFact);

    foreach ($listarFactura as $row){
        $cliente = $row['cliente'];
        $vendedor = $row['usuario'];
        $fecha = $row['fecha'];
    }



    $pdf->AddPage();
    $pdf->setFont('Arial','B',15);

    $pdf->setX(40);
    $pdf->multiCell(130,8,'FACTURA N '.$idFact."\n".'CLIENTE: '.$cliente."\n".'VENDEDOR: '.
    $vendedor."\n".'FECHA: '.$fecha."\n",1,'C',0);

    $pdf->setXY(10,50);
    $pdf->Cell(10,6,'ID',1,0,'C');
    $pdf->Cell(50,6,'PRODUCTO',1,0,'C');
    $pdf->Cell(40,6,'PRECIO',1,0,'C');
    $pdf->Cell(40,6,'CANTIDAD',1,0,'C');
    $pdf->Cell(50,6,'TOTAL',1,0,'C');

    $fila = 56;

    foreach ($listarFactura as $row){
        $pdf->setXY(10,$fila);
        $pdf->Cell(10,6,$row['id'],1,0,'C');
        $pdf->Cell(50,6,$row['producto_nombre'],1,0,'C');
        $pdf->Cell(40,6,number_format($row['precio'], 2, ',', '.'),1,0,'R');
        $precioTotal += $row['precio'];
        $pdf->Cell(40,6,number_format($row['cantidad'], 2, ',', '.'),1,0,'R');
        $cantidadTotal += $row['cantidad'];
        $pdf->Cell(50,6,number_format($row['total'], 2, ',', '.'),1,0,'R');
        $totalTotal += $row['total'];
        $fila+=6;
    }

    $cont = mysqli_num_rows($listarFactura);
    for($i=$cont;$i<=20;$i++){
        $pdf->setXY(10,$fila);
        $pdf->Cell(10,6,'',1,0,'C');
        $pdf->Cell(50,6,'',1,0,'C');
        $pdf->Cell(40,6,'',1,0,'C');
        $pdf->Cell(40,6,'',1,0,'C');
        $pdf->Cell(50,6,'',1,0,'C');
        $fila+=6;
    }

    $fila += 12;
    $pdf->setXY(10 ,$fila);
    $pdf->Cell(90,6,'TOTALES',1,1,'C');
    $fila += 6;
    $pdf->setXY(10,$fila);
    $pdf->Cell(40,6,'PRECIO',1,0,'C');
    $pdf->Cell(50,6,number_format($precioTotal, 2, ',', '.'),1,1,'C');
    $fila += 6;
    $pdf->setXY(10,$fila);
    $pdf->Cell(40,6,'CANTIDAD',1,0,'C');
    $pdf->Cell(50,6,number_format($cantidadTotal, 2, ',', '.'),1,1,'C');
    $fila += 6;
    $pdf->setXY(10,$fila);
    $pdf->Cell(40,6,'TOTAL',1,0,'C');
    $pdf->Cell(50,6,number_format($totalTotal, 2, ',', '.'),1,1,'C');
    

    $pdf->Output();

}
else
{
	require_once("../Controller/iniciarSesionController.php");
}
?>