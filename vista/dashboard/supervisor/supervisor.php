<?php
session_start();
@include '../../../modelo/conexion.php';

if (!isset($_SESSION['supervisor_name'])) {
  header('location:../../login/login.php');
}
$nombre_sesion = $_SESSION['supervisor_name'];
$id_login = $_SESSION['id_login'];
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $_SESSION['role']; ?></title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css
">
  <link rel="stylesheet" href="../principal/style.css">
</head>

<body>
  <?php
  $sql_supervisor =
    "SELECT 
          login.id_login AS id_login,
          login.usuario AS usuario,
          colaborador.nombre AS nombre,
          colaborador.apellido AS apellido,
          campaña.nombre_campaña AS nombre_campaña
        FROM 
            login
        LEFT JOIN 
          colaborador ON login.id_colaborador = colaborador.id_colaborador
        LEFT JOIN
          campaña ON colaborador.id_campaña = campaña.id_campaña
        WHERE 
          id_login = $id_login";

  $resultado = mysqli_query($conn, $sql_supervisor);
  if ($resultado && mysqli_num_rows($resultado) > 0) {
    while ($fila = mysqli_fetch_assoc($resultado)) {
  ?>
      <?php @include './supervisor-principal/sidebar_supervisor.php' ?>
      <main>
        <h1>Bienvenido(a) - <?php echo $nombre_sesion; ?></h1>
        <div class="container">
          <table class="table" style="background-color: white">
            <thead>
              <tr class="table-info">
                <th colspan="2" class="text-left">Información del Colaborador:</th>
              </tr>
              <tr>
                <th scope="col">Nombre</th>
                <td><?php echo $fila['nombre']; ?></td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="col">Apellido</th>
                <td><?php echo $fila['apellido']; ?></td>
              </tr>
              <tr>
                <th scope="row">Email</th>
                <td><?php echo $fila['usuario']; ?></td>
              </tr>
              <tr>
                <th scope="row">Campaña</th>
                <td><?php echo $fila['nombre_campaña']; ?></td>
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