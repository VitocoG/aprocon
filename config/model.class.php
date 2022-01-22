<?php 
require_once( 'config.class.php' );

class model
{
	var $con;

	function __construct()
	{
		$this->conexion = new config;
	}

	function ShowAll( $clase, $condicion )
	{
		if ( $con 	= $this->conexion->conectar() )
		 {
			$sql 	= "SELECT * FROM $clase $condicion";
			$res 	= $con->query( $sql );
			$this->conexion->cerrar();
			return $res;
		}
		else 
		{
			echo "no se pudo listar ShowAll $clase";
		}
	}

	function Create( $clase, $datos )
	{
		$key		=	array_keys( $datos );
		$value		=	array_values( $datos );

		$llave 		=	implode( ", ", $key );
		$valores	= 	implode( "', '", $value );

		if ( $con 	= $this->conexion->conectar() )
		 {
			$sql 	= 	"INSERT INTO $clase ( $llave ) VALUES( '".$valores."' )";
			$res 	= 	$con->query( $sql );
			$this->conexion->cerrar();
			return $sql;
		}
		else 
		{
			echo"no se pudo crear Create $clase";
		}
	}

	function ShowById( $clase, $id )
	{
		if ( $con 	=	$this->conexion->conectar() )
		 {
			$sql	=	"SELECT * FROM $clase WHERE id = $id";
			$res	=	$con->query( $sql );
			$this->conexion->cerrar();
			//return $res;
			foreach( $res as $value ):
			endforeach;
			
			return $value;
		}
		else 
		{
			echo"no se pudo ShowById $clase";
		}
	}

	function Update( $clase, $datos, $id )
	{
		$llave		= 	array_keys( $datos );
		$valores	=	array_values( $datos );

		if ( $con 	=	$this->conexion->conectar() )
		 {
		 	for ( $i = 0; $i < count( $datos ); $i++ )
		 	{ 
		 		$sql	=	"UPDATE $clase SET  $llave[$i] = '".$valores[$i]."'  WHERE id = $id";
			$res	=	$con->query( $sql );
		 	}
			$this->conexion->cerrar();
			return $res;
		}
		else 
		{
			echo "no se pudo Update $clase";
		}
	}

	function Delete( $clase, $id )
	{
		if ( $con 	=	$this->conexion->conectar() )
		 {
			$sql	=	"DELETE FROM $clase WHERE id = $id";
			$res	=	$con->query( $sql );
			$this->conexion->cerrar();
			return $res;
		}
		else 
		{
			echo "no se pudo Delete $clase";
		}
	}

	function SelectByKey( $clase, $llave, $valor, $condicion )
	{
		if ( $con 	=	$this->conexion->conectar() )
		{
			$sql	=	"SELECT * FROM $clase WHERE $llave='".$valor."' $condicion";
			$res 	=	$con->query( $sql );
			$this->conexion->cerrar();
			return $res;
		}
		else
		{
			echo "no se puede SelectByKey $clase";
		}
	}

	

	function Permisos( $llave,  $valor )
	{
		if ( $con 	=	$this->conexion->conectar() ):
			$sql	=	"SELECT $llave FROM permisos WHERE persona = $valor";
			$res 	=	$con->query( $sql );
			$this->conexion->cerrar();
			return $res;
		else:
			echo "no se puede Permisos";
		endif;
	}
}
 ?>