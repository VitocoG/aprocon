<?php
require_once '../../config/config.class.php';

class saldos
{
    var $con;

    function __construct()
    {   
        $this->conexion     =   new config;
    }

    function GastoAnio()
    {
        if( $con    =   $this->conexion->conectar() ):
            $sql    =   "SELECT SUM(total) total
                        FROM gastos
                        WHERE fecha LIKE '%".date('Y')."%'";
            $res    =   $con->query( $sql );
            $this->conexion->cerrar();
            foreach( $res as $value ):
                return $value['total'];
            endforeach;
        else:
        endif;
    }

    function GastoMes()
    {
        if( $con    =   $this->conexion->conectar() ):
            $sql    =   "SELECT SUM(total) total
                        FROM gastos
                        WHERE fecha LIKE '%".date('Y-m')."%'";
            $res    =   $con->query( $sql );
            $this->conexion->cerrar();
            foreach( $res as $value ):
                return $value['total'];
            endforeach;
        else:
        endif;
    }

    

    function GastoDia()
    {
        if( $con    =   $this->conexion->conectar() ):
            $sql    =   "SELECT SUM(total) total
                        FROM gastos
                        WHERE fecha = '".date('Y-m-d')."'";
            $res    =   $con->query( $sql );
            $this->conexion->cerrar();
            foreach( $res as $value ):
                return $value['total'];
            endforeach;
        else:
        endif;
    }

    

    function GastoSemana()
    {
        if( $con    =   $this->conexion->conectar() ):
            $sql    =   "SELECT 
                            SUM(total) total
                        FROM gastos
                        WHERE day(fecha)
                        BETWEEN ( DAY(NOW()) - WEEKDAY(NOW()))
                        AND  day(fecha) and fecha LIKE '%".date('Y-m')."%'";
            $res    =   $con->query( $sql );
            $this->conexion->cerrar();
            foreach( $res as $value ):
                return $value['total'];
            endforeach;
        else:
        endif;
    }

    

    function DepositoAnio()
    {
        if( $con    =   $this->conexion->conectar() ):
            $sql    =   "SELECT SUM(monto) total
                        FROM depositos
                        WHERE fecha LIKE '%".date('Y')."%'";
            $res    =   $con->query( $sql );
            $this->conexion->cerrar();
            foreach( $res as $value ):
                return $value['total'];
            endforeach;
        else:
        endif;
    }

    

    function DepositoMes()
    {
        if( $con    =   $this->conexion->conectar() ):
            $sql    =   "SELECT SUM(monto) total
                        FROM depositos
                        WHERE fecha LIKE '%".date('Y-m')."%'";
            $res    =   $con->query( $sql );
            $this->conexion->cerrar();
            foreach( $res as $value ):
                return $value['total'];
            endforeach;
        else:
        endif;
    }

    

    function DepositoSemana()
    {
        if( $con    =   $this->conexion->conectar() ):
            $sql    =   "SELECT SUM(monto) total
                        FROM depositos
                        WHERE day(fecha)
                        BETWEEN ( DAY(NOW()) - WEEKDAY(NOW()))
                        AND  day(fecha) and fecha LIKE '%".date('Y-m')."%'";
            $res    =   $con->query( $sql );
            $this->conexion->cerrar();
            foreach( $res as $value ):
                return $value['total'];
            endforeach;
        else:
        endif;
    }

    

    function Depositodia()
    {
        if( $con    =   $this->conexion->conectar() ):
            $sql    =   "SELECT SUM(monto) total
                        FROM depositos
                        WHERE fecha = '".date('Y-m')."'";
            $res    =   $con->query( $sql );
            $this->conexion->cerrar();
            foreach( $res as $value ):
                return $value['total'];
            endforeach;
        else:
        endif;
    }

    

    

    function DepositosRangoLocalidad( $localidad, $inicio, $termino)
    {
        if( $con    =   $this->conexion->conectar() ):
            $sql    =   "SELECT SUM(monto) total
                        FROM usuarios
                        JOIN localidades
                            ON localidades.id = usuarios.localidad
                        JOIN depositos
                            ON depositos.usuario = usuarios.id
                        WHERE localidades.id = $localidad
                        AND (fecha BETWEEN '$inicio' AND '$termino')";
            $res    =   $con->query( $sql );
            $this->conexion->cerrar();
            foreach( $res as $value ):
            endforeach;
                return $value['total'];
        else:
        endif;
    }

    

    

    function GastosRangoLocalidad( $localidad, $inicio, $termino)
    {
        if( $con    =   $this->conexion->conectar() ):
            $sql    =   "SELECT SUM(total) total
                        FROM usuarios
                        JOIN localidades
                            ON localidades.id = usuarios.localidad
                        JOIN gastos
                            ON gastos.usuario = usuarios.id
                        WHERE localidades.id = $localidad
                        AND (fecha BETWEEN '$inicio' AND '$termino')";
            $res    =   $con->query( $sql );
            $this->conexion->cerrar();
            foreach( $res as $value ):
            endforeach;
                return $value['total'];
        else:
        endif;
    }

    

    

    function DepositosMesesLocalidad( $localidad, $anio, $mes)
    {
        if( $con    =   $this->conexion->conectar() ):
            $sql    =   "SELECT 
                            SUM(depositos.monto) total
                        FROM usuarios
                        JOIN localidades
                            ON localidades.id = usuarios.localidad
                        JOIN depositos
                            ON depositos.usuario = usuarios.id
                        WHERE localidades.id = $localidad
                        AND fecha LIKE '%".$anio."-".$mes."%';";
            $res    =   $con->query( $sql );
            $this->conexion->cerrar();
            foreach( $res as $value ):
            endforeach;
            return $value['total'];
        else:
        endif;
    }

    

    

    function GastosMesesLocalidad( $localidad, $anio, $mes)
    {
        if( $con    =   $this->conexion->conectar() ):
            $sql    =   "SELECT 
                            SUM(gastos.total) total
                        FROM usuarios
                        JOIN localidades
                            ON localidades.id = usuarios.localidad
                        JOIN gastos
                            ON gastos.usuario = usuarios.id
                        WHERE localidades.id = $localidad
                        AND fecha LIKE '%".$anio."-".$mes."%';";
            $res    =   $con->query( $sql );
            $this->conexion->cerrar();
            foreach( $res as $value ):
            endforeach;
            return $value['total'];
        else:
        endif;
    }

    

    

    function DepositosAniosLocalidad( $localidad, $anio )
    {
        if( $con    =   $this->conexion->conectar() ):
            $sql    =   "SELECT 
                            SUM(depositos.monto) total
                        FROM usuarios
                        JOIN localidades
                            ON localidades.id = usuarios.localidad
                        JOIN depositos
                            ON depositos.usuario = usuarios.id
                        WHERE localidades.id = $localidad
                        AND fecha LIKE '%".$anio."%';";
            $res    =   $con->query( $sql );
            $this->conexion->cerrar();
            foreach( $res as $value ):
            endforeach;
            return $value['total'];
        else:
        endif;
    }

    

    

    function GastosAniosLocalidad( $localidad, $anio )
    {
        if( $con    =   $this->conexion->conectar() ):
            $sql    =   "SELECT 
                            SUM(gastos.total) total
                        FROM usuarios
                        JOIN localidades
                            ON localidades.id = usuarios.localidad
                        JOIN gastos
                            ON gastos.usuario = usuarios.id
                        WHERE localidades.id = $localidad
                        AND fecha LIKE '%".$anio."%';";
            $res    =   $con->query( $sql );
            $this->conexion->cerrar();
            foreach( $res as $value ):
            endforeach;
            return $value['total'];
        else:
        endif;
    }

    

    

    function DepositosRangoUsuarios( $usuario, $inicio, $termino)
    {
        if( $con    =   $this->conexion->conectar() ):
            $sql    =   "SELECT SUM(monto) total
                        FROM usuarios
                        JOIN depositos
                            ON depositos.usuario = usuarios.id
                        WHERE usuarios.id = $usuario
                        AND (fecha BETWEEN '$inicio' AND '$termino')";
            $res    =   $con->query( $sql );
            $this->conexion->cerrar();
            foreach( $res as $value ):
            endforeach;
                return $value['total'];
        else:
        endif;
    }

    

    

    function GastosRangoUsuarios( $usuario, $inicio, $termino)
    {
        if( $con    =   $this->conexion->conectar() ):
            $sql    =   "SELECT SUM(total) total
                        FROM usuarios
                        JOIN gastos
                            ON gastos.usuario = usuarios.id
                        WHERE usuarios.id = $usuario
                        AND (fecha BETWEEN '$inicio' AND '$termino')";
            $res    =   $con->query( $sql );
            $this->conexion->cerrar();
            foreach( $res as $value ):
            endforeach;
                return $value['total'];
        else:
        endif;
    }

    

    

    function DepositosMesesUsuario( $usuario, $anio, $mes)
    {
        if( $con    =   $this->conexion->conectar() ):
            $sql    =   "SELECT 
                            SUM(depositos.monto) total
                        FROM usuarios
                        JOIN depositos
                            ON depositos.usuario = usuarios.id
                        WHERE usuarios.id = $usuario
                        AND fecha LIKE '%".$anio."-".$mes."%';";
            $res    =   $con->query( $sql );
            $this->conexion->cerrar();
            foreach( $res as $value ):
            endforeach;
            return $value['total'];
        else:
        endif;
    }






    function GastosMesesUsuario( $usuario, $anio, $mes )
    {
        if( $con    =   $this->conexion->conectar() ):
            $sql    =   "SELECT 
                            SUM(gastos.total) total
                        FROM usuarios
                        JOIN gastos
                            ON gastos.usuario = usuarios.id
                        WHERE usuarios.id = $usuario
                        AND fecha LIKE '%".$anio."-".$mes."%';";
            $res    =   $con->query( $sql );
            $this->conexion->cerrar();
            foreach( $res as $value ):
            endforeach;
            return $value['total'];
        else:
        endif;
    }

    

    

    function DepositosAniosUsuario( $usuario, $anio )
    {
        if( $con    =   $this->conexion->conectar() ):
            $sql    =   "SELECT 
                            SUM(depositos.monto) total
                        FROM usuarios
                        JOIN depositos
                            ON depositos.usuario = usuarios.id
                        WHERE usuarios.id = $usuario
                        AND fecha LIKE '%".$anio."%';";
            $res    =   $con->query( $sql );
            $this->conexion->cerrar();
            foreach( $res as $value ):
            endforeach;
            return $value['total'];
        else:
        endif;
    }

    

    

    function GastosAniosUsuario( $usuario, $anio )
    {
        if( $con    =   $this->conexion->conectar() ):
            $sql    =   "SELECT 
                            SUM(gastos.total) total
                        FROM usuarios
                        JOIN gastos
                            ON gastos.usuario = usuarios.id
                        WHERE usuarios.id = $usuario
                        AND fecha LIKE '%".$anio."%';";
            $res    =   $con->query( $sql );
            $this->conexion->cerrar();
            foreach( $res as $value ):
            endforeach;
            return $value['total'];
        else:
        endif;
    }
    
}
