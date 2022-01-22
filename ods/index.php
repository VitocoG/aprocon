 <?php 
 session_start();
 require_once '../../config/core.class.php';
 $core   =   new core;
 $usuarios  = $core->Permisos( 'ods', 'permisos', $_SESSION['id'] );
 foreach($usuarios as $row)
 {
     $dep = $row['ods'];
 }
 
 if( $dep == 1 )
 {
   if( $_SESSION['perfil']==1 )
   {
     header('Location:prueba.php');
   }
   else
   {
      header( 'Location:indexUsuario.php');
   }
   
 }
 else
 {
    header( 'Location:../../');
 }

    


?>
