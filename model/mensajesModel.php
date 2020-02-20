<?php

class Mensaje{
	//atributos

public function RegistroExitoso()
{
		$mensaje = " <label style='color:#008000'>REGISTRO EXITOSO.</label> ";					 
		return $mensaje;							 
}

public function RegistroNoExitoso()
{
		$mensaje = " <label style='color:#FF0000'>ERROR DEL SISTEMA, COMUNICATE CON TU ASESOR.</label> ";					 
		return $mensaje;							 
}
public function IngresarTodo()
{
		$mensaje = " <label style='color:#FF0000'>INGRESAR TODOS LOS DATOS.</label> ";					 
		return $mensaje;							 
}

public function ConexionExitoso()
{
		$mensaje = " <label style='color:#008000'>REGISTRO EXITOSO.</label> ";					 
		return $mensaje;							 
}

public function ConexionNoExitosa()
{
		$mensaje = " <label style='color:#FF0000'>CONEXIÓN NO EXITOSA.</label> ";					 
		return $mensaje;							 
}

public function contrasenaIncorrecta()
{
		$mensaje = " <label style='color:#FF0000'>CONTRASEÑA INCORRECTA.</label> ";					 
		return $mensaje;							 
}

public function RegistroModificado()
{
		$mensaje = " <label style='color:#008000'>REGISTRO MODIFICADO.</label> ";					 
		return $mensaje;							 
}

public function RegistroNoModificado()
{
		$mensaje = " <label style='color:#FF0000'>ERROR DEL SISTEMA, COMUNICATE CON TU ASESOR.</label> ";					 
		return $mensaje;							 
}

public function RegistroEliminado()
{
		$mensaje = " <label style='color:#008000'>REGISTRO ELIMINADO.</label> ";					 
		return $mensaje;							 
}

public function RegistroNoEliminado()
{
		$mensaje = " <label style='color:#FF0000'>ERROR DEL SISTEMA, COMUNICATE CON TU ASESOR.</label> ";					 
		return $mensaje;							 
}

public function RegistroExistente()
{
		$mensaje = " <label style='color:#FF0000'>YA ESTA REGISTRADO.</label> ";					 
		return $mensaje;							 
}

public function RegistroNoExistente()
{
		$mensaje = " <label style='color:#FF0000'>NO SE HAN ENCONTRADO REGISTROS.</label> ";					 
		return $mensaje;							 
}


}

?>