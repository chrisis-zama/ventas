<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>facturas</title>
</head>
<body>
<form method="post" action="../controller/facturaController.php">
<br>
<div class="container ">  
<table>
    <tr>
        <td>
            <label class="col-form-label-lg" for="fechaInicial">Fecha Inicial:</label>
        </td>
        <td>
            <input class="form-control" type="date" name="fechaInicial" id="fechaInicial" value="<?php echo $fechaInicial;?>">
        </td>
    </tr>
    <tr>
        <td>
            <label class="col-form-label-lg" for="fechaFinal">Fecha Final:</label>
        </td>
        <td>
            <input class="form-control" type="date" name="fechaFinal" id="fechaFinal" value="<?php echo $fechaFinal;?>">
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <input class="btn btn-primary" type="submit" name="BUSCAR"  value="BUSCAR"/></td>
        </td>    
    </tr>
    <tr><td colspan="2"><?php echo $mensaje;?></td></tr>
</table>



<br>    
<table class="table table-dark"  >
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Usuario</th>
                <th>Fecha</th>
                <th >Total</th>
            </tr>
        </thead>
        <tbody >
        <?php foreach ($listFactura as $row): ?>
        <tr><?php $idVenta = $row['id']; ?>
            <td><?php echo "<a href='../controller/facturaIndivudualController.php?a=$idVenta'>$idVenta</a>";?></td>
            <td><?php echo $row['cliente']; ?></td>
            <td><?php echo $row['usuario'];?></td>
            <td><?php  echo $row['fecha'];?></td>
            <td align="right" style="color:lawngreen;">$ <?php echo number_format($row['venta'], 2, ',', '.');?></td>
            <?php $totalTotal += $row['venta'];  ?>
        </tr>
        <?php endforeach;?>
        <tr >
            <td colspan="4" style="color:lawngreen;" align="center">Totales</td>
            <td align="right" style="color:lawngreen;">$ <?php echo number_format($totalTotal, 2, ',', '.');?></td>
        </tr>
        </tbody>
    </table>
    </div>
    </form>
</body>
</html>