<?php require_once '../../layouts/templateUp.php'; ?>

<div class="row">
    <div class="col-md-12">
        <h3> Lista de Horas Extras de <?php echo $_SESSION['nombre'] ?></h3>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-bordered table-condensed table-hover table-striped" id="DataTable">
                <thead>
                    <tr>
                        <th>ODS</th>
                        <th>Trabajador</th>
                        <th>Inicio</th>
                        <th>T&eacute;rmino</th>
                        <th>Total Horas</th>
                        <th>Motivo</th>
                    </tr>
                </thead>
                <tbody>
                
<?php
foreach( $horas as $row ):
    echo '          <tr>
                        <td>'.$row['ods'].'</td>';

$trabajador = $clase->ShowById( 'trabajadores', $row['trabajador'] );                        
    echo '              <td>'.$trabajador['apellido'].' '.$trabajador['nombre'].'</td>
                        <td>'.date( "d-m-Y H:i", strtotime( $row['fecha_inicio'] ) ).'</td>
                        <td>'.date( "d-m-Y H:i", strtotime( $row['fecha_termino'] ) ).'</td>
                        <td>'.$row['total_horas'].'</td>
                        <td>'.$row['motivo'].'</td>
                    </tr>';
endforeach; ?>                
                
                </tbody>
            </table>
        </div>
    </div>
</div>


<script type="text/javascript" class="init">
	$(document).ready(function() {
        $('#DataTable').DataTable( {
            "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"},
            responsive: true
        } );
    } );
</script>

<?php require_once '../../layouts/templateDown.php'; ?>