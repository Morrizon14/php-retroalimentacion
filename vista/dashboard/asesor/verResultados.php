<?php
session_start();
@include '../../../modelo/conexion.php';

if(!isset($_SESSION['asesor_name'])){
   header('location:../../login/login.php');
}
$nombre_sesion = $_SESSION['asesor_name'];
$id_login = $_SESSION['id_login'];

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Asesor</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="../principal/style.css">
  <link rel="stylesheet" href="./tabla.css">
</head>

<body>
<?php
  $sql_asesor = "SELECT usuario from login WHERE id_login = $id_login ";
  $resultado = mysqli_query($conn, $sql_asesor);
  if ($resultado && mysqli_num_rows($resultado) > 0) {
    while ($fila = mysqli_fetch_assoc($resultado)) {
  ?>
      <?php @include './asesor-principal/sidebar-asesor.php' ?>
  <?php
    }
  }
  mysqli_free_result($resultado);
  mysqli_close($conn);
  ?>
<main>
  <h1>Hola soy asesor</h1>

  <div class="container">
    <table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">Nombre de examen</th>
        <th scope="col">Dia</th>
        <th scope="col">Fecha</th>
        <th scope="col">Nota</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td scope="row">Primer examen</td>
        <td>Lunes</td>
        <td>29/04/2024</td>
        <td class="nota">18</td>
      </tr>
      <tr>
        <td scope="row">Segundo examen</td>
        <td>Martes</td>
        <td>07/05/2024</td>
        <td class="nota">14</td>
      </tr>
      <tr>
      <td scope="row">Tercer examen</td>
        <td>Miercoles</td>
        <td>15/05/2024</td>
        <td class="nota">16</td>
      </tr>
    </tbody>
  </table>
  </div>
</main>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../principal/script.js"></script>
</body>
</html>