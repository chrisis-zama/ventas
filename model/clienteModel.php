<?php
require_once("conectar_BD.php");

class ClienteModel{

    public function Registrar($nombre,$apellido)
    {
        // Conectar con la base de datos
        $conexion = new conexion;
        $con = $conexion->crear_conexion();
        // Ejecutar la consulta SQL
        $consulta = "INSERT INTO cliente (c_nombre,c_apellido) VALUES(
								 '$nombre',	
								 '$apellido'								
								 )";
        $resuConsulta = $conexion->consulta_base_de_datos($con,$consulta);
            $conexion->cerrar_conexion($con);
	        return $resuConsulta;					
    }

    public function Modificar($id,$nombre,$apellido)
    {
	    $conexion = new conexion;
	    $con = $conexion->crear_conexion();
	    $consulta ="UPDATE cliente
	                SET    c_nombre = '$nombre',
                           c_apellido = '$apellido'									   					   
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
        $consulta ="DELETE FROM cliente			                          
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
        $consulta = "SELECT id, c_nombre, c_apellido
                     FROM cliente 
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
        $consulta = "SELECT id, c_nombre, c_apellido
                     FROM cliente 
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
                     FROM cliente 
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
        $consulta = "SELECT id, c_nombre, c_apellido
                     FROM cliente
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

    public function Validar($nombre,$apellidos)
    {
        $conexion = new conexion;
        $con = $conexion->crear_conexion();
        $consulta = "SELECT *
                     FROM cliente
			         WHERE c_nombre = '$nombre' AND c_apellido = '$apellidos'							
			        ";
        $resuConsulta = $conexion->consulta_base_de_datos($con,$consulta);
        $resultado = mysqli_fetch_row($resuConsulta);
        $conexion->cerrar_conexion($con);							 
  	    return $resultado;							 
    }

}