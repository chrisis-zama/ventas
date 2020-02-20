<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="../js/script.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"><script src="ajax.js"></script>
    <title>Productos</title>
    <?php require_once('../controller/productoController.php'); ?>
</head>
<body>
<form method="post" action="../controller/productoController.php">
<div  class="container ">
<br>
<table class="">
        <tr>
            <td class="col-form-label-lg">Nombre:</td>
            <td class="col-sm-10"><input name="modiIdProducto" type="hidden" id="modiIdProducto" value="<?php echo $idProducto; ?>">
            <input class="form-control form-control-sm" name="modiNombre" type="text" required="required" id="modiNombre" value="<?php echo $producto;?> " autofocus></td>
        </tr>
        <tr>
            <td class="col-form-label-lg">Precio:</td>
            <td class="col-sm-10"><input class="form-control form-control-sm" name="modiPrecio" type="number" required="required" id="modiPrecio" value="<?php echo $precio;?>">
        </td>
        <tr>   
            <td colspan="2  "><input class="btn btn-primary" type="submit" name="REGISTRAR" id="REGISTRAR" value="REGISTRAR"/>
            <input class="btn btn-primary" type="submit" name="MODIFICAR"  value="MODIFICAR"/>
            <input class="btn btn-primary" type="submit" name="BORRAR"  value="BORRAR"/>
            </td>
        </tr> 
        <tr>
            <td colspan="4"><?php echo $mensaje;?></td>
        </tr>
    </table>
    <br>
    <table class="table table-dark"  >
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Precio</th>
            </tr>
        </thead>
        <tbody >
        <?php foreach ($listProdLimit as $row): ?>
        <tr><?php $idprodu = $row['id']; ?>
            <td><?php echo "<a href='../controller/productoController.php?a=$idprodu'>$idprodu</a>";?></td>
            <td><?php echo $row['p_nombre']; ?></td>
            <td><?php echo number_format($row['precio'], 2, ',', '.');?></td>
        </tr>
        <?php endforeach;?>
        </tbody>
    </table>
    <nav aria-label="...">
        <ul class="pagination">
            <li class="page-item <?php echo $_GET['pagina']<=1 ? 'disabled' : ''; ?>">
                <a class="page-link" href="../controller/productoController.php?pagina=<?php echo $_GET['pagina']-1 ?>" >
                    Anterior
                </a>
            </li>

            <?php for($i=0;$i<$paginas;$i++): ?>
            <li class="page-item <?php echo $_GET['pagina']==$i+1 ? 'active' : ''; ?>">
                <a class="page-link" href="../controller/productoController.php?pagina=<?php echo $i + 1; ?>">
                    <?php echo $i + 1; ?>
                </a>
            </li>
            <?php endfor; ?>

            <li class="page-item <?php echo $_GET['pagina']>=$paginas ? 'disabled' : ''; ?>">
                <a class="page-link" href="../controller/productoController.php?pagina=<?php echo $_GET['pagina']+1 ?>">
                    proximo
                </a>
            </li>
        </ul>
    </nav>
    </div>
</form>  
</body>
</html>