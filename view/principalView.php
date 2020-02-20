<?php session_start(); ?>
<?php require_once('navegacion.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="ajax.js"></script>
    <title>Ventas</title>
</head>
<body>
<div class="container">
    <h2 class="col-form-label-lg" >Bienvenido</h2>
    <p  >hola <?php echo $_SESSION["valid_user"]; ?></p>
</div>
</body>
</html>


