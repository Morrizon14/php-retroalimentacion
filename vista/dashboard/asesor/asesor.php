<?php
session_start();
@include '../../../modelo/conexion.php';

if (!isset($_SESSION['asesor_name'])) {
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
  <title><?php echo $_SESSION['role']; ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/73c70fe811.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../principal/style.css">
</head>

<body>
  <?php
  $sql_asesor =
    "SELECT 
        login.id_login AS id_login,
        login.usuario AS usuario,
        colaborador.nombre AS nombre,
        colaborador.apellido AS apellido,
        colaborador.sexo AS sexo,
        tematica.nombre_tematica AS nombre_tematica
      FROM 
          login
      LEFT JOIN 
        colaborador ON login.id_colaborador = colaborador.id_colaborador
      LEFT JOIN
        tematica ON colaborador.id_tematica = tematica.id_tematica
      WHERE 
        id_login = $id_login";

  $resultado = mysqli_query($conn, $sql_asesor);
  if ($resultado && mysqli_num_rows($resultado) > 0) {
    while ($fila = mysqli_fetch_assoc($resultado)) {
  ?>
      <?php @include './asesor-principal/sidebar-asesor.php' ?>

      <main>
        <h1>Bienvenido(a) - <?php echo $nombre_sesion; ?></h1>
        <div class="container">
          <table class="table" style="background-color: white">
            <thead>
              <tr class="table-info">
                <th colspan="2" class="text-left">Información del Colaborador</th>
              </tr>
            </thead>
            <tr>
              <th scope="col">Nombre</th>
              <td><?php echo $fila['nombre']; ?></td>
            </tr>
            <tbody>
              <tr>
                <th scope="col">Apellido</th>
                <td><?php echo $fila['apellido']; ?></td>
              </tr>
              <tr>
                <th scope="row">Genero</th>
                <td><?php echo $fila['sexo']; ?></td>
              </tr>
              <tr>
                <th scope="row">Email</th>
                <td><?php echo $fila['usuario']; ?></td>
              </tr>
              <tr>
                <th scope="row">Tematica</th>
                <td><?php echo $fila['nombre_tematica']; ?></td>
              </tr>
            </tbody>
          </table>
      <?php
    }
  }
  mysqli_free_result($resultado);
  mysqli_close($conn);
      ?>
        </div>
      </main>
      <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
      <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
      <script src="../principal/script.js"></script>
</body>

</html>