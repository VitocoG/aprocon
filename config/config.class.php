<?php
class config
{
	var $servidor;
	var $usuario;
	var $pass;
	var $bd;
	var $con;
	
	function __construct()
	{
		$this->bd 		=	"depositos";
		$this->pass 	=	"";
		$this->servidor =	"localhost";
		$this->usuario 	=	"root";
	}
	
	function conectar()
	{
		if( $con = mysqli_connect( $this->servidor, $this->usuario, $this->pass,$this->bd ) )
			{
				return $con;
			}
			else
			{
				echo "no se conecto la bd";
			}
	}
	
	
	function cerrar()
			{
				mysqli_close( mysqli_connect( $this->servidor, $this->usuario, $this->pass,$this->bd ) );
			}
		}
?>