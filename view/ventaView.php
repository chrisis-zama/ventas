<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="../js/script.js"></script>
    <script src="../js/jquery.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"><script src="ajax.js"></script>
    <title>venta</title>
    <?php require_once('../controller/ventaController.php'); ?>
</head>
<body>
<form method="post" action="../controller/ventaController.php">
  <div class="container ">  
    <br /> 
    <table  >
        <tr>
            <td class="col-form-label-lg" >Cliente:</td>
            <td class="col-sm-10">
                <select class="form-control" name="seleCliente" id="seleCliente" >
                    <option value="0">SELECCIONAR</option>
                    <?php foreach ($listCliente as $row): ?>
                    <option value="<?php echo $row['id']?>"><?php echo $row['c_nombre']." ".$row['c_apellido']?></option>

                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td class="col-form-label-lg" >Venta:</td>
            <td class="col-sm-10">
                <select class="form-control" name="seleVenta" id="seleVenta" >
                    <option value="<?php echo $listUltiVenta[0][0]?>"><?php echo $listUltiVenta[0][3]." ".$listUltiVenta[0][4]?></option>
                    <option value="0">Nueva</option>
                </select>
            </td>
        </tr>
    </table>
    <br>
    <table>
        <tr>
            <td class="col-form-label-lg" >Producto:</td>
            <td class="col-sm-10">
                <select class="form-control" name="seleProducto" id="seleProducto" >
                    <option value="0">SELECCIONAR</option>
                    <?php foreach ($listProducto as $row): ?>
                    <option value="<?php echo $row['id']?>"><?php echo $row['p_nombre']?></option>

                    <?php endforeach; ?>
                </select>
            </td>
        </tr>

        <tr >
            <td class="col-form-label-lg">Cantidad:</td>
            <td class="col-sm-10">
                <input class="form-control " name="modiCantidad" type="number" id="modiCantidad" value="<?php echo $cantidad; ?>">
            </td> 
        </tr> 
        <tr>
        <td ><input class="btn btn-primary" type="submit" name="REGISTRAR" id="REGISTRAR" value="REGISTRAR"/>
            </td>
            
        </tr>
        <tr><td colspan="2"><?php echo $mensaje;?></td></tr>
    </table>
    
    <br>
    <?php  if($idFact == 0 || $idFact == ""){}else{?>
    <table>
        <tr>
            <td class="col-form-label-lg">Id:</td>
            <td class="col-sm-10"><input name="modiIdVenta" type="hidden" id="modiIdVenta" value="<?php echo $ventaId; ?>">
            <input class="form-control " name="modiIdFactura" type="text" id="modiIdFactura" value="<?php echo $idFact; ?>" Readonly></td>
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
            <td><input class="btn btn-primary" type="submit" name="MODIFICAR"  value="MODIFICAR"/></td>
            <td><input class="btn btn-primary" type="submit" name="BORRAR"  value="BORRAR"/></td>
        </tr>
        </tr>                    
    </table>
                    <?php } ?>
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
            <td><?php echo "<a href='../controller/ventaController.php?a=$idVenta'>$idVenta</a>";?></td>
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
        </tbody>
    </table>
    </div>
</form>  
</body>
</html>