<?php 

require_once '../../config/config.class.php';
/**
* 
*/
class saldos
{
	var $con;
	function __construct()
	{
		$this->conexion = new config;
	}


	function GastosEmpresa( $fecha ) 
	{
		if( $con = $this->conexion->conectar() )
		{
			
			$sql 	= 	"SELECT SUM(total) as total FROM gastos 
						WHERE fecha BETWEEN ".$fecha." and now()";
			$res 	= 	$con ->query( $sql );
			$this->conexion->cerrar();
			return $res;
		}
	}


	function DepositosEmpresa( $fecha ) 
	{
		if( $con = $this->conexion->conectar() )
		{
			
			$sql 	= 	"SELECT SUM(monto) as total FROM depositos WHERE fecha BETWEEN $fecha and now();";
			$res 	= 	$con ->query( $sql );
			$this->conexion->cerrar();
			return $res;
		}
	}


	function Dia( $dia )
	{
		if( $con = $this->conexion->conectar() )
		{
			
			$sql 	= 	"SELECT ( date( now() ) - INTERVAL ".$dia." day ) as fecha";
			$res 	= 	$con ->query( $sql );
			$this->conexion->cerrar();
			return $res;
		}
	}


	function DepositoPersonas( $fecha1, $fecha2 )
	{
		if( $con = $this->conexion->conectar() )
		{
			
			$sql 	= 	"SELECT u.id, u.nombre,  SUM(d.monto) deposito FROM usuarios u INNER JOIN depositos d ON d.usuario = u.id  WHERE d.fecha BETWEEN '$fecha1' AND '$fecha2' GROUP BY  u.id, u.nombre ORDER BY deposito DESC";
			$res 	= 	$con ->query( $sql );
			$this->conexion->cerrar();
			return $res;
		}
	}


	function GastoPersonas( $fecha1, $fecha2, $id )
	{
		if( $con = $this->conexion->conectar() )
		{
			
			$sql 	= 	"SELECT u.id, u.nombre,g.fecha,  sum(g.total) as gasto FROM usuarios u INNER JOIN gastos g ON g.usuario = u.id WHERE (g.fecha BETWEEN '$fecha1' AND '$fecha2') AND u.id = $id  GROUP BY u.id, u.nombre, g.fecha";
			$res 	= 	$con ->query( $sql );
			$this->conexion->cerrar();
			return $res;
		}
	}


	function DepositoLocalidad( $fecha1, $fecha2 )
	{
		if( $con = $this->conexion->conectar() )
		{
			
			$sql 	= 	"SELECT l.id id, l.nombre nombre, SUM(d.monto) deposito FROM usuarios u INNER JOIN localidades as l ON l.id=u.localidad INNER JOIN depositos d ON d.usuario= u.id WHERE d.fecha BETWEEN '$fecha1' AND '$fecha2' GROUP BY l.id, l.nombre ORDER BY deposito DESC";
			$res 	= 	$con ->query( $sql );
			$this->conexion->cerrar();
			return $res;
		}
	}


	function GastoLocalidad( $fecha1, $fecha2, $id )
	{
		if( $con = $this->conexion->conectar() )
		{
			$sql 	= 	"SELECT l.id id, l.nombre nombre, SUM(g.total) gasto FROM usuarios u INNER JOIN localidades as l ON l.id=u.localidad INNER JOIN gastos g ON g.usuario=u.id WHERE g.fecha BETWEEN '$fecha1' AND '$fecha2' AND l.id = $id GROUP BY l.id, l.nombre";
			$res 	= 	$con ->query( $sql );
			$this->conexion->cerrar();
			return $res;
		}
	}
	
	
	function GastoDia()
	{
	    if( $con    =   $this->conexion->conectar() )
	    {
	        $sql    =   "SELECT SUM(total) as total FROM gastos WHERE MONTH(fecha) = MONTH(now()) AND DAY(fecha) = DAY(now()) AND YEAR(fecha) = YEAR(now())";
	        $res    =   $con->query( $sql );
	        $this->conexion->cerrar();
			return $res;
	    }
	}
	
	
	function GastoMes()
	{
	    if( $con    =   $this->conexion->conectar() )
	    {
	        $sql    =   "SELECT SUM(total) as total FROM gastos WHERE MONTH(fecha) = MONTH(now()) AND YEAR(fecha) = YEAR(now())";
	        $res    =   $con->query( $sql );
	        $this->conexion->cerrar();
			return $res;
	    }
	}
	
	
	function GastoAnio()
	{
	    if( $con    =   $this->conexion->conectar() )
	    {
	        $sql    =   "SELECT SUM(total) as total FROM gastos WHERE YEAR(fecha) = YEAR(now())";
	        $res    =   $con->query( $sql );
	        $this->conexion->cerrar();
			return $res;
	    }
	}
	
	
	function GastoSemana()
	{
	    if( $con    =   $this->conexion->conectar() )
	    {
	        $sql    =   "SELECT SUM(total) total FROM gastos WHERE day(fecha) BETWEEN (day(now()) - weekday(now())) AND day(now()) AND month(fecha) = month(now()) AND year(fecha) = year(now())";
	        $res    =   $con->query( $sql );
	        $this->conexion->cerrar();
			return $res;
	    }
	}
	
	
	function DepositoDia()
	{
	    if( $con    =   $this->conexion->conectar() )
	    {
	        $sql    =   "SELECT SUM(monto) as total FROM depositos WHERE MONTH(fecha) = MONTH(now()) AND DAY(fecha) = DAY(now()) AND YEAR(fecha) = YEAR(now())";
	        $res    =   $con->query( $sql );
	        $this->conexion->cerrar();
			return $res;
	    }
	}
	
	
	function DepositoSemana()
	{
	    if( $con    =   $this->conexion->conectar() )
	    {
	        $sql    =   "SELECT SUM(monto) total FROM depositos WHERE day(fecha) BETWEEN (day(now()) - weekday(now())) AND day(now()) AND month(fecha) = month(now()) AND year(fecha) = year(now())";
	        $res    =   $con->query( $sql );
	        $this->conexion->cerrar();
			return $res;
	    }
	}
	
	
	function DepositoMes()
	{
	    if( $con    =   $this->conexion->conectar() )
	    {
	        $sql    =   "SELECT SUM(monto) as total FROM depositos WHERE MONTH(fecha) = MONTH(now()) AND YEAR(fecha) = YEAR(now())";
	        $res    =   $con->query( $sql );
	        $this->conexion->cerrar();
			return $res;
	    }
	}
	
	
	function DepositoAnio()
	{
	    if( $con    =   $this->conexion->conectar() )
	    {
	        $sql    =   "SELECT SUM(monto) as total FROM depositos WHERE YEAR(fecha) = YEAR(now())";
	        $res    =   $con->query( $sql );
	        $this->conexion->cerrar();
			return $res;
	    }
	}


	function DepositoPersonasResumen(  )
	{
		if( $con = $this->conexion->conectar() )
		{
			
			$sql 	= 	"SELECT u.id, u.nombre,  SUM(d.monto) deposito, u.estado FROM usuarios u INNER JOIN depositos d ON d.usuario = u.id GROUP BY u.nombre, u.id ORDER BY u.estado";
			$res 	= 	$con ->query( $sql );
			$this->conexion->cerrar();
			return $res;
		}
	}


	function GastoPersonasResumen( $id )
	{
		if( $con = $this->conexion->conectar() )
		{
			
			$sql 	= 	"SELECT sum(g.total) as gasto FROM usuarios u INNER JOIN gastos g ON g.usuario = u.id WHERE  u.id = $id";
			$res 	= 	$con ->query( $sql );
			$this->conexion->cerrar();
			return $res;
		}
	}


	function DepositoPersonasDetalle( $usuario, $anio )
	{
		if( $con = $this->conexion->conectar() )
		{
			
			$sql 	= 	"SELECT 
						(
							SELECT SUM(monto) FROM depositos WHERE MONTH(fecha)=1 and usuario=$usuario and year(fecha)=$anio
						)Enero, 
						(
							SELECT SUM(monto) FROM depositos WHERE MONTH(fecha)=2 and usuario=$usuario and year(fecha)=$anio
						)Febrero,
						(
							SELECT SUM(monto) FROM depositos WHERE MONTH(fecha)=3 and usuario=$usuario and year(fecha)=$anio
						)Marzo,
						(
							SELECT SUM(monto) FROM depositos WHERE MONTH(fecha)=4 and usuario=$usuario and year(fecha)=$anio
						)Abril,
						(
							SELECT SUM(monto) FROM depositos WHERE MONTH(fecha)=5 and usuario=$usuario and year(fecha)=$anio
						)Mayo,
						(
							SELECT SUM(monto) FROM depositos WHERE MONTH(fecha)=6 and usuario=$usuario and year(fecha)=$anio
						)Junio, 
						(
							SELECT SUM(monto) FROM depositos WHERE MONTH(fecha)=7 and usuario=$usuario and year(fecha)=$anio
						)Julio,
						(
							SELECT SUM(monto) FROM depositos WHERE MONTH(fecha)=8 and usuario=$usuario and year(fecha)=$anio
						)Agosto,
						(
							SELECT SUM(monto) FROM depositos WHERE MONTH(fecha)=9 and usuario=$usuario and year(fecha)=$anio
						)Septiembre, 
						(
							SELECT SUM(monto) FROM depositos WHERE MONTH(fecha)=10 and usuario=$usuario and year(fecha)=$anio
						)Octubre,
						(
							SELECT SUM(monto) FROM depositos WHERE MONTH(fecha)=11 and usuario=$usuario and year(fecha)=$anio
						)Noviembre, 
						(
							SELECT SUM(monto) FROM depositos WHERE MONTH(fecha)=12 and usuario=$usuario and year(fecha)=$anio
						)Diciembre ";
			$res 	= 	$con ->query( $sql );
			$this->conexion->cerrar();
			return $res;
		}
	}


	function GastoPersonasDetalle( $usuario, $anio )
	{
		if( $con = $this->conexion->conectar() )
		{
			
			$sql 	= 	"SELECT 
						(
							SELECT SUM(total) FROM gastos WHERE MONTH(fecha)=1 and usuario=$usuario and year(fecha)=$anio
						)Enero, 
						(
							SELECT SUM(total) FROM gastos WHERE MONTH(fecha)=2 and usuario=$usuario and year(fecha)=$anio
						)Febrero,
						(
							SELECT SUM(total) FROM gastos WHERE MONTH(fecha)=3 and usuario=$usuario and year(fecha)=$anio
						)Marzo,
						(
							SELECT SUM(total) FROM gastos WHERE MONTH(fecha)=4 and usuario=$usuario and year(fecha)=$anio
						)Abril,
						(
							SELECT SUM(total) FROM gastos WHERE MONTH(fecha)=5 and usuario=$usuario and year(fecha)=$anio
						)Mayo,
						(
							SELECT SUM(total) FROM gastos WHERE MONTH(fecha)=6 and usuario=$usuario and year(fecha)=$anio
						)Junio, 
						(
							SELECT SUM(total) FROM gastos WHERE MONTH(fecha)=7 and usuario=$usuario and year(fecha)=$anio
						)Julio,
						(
							SELECT SUM(total) FROM gastos WHERE MONTH(fecha)=8 and usuario=$usuario and year(fecha)=$anio
						)Agosto,
						(
							SELECT SUM(total) FROM gastos WHERE MONTH(fecha)=9 and usuario=$usuario and year(fecha)=$anio
						)Septiembre, 
						(
							SELECT SUM(total) FROM gastos WHERE MONTH(fecha)=10 and usuario=$usuario and year(fecha)=$anio
						)Octubre,
						(
							SELECT SUM(total) FROM gastos WHERE MONTH(fecha)=11 and usuario=$usuario and year(fecha)=$anio
						)Noviembre, 
						(
							SELECT SUM(total) FROM gastos WHERE MONTH(fecha)=12 and usuario=$usuario and year(fecha)=$anio
						)Diciembre ";
			$res 	= 	$con ->query( $sql );
			$this->conexion->cerrar();
			return $res;
		}
	}
}

 ?>