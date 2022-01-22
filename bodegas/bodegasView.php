<?php require_once '../../layouts/templateUp.php'; ?>

<div class="row">
    <div class="col-md-6">
        <form action="" method="post">
            <h3>Lista de Bodegas
                <button type="submit" name="p" value="create" class="btn btn-success">Nuevo</button>
            </h3>
        </form>
    </div>
    <div class="col-md-6"></div>
</div>

<div class="row">
    <div class="col-md-12">


    
        <div class="table table-responsive">
            <table class="table table-striped table-hover table-condensed table-bordered">
<?php
$bodega =   $clase->ListarBodegas();
if( $bodega->num_rows > 0 ):
echo '                
                <tr>    
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Localidad</th>
                    <th>Contrato</th>
                    <th>Responsable</th>
                    <th></th>
                    <th></th>
                </tr>';


    foreach( $bodega as $value ):
    echo'            
                <tr>
                    <td>'.$value['id'].'</td>
                    <td>'.$value['nombre'].'</td>
                    <td>'.$value['localidad'].'</td>
                    <td>'.$value['contrato'].'</td>
                    <td>'.$value['usuario'].'</td>
                    <form action="" method="post">
                    <td>
                        <button type="submit" name="p" value="edit" class="btn btn-success"><i class="fa fa-edit"></i></button>
                    </td>
                    <td>
                        <button type="submit" name="p" value="delete" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                        <input type="hidden" name="id" value="'.$value['id'].'">
                    </td>
                    </form>
                </tr>';
    endforeach; 
else:
    echo'       <tr>
                    <th class="bg-success">NO EXISTEN BODEGAS CREADAS</th>
                </tr>';
endif;?>     
            </table>  
        </div>
    </div>
</div>

<?php 
 require_once '../../layouts/templateDown.php'; ?>