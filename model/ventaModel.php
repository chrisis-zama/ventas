<?php
require_once("conectar_BD.php");

class VentaModel{

    public function Registrar($clienteId,$usuarioId)
    {
        // Conectar con la base de datos
        $conexion = new conexion;
        $con = $conexion->crear_conexion();
        // Ejecutar la consulta SQL
        $consulta = "INSERT INTO venta (cliente_id,usuario_id) VALUES(
								 '$clienteId',	
                                 '$usuarioId'								
								 )";
        $resuConsulta = $conexion->consulta_base_de_datos($con,$consulta);
            $conexion->cerrar_conexion($con);
	        return $resuConsulta;					
    }

    public function Modificar($modiIdVenta,$modiIdCliente,$modiIdUsuario)
    {
	    $conexion = new conexion;
	    $con = $conexion->crear_conexion();
	    $consulta ="UPDATE venta
	                SET    cliente_id = $modiIdCliente,
                           usuario_id = $modiIdUsuario									   					   
			        WHERE  id = $modiIdVenta
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
        $consulta ="DELETE FROM venta			                          
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

    public function contar()
    {   
        $conexion = new  conexion;
        $con=$conexion->crear_conexion();
        $consulta = "SELECT *
                     FROM venta
                    ";	
        $resuConsulta = $conexion->consulta_base_de_datos($con,$consulta);
        $datos = $conexion->contar_resultado($resuConsulta);
        $conexion->cerrar_conexion($con);
        return $datos;			
    }

    public function contarPorId($id)
    {   
        $conexion = new  conexion;
        $con=$conexion->crear_conexion();
        $consulta = "SELECT *
                     FROM venta
                     WHERE id = $id
                    ";	
        $resuConsulta = $conexion->consulta_base_de_datos($con,$consulta);
        $datos = $conexion->contar_resultado($resuConsulta);
        $conexion->cerrar_conexion($con);
        return $datos;			
    }

    public function Listar()
    {   
        $conexion = new  conexion;
        $con=$conexion->crear_conexion();
        $consulta = "SELECT v.id as id, v.cliente_id as cliente_id, v.usuario_id as usuario_id,
                        c.c_nombre as c_nombre, c.c_apellido as c_apellido, u.usuario as usuario
                     FROM venta v JOIN cliente c ON c.id = v.cliente_id
                                  JOIN usuario u ON u.id = v.usuario_id
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

    public function ListarUltima()
    {   
        $conexion = new  conexion;
        $con=$conexion->crear_conexion();
        $consulta = "SELECT v.id as id, v.cliente_id as cliente_id, v.usuario_id as usuario_id,
                    c.c_nombre as c_nombre, c.c_apellido as c_apellido, u.usuario as usuario
                     FROM venta v JOIN cliente c ON c.id = v.cliente_id
                                  JOIN usuario u ON u.id = v.usuario_id 
                                  order by id DESC
								  limit 1;
                    ";	
        $resuConsulta = $conexion->consulta_base_de_datos($con,$consulta);
        while($colu = mysqli_fetch_row($resuConsulta))
            {
	     		$datos[] = $colu;
            }
        $conexion->cerrar_conexion($con);
        return $datos;			
    }

    public function ListarUltimoId()
    {   
        $conexion = new  conexion;
        $con=$conexion->crear_conexion();
        $consulta = "SELECT @@identity AS id
                    ";	
        $resuConsulta = $conexion->consulta_base_de_datos($con,$consulta);
        while($colu = mysqli_fetch_row($resuConsulta))
            {
	     		$datos[] = $colu;
            }
        $conexion->cerrar_conexion($con);
        return $datos;			
    }

    public function ListarPorId($id)
    {
        // Conectar con la base de datos
        $conexion = new  conexion;
        $con=$conexion->crear_conexion();
        // Ejecutar la consulta SQL
        $consulta = "SELECT v.id as id, v.cliente_id as cliente_id, v.usuario_id as usuario_id,
                    c.c_nombre as c_nombre, c.c_apellido as c_apellido, u.usuario as usuario
                     FROM venta v JOIN cliente c ON c.id = v.cliente_id
                                  JOIN usuario u ON u.id = v.usuario_id
                     WHERE v.id = $id
                    ";
        $resuConsulta = $conexion->consulta_base_de_datos($con,$consulta);        
        while($colu = mysqli_fetch_row($resuConsulta))
            {
	     		$datos[] = $colu;
            }
        $conexion->cerrar_conexion($con);
        return $datos;			
    }

    public function Validar($id)
    {
        $conexion = new conexion;
        $con = $conexion->crear_conexion();
        $consulta = "SELECT *
                     FROM venta
			         WHERE id = $id 							
			        ";
        $resuConsulta = $conexion->consulta_base_de_datos($con,$consulta);
        $resultado = mysqli_fetch_row($resuConsulta);
        $conexion->cerrar_conexion($con);							 
  	    return $resultado;							 
    }

}