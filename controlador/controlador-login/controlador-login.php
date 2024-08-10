<?php
@include '../../modelo/conexion.php';
session_start();

if(isset($_POST['submit'])){

   // $email = mysqli_real_escape_string($conn, $_POST['email']);
   // $password = $_POST['password']; // No hashear la contraseña proporcionada
  
   //TIPOS DE ROLES:
   $rol_backoffice = 1;       $rol_supervisor = 2;      $rol_asesor = 3;           $rol_general = 4;

   //SENTENCIA PARA BUSCAR EL USUARIO Y CONTRASEÑA DE LA BASE DE DATOS
   $select = "SELECT 
                  login.id_login AS id_login,
                  login.id_rol AS id_rol,
                  login.usuario AS usuario,
                  login.contraseña AS contraseña,
                  colaborador.nombre AS nombre
               FROM 
                  login
               LEFT JOIN 
                  colaborador ON login.id_colaborador = colaborador.id_colaborador
               WHERE usuario = '$email' && contraseña = '$password' ";

   $correo_colaborador = " SELECT * FROM login WHERE usuario = '$email'";
   $contra_colaboradoor = " SELECT * FROM login WHERE contraseña = '$password' ";


   //GUARDAMOS COMO RESULTADO LA SENTENCIA DE LA "BUSQUEDA" Y  LA "CONEXION" 
   $stmt = $pdo->query($select);
   $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
   //$result = mysqli_query($conn, $select);

   //$result_correo_colaborador = mysqli_query($conn, $correo_colaborador);
   $stmt2 = $pdo->query($correo_colaborador);
   $result2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
   //$result_contra_colaborador = mysqli_query($conn, $contra_colaboradoor);
   $stmt3 = $pdo->query($contra_colaboradoor);
   $result3 = $stmt3->fetchAll(PDO::FETCH_ASSOC);

   //HACEMOS VALIDACIONES SI EXISTE MAS DE CERO  RESULTADOS SIGNIFICA QUE SI HAY USUARIOS EN LA BBDD
   //if(mysqli_num_rows($result) > 0 /* && mysqli_num_rows($result_colaborador) > 0 */){
   if(count($result) > 0) {
      //INGRESAMOS A LOS CAMPOS DEL RESULTADO EN ESTE CASO PERTENECE A LA TABLA LOGIN
      $row = mysqli_fetch_array($result);
      /* $row_colaborador = mysqli_fetch_array($result_colaborador); */

      if ($row['id_rol'] == $rol_backoffice) {
         $_SESSION['backoffice_name'] = $row['nombre'];
         $_SESSION['id_login'] = $row['id_login'];
         $_SESSION['role'] = 'backoffice';
         header('location:../dashboard/backoffice/backoffice.php');

     } else if ($row['id_rol'] == $rol_supervisor) {
         $_SESSION['supervisor_name'] = $row['nombre'];
         $_SESSION['id_login'] = $row['id_login'];
         $_SESSION['role'] ='supervisor';
         header('location:../dashboard/supervisor/supervisor.php');

     } else if ($row['id_rol'] == $rol_asesor) {
         $_SESSION['asesor_name'] = $row['nombre'];
         $_SESSION['id_login'] = $row['id_login'];
         $_SESSION['role'] = 'asesor';
         header('location:../dashboard/asesor/asesor.php');
         
     } else if ($row['id_rol'] == $rol_general) {
      $_SESSION['general_name'] = "GENERAL";
      $_SESSION['id_login'] = $row['id_login'];
      $_SESSION['role'] = 'general';
      header('location:../dashboard/principal/principal.php');
  }
     
   } else{
    if((trim($_POST['email']) === '') and (trim($_POST['password']) === '')){
       $error[] = 'No puede haber campos vacios!';
    }else if(trim($_POST['email']) === ''){
       $error[] = 'email no puede estar vacio!';
    }else if (!preg_match("/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/", $_POST['email'])){
       $error[] = 'Ha introducido un email no valido!';
    }else if ((!mysqli_num_rows($result_correo_colaborador) > 0)){
       $error[] = 'email no existente!';
    }else if(trim($_POST['password']) === ''){
       $error[] = 'Contraseña no puede estar vacio!';
    }else if (!preg_match("/^.{3,15}$/", $_POST['password'])){
       $error[] = 'Contraseña no valido!';
    }else if((!mysqli_num_rows($result_contra_colaborador) > 0)){
       $error[] = 'contraseña equivocada!';
     }
 }
}
//$pdo->close();
?>
