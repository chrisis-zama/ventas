<?php
require_once("conectar_BD.php");

class ProductoModel{

    public function Registrar($producto,$precio)
    {
        // Conectar con la base de datos
        $conexion = new conexion;
        $con = $conexion->crear_conexion();
        // Ejecutar la consulta SQL
        $consulta = "INSERT INTO producto (precio,p_nombre) VALUES(
								 '$precio',	
								 '$producto'								
								 )";
        $resuConsulta = $conexion->consulta_base_de_datos($con,$consulta);
            $conexion->cerrar_conexion($con);
	        return $resuConsulta;					
    }

    public function Modificar($id,$producto,$precio)
    {
	    $conexion = new conexion;
	    $con = $conexion->crear_conexion();
	    $consulta ="UPDATE producto
	                SET    precio = '$precio',
                           p_nombre = '$producto'									   					   
			        WHERE  id = $id
		       ";
        $resuConsulta = $conexion->consulta_base_de_datos($con,$consulta);			
        if($resuConsulta)
        {
	        $resultado = true;
        }else{
	        $resultado = false;
	    }
	    $conexion->cerrar_conexion($con);
	    return $resultado;
    }

    public function Eliminar($id)
    {
        $conexion = new conexion;
        $con = $conexion->crear_conexion();
        $consulta ="DELETE FROM producto			                          
		            WHERE   id = $id
                    ";
        $resuConsulta = $conexion->consulta_base_de_datos($con,$consulta);			
        if($resuConsulta)
	    {$resultado = true;}
        else
	    {$resultado = false;}
	    $conexion->cerrar_conexion($con);
	    return $resultado;
    }	

    public function Listar()
    {   
        $conexion = new  conexion;
        $con=$conexion->crear_conexion();
        $consulta = "SELECT  id, precio,  p_nombre
                     FROM producto 
                     group by p_nombre
				     ORDER BY id DESC
                     
                    ";	
        $resuConsulta = $conexion->consulta_base_de_datos($con,$consulta);
        /*$datos = array();
        while($colu = $conexion->obtener_resultados($resuConsulta))
            {
	     		$datos[] = $colu;
			}   */
        $conexion->cerrar_conexion($con);
        return $resuConsulta;			
    }

    public function ListarLimit($iniciar,$limite)
    {   
        $conexion = new  conexion;
        $con=$conexion->crear_conexion();
        $consulta = "SELECT  id, precio,  p_nombre
                     FROM producto 
                     ORDER BY id DESC
                     LIMIT $iniciar,$limite
                    ";	
        $resuConsulta = $conexion->consulta_base_de_datos($con,$consulta);
        /*$datos = array();
        while($colu = $conexion->obtener_resultados($resuConsulta))
            {
	     		$datos[] = $colu;
			}   */
        $conexion->cerrar_conexion($con);
        return $resuConsulta;			
    }

    public function contar()
    {   
        $conexion = new  conexion;
        $con=$conexion->crear_conexion();
        $consulta = "SELECT *
                     FROM producto 
                    ";	
        $resuConsulta = $conexion->consulta_base_de_datos($con,$consulta);
        $datos = $conexion->contar_resultado($resuConsulta);
        $conexion->cerrar_conexion($con);
        return $datos;			
    }

    public function ListarPorId($id)
    {
        // Conectar con la base de datos
        $conexion = new  conexion;
        $con=$conexion->crear_conexion();
        // Ejecutar la consulta SQL
        $consulta = "SELECT id, precio, p_nombre
                     FROM producto
				     WHERE id = $id
                    ";	
        $resuConsulta = $conexion->consulta_base_de_datos($con,$consulta);
        while($colu = mysqli_fetch_row($resuConsulta))
            {
	     		$datos[] = $colu;
			}
        $conexion->cerrar_conexion($con);
        return $datos;			
    }

    public function Validar($producto)
    {
        $conexion = new conexion;
        $con = $conexion->crear_conexion();
        $consulta = "SELECT *
                     FROM producto
			         WHERE p_nombre = '$producto'							
			        ";
        $resuConsulta = $conexion->consulta_base_de_datos($con,$consulta);
        while($colu = mysqli_fetch_row($resuConsulta))
            {
	     		$datos[] = $colu;
			}
        $conexion->cerrar_conexion($con);							 
  	    return $datos;							 
    }

}