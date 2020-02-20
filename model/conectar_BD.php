<?php
class conexion{

    function crear_conexion()
    {
        $servidor="localhost";
        $usuario="root";
        $contrasena="";  
        $database="vent";
        
        return mysqli_connect($servidor, $usuario, $contrasena, $database);
    }
    function cerrar_conexion($conexion)
    {
        return mysqli_close($conexion);
    }
    function consulta_base_de_datos($conexion,$consulta)
    {
        $resultado = mysqli_query($conexion,$consulta);
        return $resultado;
    }
    function obtener_resultados($resultado)
    {
        return mysqli_fetch_array($resultado);
    }
    function contar_resultado($resultado)
    {
        return mysqli_num_rows($resultado);
    }

    

}
?>