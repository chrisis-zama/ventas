<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="../js/script.js"></script>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"><script src="ajax.js"></script>
    <title>Iniciar Sesión</title>
</head>
<body>
<form  method="post" action="../controller/iniciarSesionController.php">
<div class="container ">
<br>
<h2 align="center" >INICIAR SESION</h2>
    <table>
        <tr>
            <td class="col-form-label-lg" >USUARIO</td>
            <td class="col-sm-10"><input class="form-control form-control-sm" name="modiUsuario" type="text" required="required" id="modiUsuario" autofocus></td>
        </tr>
        <tr>
            <td class="col-form-label-lg" >CONTRASEÑA</td>
            <td class="col-sm-10"><input class="form-control form-control-sm" name="modiContrasena" type="password" required="required" id="modiContrasena">
        </td>
        <tr>
            <td colspan="4"><?php echo $mensaje;?></td>
        </tr>
        <tr>
            <td colspan="2  "><input class="btn btn-primary btn-lg btn-block" type="submit" name="INICIAR" id="INICIAR" value="INICIAR"/>
        </tr>    
    </table>
    </div>
</form>
</body>
</html>