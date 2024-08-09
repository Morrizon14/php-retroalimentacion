<?php
session_start();
@include '../../../modelo/conexion.php';

if (!isset($_SESSION['backoffice_name'])) {
  header('location:../../login/login.php');
}
$nombre_sesion = $_SESSION['backoffice_name'];
$id_login = $_SESSION['id_login'];

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Backoffice</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css">

  <link rel="stylesheet" href="../principal/style.css">

  <!-- CDN - AJAX -->
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>

  <?php
  $sql_backoffice = "SELECT usuario from login WHERE id_login = $id_login ";
  $resultado = mysqli_query($conn, $sql_backoffice);
  if ($resultado && mysqli_num_rows($resultado) > 0) {
    while ($fila = mysqli_fetch_assoc($resultado)) {
  ?>
      <?php @include './backoffice-principal/sidebar_backoffice.php' ?>
  <?php
    }
  }
  mysqli_free_result($resultado);
  mysqli_close($conn);
  ?>
  <main>
    <!--  MODAL PARA VER LAS PREGUNTAS DEL EXAMEN SELECCIONADO  -->
    <?php @include './backoffice-principal/modal_verExamenSeleccionado.php' ?>

    <!--   <a href="backofficePreguntas.php">ACA</a>
    <a href="prueba.php">PRUEBA</a> -->

    <div>
      <!-- ***** MODAL DE ALERTA DE PROCESO EXITOSO USANDO SESSION Y SWEET ALERT2 ***** -->
      <?php @include './backoffice-principal/modal_alerta_exitoso_conSession.php' ?>

      <div class="container">
        <h2>Lista banco de preguntas:</h2>
        <br>
        <table class="table table-bordered">
          <thead>
            <tr style="text-align: center;" class="table-info">
              <th scope="col" style="display: none;">id</th>
              <th scope="col">Examen</th>
              <th scope="col">Preguntas</th>
            </tr>
          </thead>
          <tbody>
            <?php
            @include '../../../modelo/conexion.php';
            $sql = "SELECT * from examenes ";

            $resultado = mysqli_query($conn, $sql);
            if ($resultado && mysqli_num_rows($resultado) > 0) {
              while ($fila = mysqli_fetch_assoc($resultado)) {
            ?>
                <tr style="text-align: center;">
                  <td class="user_id" style="display: none;"><?php echo $fila['id_examen']; ?></td>
                  <td><?php echo $fila['titulo']; ?></td>
                  <td class="">
                    <a href="./crud-examenes/backofficeCrearPreguntas.php?id_examen=<?php echo $fila['id_examen']; ?>" class=" btn-crear me-0"><i class="fas fa-plus" style="color: #488204;"></i></a>
                    <a href="" class=" btn-ver me-0"><i class="far fa-eye" style="color: #2E59EA;"></i></a>
                    <a href="" class="btn-editar ms-0"><i class="fas fa-edit" style="color: #C6C210;"></i></a>
                  </td>
                </tr>
            <?php
              }
            }
            mysqli_free_result($resultado);
            mysqli_close($conn);
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </main>

  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../principal/script.js"></script>

  <script src="./backoffice-js/verPreguntasExamenSeleccionado.js"></script>
  <script src="./backoffice-js/crearPreguntasExamenSeleccionado.js"></script>
</body>

</html>