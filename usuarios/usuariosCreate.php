<?php
require_once '../../layouts/templateUp.php';
?>



<!--Contenido-->
<div class="row">
    <div class="col-md-6">
        <h3>Nuevo Usuario</h3><br>
    </div>
</div>

<form action="" method="post">
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" class="form-control" autofocus  placeholder="Nombre" required>
        </div>
    </div>


    <div class="col-md-2">
        <div class="form-group"> 
            <label for="rut">Rut</label>
            <input type="text" name="rut" placeholder="12345678-9" class="form-control" required>           
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email"  placeholder="algo@algo.cl"  class="form-control" required>
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <label> Pass</label>
            <input type="text" name="pass" class="form-control" required>
        </div>
    </div>
</div>

<div class="row">  
    <div class="col-md-4">
        <div class="form-group">
            <label for="banco">Banco</label>
            <select name="banco" class="form-control"  required>
                <option value="">Seleccione un Banco</option>
<?php
$bancos =   $model->ShowAll( 'bancos', 'ORDER BY nombre');
foreach( $bancos as $value ):
    echo        '<option value="'.$value['id'].'">'.$value['nombre'].'</option>';
endforeach;
?>
            </select>
        </div>
    </div>
                          
    <div class="col-md-4">
        <div class="form-group">
            <label for="tipo_cuenta">Tipo de Cuenta</label>
            <input type="text" name="tipo_cuenta"  class="form-control" required>
        </div>
    </div>
                          
    <div class="col-md-4">
        <div class="form-group">
            <label for="num_cuenta">Numero de Cuenta</label>
            <input type="number" name="num_cuenta"  class="form-control" required>
        </div>
    </div>
</div>
                          
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="perfil">Perfil</label>
            <select name="perfil" class="form-control"  required>
                <option value="">Seleccione Perfil</option>
<?php
$perfiles   =   $model->ShowAll( 'perfiles', 'ORDER BY nombre' );
foreach( $perfiles as $value ):
    echo '      <option value="'.$value['id'].'">'.$value['nombre'].'</option>';
endforeach;
?>
            </select>
        </div>
    </div>
  
    <div class="col-md-4">
        <div class="form-group">
            <label for="localidad">Localidad</label>
            <select name="localidad" class="form-control"  required>
                <option value="">Seleccione Localidad</option>
<?php
$localidades   =   $model->ShowAll( 'localidades', 'ORDER BY nombre' );
foreach( $localidades as $value ):
    echo '      <option value="'.$value['id'].'">'.$value['nombre'].'</option>';
endforeach;
?>
            </select>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <button type="submit" class="btn btn-primary" name="p" value="save">Guardar</button>
            <button type="reset" class="btn btn-danger">Cancelar</button>
        </div>
    </div>
</div>
  
</form>
<!--Fin Contenido-->  

<?php
require_once '../../layouts/templateDown.php';
?>