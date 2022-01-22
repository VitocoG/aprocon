<?php 
  require_once '../../config/core.class.php';
  require_once'ods.class.php';
  $core   =   new core;
  $ods    =   new ods;
  
  
  
//     #####   OBTENER FECHAS A CONSULTAR  #####        
$fecha1  =   ( isset( $_REQUEST['fecha1'] ) ) ?  ( $_REQUEST['fecha1'] ) : (date( 'Y-m' ).'-01');
$fecha2  =   ( isset( $_REQUEST['fecha1'] ) ) ?  $_REQUEST['fecha2'] : (date( 'Y-m-d') ) ;
$rangoDeTiempo =  ( $fecha1 == $fecha2 ) ? (" horaInicio LIKE '".$fecha2."%' ") : ("horaInicio BETWEEN '".$fecha1."' AND '".$fecha2."'");
// -----------------------------------------------------------------------------------------------------  

//     #####   RECLAMOS    #####
$reclamos              =   number_format( 10 );
$reclamosPorcentaje    =     number_format( $reclamos * 10, 1); 
  
// #################################################    INS CONTRATISTA     #############################################
//  #####   SE CALCULA EL INS EN REDES #####
// OBTENER TOTAL DE ORDENES  
$hidraulicas           =   $ods->contar_ods( $rangoDeTiempo, 1 );  
// OBTENER TOTAL ORDENES QUE CUMPLEN
$condicion                  =   $rangoDeTiempo." AND cumplimiento_contratista=1";
$hidraulicas_cumplen   =   $ods->contar_ods_cumplen( $condicion, 1 );
//  CALCULAR CUMPLIMIENTO
$redesPorcentaje       =   ( $hidraulicas == 0 ) ? 0 : number_format( ( $hidraulicas_cumplen * 100 ) /$hidraulicas );
$redes                 =    ( $hidraulicas == 0 ) ? 0 : number_format( ($hidraulicas_cumplen/$hidraulicas )*60);
//-----------------------------------------------------------------------------------------------------


//  #####   SE CALCULA EL INS EN COMPLEMENTARIAS #####
// OBTENER TOTAL DE ORDENES
$civiles                =   $ods->contar_ods( $rangoDeTiempo, 2 );   
// OBTENER TOTAL ORDENES QUE CUMPLEN   
$civiles_cumplen        =   $ods->contar_ods_cumplen( $condicion, 2 );
//  CALCULAR CUMPLIMIENTO
$complementarias        =   ( $civiles == 0 ) ? 0 : number_format( ( $civiles_cumplen/$civiles )*30 );
$complementariasPorcentaje=   ( $civiles == 0 ) ? 0 :    number_format( ( $civiles_cumplen * 100 ) /$civiles , 1 );
//------------------------------------------------------------------------------------------------------


//  #####   SE CALCULA EL INS EN CONTRATISTA #####
// OBTENER TOTAL DE ORDENES
$totalOrdenes           =   number_format($civiles + $hidraulicas);
// OBTENER TOTAL ORDENES QUE CUMPLEN
$totalCumplen          =   number_format($civiles_cumplen + $hidraulicas_cumplen);
$insContratista         =   number_format($redes + $complementarias + $reclamos);
$insContratistaPorcentaje=  number_format($insContratista * 100, 1);
//------------------------------------------------------------------------------------------------------


// #################################################    INS ESSBIO     #############################################
//  #####   SE CALCULA EL INS EN COMPLEMENTARIAS #####
// OBTENER TOTAL ORDENES QUE CUMPLEN
$condicionIto                  =   $rangoDeTiempo." AND cumplimiento_ito=1";
$civiles_cumplen_ito        =   $ods->contar_ods_cumplen_ito( $condicionIto, 2 );
//  CALCULAR CUMPLIMIENTO
$complementarias_ito        =   ( $civiles == 0 ) ? 0 : number_format( ( $civiles_cumplen_ito/$civiles )*30 );
$complementarias_itoPorcentaje=   ( $civiles == 0 ) ? 0 : number_format( ( $civiles_cumplen_ito * 100 ) /$civiles , 1 );
//-----------------------------------------------------------------------------------------------------


//  #####   SE CALCULA EL INS EN REDES #####
// OBTENER TOTAL ORDENES QUE CUMPLEN
$condicionIto                  =   $rangoDeTiempo." AND cumplimiento_ito=1";
$hidraulicas_cumplen_ito   =   $ods->contar_ods_cumplen_ito( $condicionIto, 1 );
//  CALCULAR CUMPLIMIENTO
   $redes_ito                 =   ( $hidraulicas == 0 ) ? 0 : number_format( ( $hidraulicas_cumplen_ito/$hidraulicas )*60 );
   $redes_itoPorcentaje       =   ( $hidraulicas == 0 ) ? 0 : number_format( ( $hidraulicas_cumplen_ito * 100 ) /$hidraulicas , 1 );
//-----------------------------------------------------------------------------------------------------


//  #####   SE CALCULA EL INS ESSBIO #####
// OBTENER TOTAL DE ORDENES
// OBTENER TOTAL ORDENES QUE CUMPLEN
$totalCumplenIto          =   number_format($civiles_cumplen_ito + $hidraulicas_cumplen_ito);
$insIto                  =   number_format($complementarias_ito + $redes_ito + $reclamos);
$insItoPorcentaje           =  number_format($insContratista * 100, 1);
//------------------------------------------------------------------------------------------------------

//     #####   SUMA INS TOTAL  #####
$totalINS_ito                 =   number_format( $complementarias_ito + $redes_ito + 10 ); 
?>

<!DOCTYPE html>
<html lang="es">

<head>
	<title>Bar Chart</title>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>
	<script src="../../public/js/util.js"></script>
	<style>
	  canvas 
    {
		  -moz-user-select: none;
		  -webkit-user-select: none;
		  -ms-user-select: none;
	  }
	</style>
</head>



<body>
<div class="container">

 
    
    <div class="row">
	<form action="" method="post">
      <div class="col-md-2">
        <div class="form-group">
        	<input type="date" name="fecha1" class="form-control" required value="<?php echo $fecha1 ?>">
        </div>
      </div>


      <div class="col-md-2">
        <div class="input-group">
			    <input type="date" name="fecha2" class="form-control" required value="<?php echo $fecha2 ?>">
          <span class="input-group-btn">
            <button class="btn btn-warning" type="submit">Buscar</button>
          </span>
        </div>
      </div>

	  <div class="col-md-1">
    <p> </p>
	  </div> 



      <div class="col-md-5">
        <canvas id="canvas"></canvas>
      </div>
    </div>
	</form>



    <script>
		var color = Chart.helpers.color;
		var barChartData = {
			labels: ['Total', 'Redes', 'Complementarias', 'Reclamos'],
			datasets: [{
				label: 'Aprocon',
				backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
				borderColor: window.chartColors.red,
				borderWidth: 1,
				data: [ <?php echo $insContratista  ?>, <?php echo $redesPorcentaje ?>, <?php echo $complementariasPorcentaje ?>, <?php echo $reclamosPorcentaje ?> ]
			}, {
				label: 'Essbio',
				backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
				borderColor: window.chartColors.blue,
				borderWidth: 1,
				data: [ <?php echo $insIto ?>, <?php echo $redes_itoPorcentaje ?>, <?php echo $complementarias_itoPorcentaje ?>, <?php echo $reclamosPorcentaje ?> ]
			}]

		};

        window.onload = function() 
        {
			var ctx = document.getElementById('canvas').getContext('2d');
            window.myBar = new Chart(ctx, 
            {
				type: 'bar',
				data: barChartData,
                options: 
                {
					responsive: true,
                    legend: 
                    {
						position: 'top',
					},
                    title: 
                    {
						display: true,
						text: 'INS período Seleccionado'
					}
				}
			});

		};
	</script>


</div>
</body>
</html>