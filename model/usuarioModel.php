<?php
require_once("conectar_BD.php");

class UsuarioModel{

    public function Registrar($usuario,$contrasena)
    {

        // Conectar con la base de datos
        $conexion = new conexion;
        $con = $conexion->crear_conexion();
        // Ejecutar la consulta SQL
        $consulta = "INSERT INTO usuario (usuario,contrasena) VALUES(
								 '$usuario',	
								 '$contrasena'								
								 )";
        $resuConsulta = $conexion->consulta_base_de_datos($con,$consulta);
            $conexion->cerrar_conexion($con);
	        return $resuConsulta;					
    }

    public function Modificar($id,$usuario,$contrasena)
    {
	    $conexion = new conexion;
	    $con = $conexion->crear_conexion();
	    $consulta ="UPDATE usuario
	                SET    usuario = '$usuario',
                           contrasena = '$contrasena'									   					   
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
        $consulta ="DELETE FROM usuario			                          
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
        $consulta = "SELECT id, usuario, contrasena
                     FROM usuario 
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
        $consulta = "SELECT id, usuario, contrasena
                     FROM usuario 
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
                     FROM usuario 
                    ";	
        $resuConsulta = $conexion->consulta_base_de_datos($con,$consulta);
        $datos = $conexion->contar_resultado($resuConsulta);
        $conexion->cerrar_conexion($con);
        return $datos;			
    }

    public function ListarPorUsuario($usuario)
    {   
        $conexion = new  conexion;
        $con=$conexion->crear_conexion();
        $consulta = "SELECT id, usuario, contrasena
                     FROM usuario 
				     WHERE usuario = '$usuario'
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
        $consulta = "SELECT id, usuario, contrasena
                     FROM usuario
				     WHERE id = '$id'
                    ";	
        $resuConsulta = $conexion->consulta_base_de_datos($con,$consulta);
        while($colu = mysqli_fetch_row($resuConsulta))
            {
	     		$datos[] = $colu;
			}
        $conexion->cerrar_conexion($con);
        return $datos;			
    }

    public function Validar($usuario,$contrasena)
    {
        $conexion = new conexion;
        $con = $conexion->crear_conexion();
        $consulta = "SELECT *
                     FROM usuario
			         WHERE usuario = '$usuario' AND contrasena = '$contrasena'							
			        ";
        $resuConsulta = $conexion->consulta_base_de_datos($con,$consulta);
        $resultado = mysqli_fetch_row($resuConsulta);
        $conexion->cerrar_conexion($con);							 
  	    return $resultado;							 
    }

}