<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura</title>
    <?php require_once('../controller/facturaIndivudualController.php'); ?>
</head>
<body>
<form method="post" <?php echo "action='../controller/facturaIndivudualController.php?b=$idVent&a=$idFact'";?>>
<br>    
<div class="container "> 
<br><?php  echo $mensaje;?>
    <?php  if($idVent == 0 || $idVent == ""){}else{?>
    <table>
        <tr>
            <td class="col-form-label-lg">Id:</td>
            <td class="col-sm-10"><input name="modiIdVenta" type="hidden" id="modiIdVenta" value="<?php echo $ventaId; ?>">
            <input class="form-control " name="modiIdFactura" type="text" id="modiIdFactura" value="<?php echo $idVent; ?>" Readonly></td>
        </tr>
        <tr>
            <td class="col-form-label-lg">Cliente:</td>
            <td class="col-sm-10">
                <select class="form-control" name="modiIdCliente" id="modiIdCliente" >
                    <option value="<?php echo $clienteId; ?>"><?php echo $cliente; ?></option>
                    <?php foreach ($listCliente as $row): ?>
                    <option value="<?php echo $row['id']?>"><?php echo $row['c_nombre']." ".$row['c_apellido']?></option>

                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td class="col-form-label-lg">Producto:</td>
            <td class="col-sm-10">
                <select class="form-control" name="modiIdProducto" id="modiIdProducto" >
                    <option value="<?php echo $productoId; ?>"><?php echo $Producto; ?></option>
                    <?php foreach ($listProducto as $row): ?>
                    <option value="<?php echo $row['id']?>"><?php echo $row['p_nombre']?></option>

                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr >
            <td class="col-form-label-lg">Fecha:</td>
            <td class="col-sm-10"><input class="form-control" name="modiFecha" type="text" id="modiFecha" value="<?php echo $fecha; ?>"></td>
        </tr>
        <tr >
            <td class="col-form-label-lg">Usuario:</td>
            <td class="col-sm-10">
                <select class="form-control" name="modiIdUsuario" id="modiIdUsuario" >
                    <option value="<?php echo $usuarioId; ?>"><?php echo $usuario; ?></option>
                    <?php foreach ($listUsuario as $row): ?>
                    <option value="<?php echo $row['id']?>"><?php echo $row['usuario']?></option>

                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr >
            <td class="col-form-label-lg">Precio:</td>
            <td class="col-sm-10"><input class="form-control" name="modiPrecio" type="number" id="modiPrecio" value="<?php echo $precio; ?>"></td>
        </tr>
        <tr >
            <td class="col-form-label-lg">Cantidad:</td>
            <td class="col-sm-10"><input class="form-control" name="modiCantida" type="number" id="modiCantida" value="<?php echo $cantida; ?>"></td>
        </tr>
        <tr >
            <td><input class="btn btn-primary" type="submit" name="REGISTRAR"  value="REGISTRAR"/></td>
            <td><input class="btn btn-primary" type="submit" name="MODIFICAR"  value="MODIFICAR"/>
            <input class="btn btn-primary" type="submit" name="BORRAR"  value="BORRAR"/></td>
        </tr>
        </tr>                    
    </table>
                    <?php } ?>
    <br>
    <table class="table table-dark"  >
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Usuario</th>
                <th>Fecha</th>
                <th>Producto</th>
                <th >Precio</th>
                <th >Cantidad</th>
                <th >Total</th>
            </tr>
        </thead>
        <tbody >
        <?php foreach ($listFactura as $row): ?>
        <tr><?php $idVenta = $row['id']; ?>
            <td><?php echo "<a href='../controller/facturaIndivudualController.php?b=$idVenta&a=$idFact'>$idVenta</a>";?></td>
            <td><?php echo $row['cliente']; ?></td>
            <td><?php echo $row['usuario'];?></td>
            <td><?php  echo $row['fecha'];?></td>
            <td><?php echo $row['producto_nombre'];?></td>
            <td align="right">$ <?php echo number_format($row['precio'], 2, ',', '.');?></td>
            <td align="right"><?php echo number_format($row['cantidad'], 2, ',', '.');?>
            <?php $totalPrecio += $row['precio'];?>
            <?php $totalCantidad += $row['cantidad'];?>
            </td>
            <td align="right" style="color:lawngreen;">$ <?php echo number_format($row['total'], 2, ',', '.');?></td>
            <?php $totalTotal += $row['total'];  ?>
        </tr>
        <?php endforeach;?>
        <tr >
            <td colspan="5" style="color:lawngreen;" align="center">Totales</td>
            <td align="right" style="color:lawngreen;">$ <?php echo number_format($totalPrecio, 2, ',', '.');?></td>
            <td align="right" style="color:lawngreen;">$ <?php echo number_format($totalCantidad, 2, ',', '.');?></td>
            <td align="right" style="color:lawngreen;">$ <?php echo number_format($totalTotal, 2, ',', '.');?></td>
        </tr>
        <tr>
            <td align="right" colspan="8"><?php echo "<a href='../controller/facturaPdfController.php?a=$idFact' target='_blank' class='btn btn-primary'>Convertir</a>";?></td></td>
        </tr>
        </tbody>
    </table> 
</div>
</form>    
</body>
</html>