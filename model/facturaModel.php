<?php
require_once("conectar_BD.php");

class FacturaModel{

    public function Registrar($venta_id,$producto_id,$cantidad,$fecha)
    {

        // Conectar con la base de datos
        $conexion = new conexion;
        $con = $conexion->crear_conexion();
        // Ejecutar la consulta SQL
        $consulta = "INSERT INTO factura (venta_id,producto_id,cantidad,fecha) VALUES(
								 '$venta_id',	
								 '$producto_id',
                                 '$cantidad',
                                 '$fecha'
								 )";
        $resuConsulta = $conexion->consulta_base_de_datos($con,$consulta);
            $conexion->cerrar_conexion($con);
	        return $resuConsulta;					
    }

    public function Modificar($id,$venta_id,$producto_id,$cantidad,$fecha)
    {
	    $conexion = new conexion;
	    $con = $conexion->crear_conexion();
	    $consulta ="UPDATE factura
	                SET    venta_id = '$venta_id',
                           producto_id = '$producto_id',
                           cantidad = '$cantidad',
                           fecha = '$fecha'						   					   
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
        $consulta ="DELETE FROM factura			                          
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
                     FROM factura 
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
        $consulta = "SELECT f.id as id, CONCAT(c.c_nombre,' ',c.c_apellido) as cliente,
                            u.usuario,f.fecha as fecha, p.p_nombre as producto_nombre,
                            p.precio as precio, f.cantidad as cantidad,
                            (p.precio * f.cantidad) as total
        FROM factura f JOIN venta v ON v.id = f.venta_id
                                     JOIN producto p ON p.id = f.producto_id
                                     JOIN usuario u ON u.id = v.usuario_id
                                     JOIN cliente c ON c.id = v.cliente_id
				     GROUP BY v.id DESC
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

    public function ListarVenta()
    {   
        $conexion = new  conexion;
        $con=$conexion->crear_conexion();
        $consulta = "SELECT f.id as id, CONCAT(c.c_nombre,' ',c.c_apellido) as cliente,
                            u.usuario,f.fecha as fecha, p.p_nombre as producto_nombre,
                            p.precio as precio, f.cantidad as cantidad,
                            (p.precio * f.cantidad) as total
                     FROM factura f JOIN venta v ON v.id = f.venta_id
                                    JOIN producto p ON p.id = f.producto_id
                                    JOIN usuario u ON u.id = v.usuario_id
                                    JOIN cliente c ON c.id = v.cliente_id
                     WHERE v.id = (select max(v2.id) from venta v2)
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

    public function ListarVentaPorId($id)
    {   
        $conexion = new  conexion;
        $con=$conexion->crear_conexion();
        $consulta = "SELECT f.id as id, CONCAT(c.c_nombre,' ',c.c_apellido) as cliente,
                            u.usuario,f.fecha as fecha, p.p_nombre as producto_nombre,
                            p.precio as precio, f.cantidad as cantidad,
                            (p.precio * f.cantidad) as total
                     FROM factura f JOIN venta v ON v.id = f.venta_id
                                    JOIN producto p ON p.id = f.producto_id
                                    JOIN usuario u ON u.id = v.usuario_id
                                    JOIN cliente c ON c.id = v.cliente_id
                     WHERE v.id = $id
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

    public function ListarVentas()
    {   
        $conexion = new  conexion;
        $con=$conexion->crear_conexion();
        $consulta = "SELECT v.id as id, concat(c.c_nombre,' ',c.c_apellido) as cliente, u.usuario as usuario, f.fecha as fecha, SUM(f.cantidad * p.precio) as venta
                     FROM factura f JOIN venta v ON v.id = f.venta_id
                                    JOIN producto p ON p.id = f.producto_id
                                    JOIN usuario u ON u.id = v.usuario_id
                                    JOIN cliente c ON c.id = v.cliente_id
                     GROUP BY v.id DESC
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

    public function ListarVentasPorFecha($fecha)
    {   
        $conexion = new  conexion;
        $con=$conexion->crear_conexion();
        $consulta = "SELECT v.id as id, concat(c.c_nombre, c.c_apellido) as cliente, u.usuario as usuario, f.fecha as fecha, SUM(f.cantidad * p.precio) as venta
                     FROM factura f JOIN venta v ON v.id = f.venta_id
                                    JOIN producto p ON p.id = f.producto_id
                                    JOIN usuario u ON u.id = v.usuario_id
                                    JOIN cliente c ON c.id = v.cliente_id
                     WHERE f.fecha = '$fecha'
                     GROUP BY v.id DESC
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

    public function ListarVentasPorFechas($fechaInicial,$fechaFinal)
    {   
        $conexion = new  conexion;
        $con=$conexion->crear_conexion();
        $consulta = "SELECT v.id as id, concat(c.c_nombre, c.c_apellido) as cliente, u.usuario as usuario, f.fecha as fecha, SUM(f.cantidad * p.precio) as venta
                     FROM factura f JOIN venta v ON v.id = f.venta_id
                                    JOIN producto p ON p.id = f.producto_id
                                    JOIN usuario u ON u.id = v.usuario_id
                                    JOIN cliente c ON c.id = v.cliente_id
                     WHERE f.fecha BETWEEN '$fechaInicial' AND '$fechaFinal'
                     GROUP BY v.id DESC
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

    public function ListarPorId($id)
    {   
        $conexion = new  conexion;
        $con=$conexion->crear_conexion();
        $consulta = "SELECT f.id as id, CONCAT(c.c_nombre,' ',c.c_apellido) as cliente,
                            c.id as cliente_id,u.usuario,f.fecha as fecha,
                            p.p_nombre as producto_nombre, p.id as producto_id,u.id as usuario_id,
                            p.precio as precio, f.cantidad as cantidad,(p.precio * f.cantidad) as total,v.id as venta_id
                     FROM factura f JOIN venta v ON v.id = f.venta_id
                                    JOIN producto p ON p.id = f.producto_id
                                    JOIN usuario u ON u.id = v.usuario_id
                                    JOIN cliente c ON c.id = v.cliente_id
                    WHERE f.id = $id
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
?>