<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="../js/script.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"><script src="ajax.js"></script>
    <title>Cliente</title>
    <?php require_once('../controller/clienteController.php'); ?>
</head>
<body>
<form method="post" action="../controller/clienteController.php">
  <div  class="container ">  
    <br />
    <table  >
        <tr>
            <td class="col-form-label-lg"  >Nombres</td>
            <td class="col-sm-10"><input name="modiIdCliente" type="hidden" id="modiIdCliente" value="<?php echo $idCliente; ?>">
            <input class="form-control form-control-sm"  name="modiNombre" type="text" required="required" id="modiNombre" value="<?php echo $cNombre; ?>" autofocus></td>
            
        </tr>
        <tr>
            <td class="col-form-label-lg"  >Apellidos</td>
            <td class="col-sm-10"><input class="form-control form-control-sm"  name="modiApellido" type="text" required="required" id="modiApellido" value="<?php echo $cApellido; ?>">
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
                <th>Nombres</th>
                <th>apellidos</th>
            </tr>
        </thead>
        <tbody >
        <?php foreach ($listClieLimit as $row): ?>
        <tr><?php $idCliente = $row['id']; ?>
            <td><?php echo "<a href='../controller/clienteController.php?a=$idCliente'>$idCliente</a>";?></td>
            <td><?php echo $row['c_nombre']; ?></td>
            <td><?php echo $row['c_apellido'];?></td>
        </tr>
        <?php endforeach;?>
        </tbody>
    </table>
    <nav aria-label="...">
        <ul class="pagination">
            <li class="page-item <?php echo $_GET['pagina']<=1 ? 'disabled' : ''; ?>">
                <a class="page-link" href="../controller/clienteController.php?pagina=<?php echo $_GET['pagina']-1 ?>" >
                    Anterior
                </a>
            </li>

            <?php for($i=0;$i<$paginas;$i++): ?>
            <li class="page-item <?php echo $_GET['pagina']==$i+1 ? 'active' : ''; ?>">
                <a class="page-link" href="../controller/clienteController.php?pagina=<?php echo $i + 1; ?>">
                    <?php echo $i + 1; ?>
                </a>
            </li>
            <?php endfor; ?>

            <li class="page-item <?php echo $_GET['pagina']>=$paginas ? 'disabled' : ''; ?>">
                <a class="page-link" href="../controller/clienteController.php?pagina=<?php echo $_GET['pagina']+1 ?>">
                    proximo
                </a>
            </li>
        </ul>
    </nav>
    </div>
</form>  
</body>
</html>