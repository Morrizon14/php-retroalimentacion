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
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Backoffice</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

  <link rel="stylesheet" href="../principal/style.css">

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- CDN - AJAX -->
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

  <!--  SCRIPT AJAX ESTADO EXAMEN -->
  <script src="./backoffice-js/estadoBotonExamenes.js"></script>

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
    <div class="container">
      <h2>Resultados del examen</h2>
      <div>
        <table class="table table-bordered">
          <thead>
            <tr style="text-align: center;" class="table-info">
              <th scope="col" style="display: none;">id</th>
              <th scope="col">Nombre</th>
              <th scope="col">id_examen</th>
              <th scope="col">Calificación</th>
            </tr>
          </thead>
          <tbody>
            <?php
            @include '../../../modelo/conexion.php';
            $id_examen = '';
            if(isset($_GET['id_examen'])){
              $id_examen = mysqli_real_escape_string($conn, $_GET['id_examen']);
            }
            $sql = "SELECT r.id_resultado, c.nombre AS nombre_colaborador, e.titulo AS nombre_examen, r.nota 
                    FROM resultados r 
                    INNER JOIN colaborador c ON r.id_colaborador = c.id_colaborador
                    INNER JOIN examenes e ON r.id_examen = e.id_examen
                    WHERE r.id_examen = '$id_examen'";
            $resultado = mysqli_query($conn, $sql);
            if ($resultado && mysqli_num_rows($resultado)>0){
              while ($fila = mysqli_fetch_assoc($resultado)){
                ?>
                <tr style="text-align: center;">
                  <td class="id_resultado" style="display: none;"><?php echo $fila['id_resultado']; ?></td>
                  <td><?php echo $fila['nombre_colaborador']; ?></td>
                  <td><?php echo $fila['nombre_examen']; ?></td>
                  <td><?php echo $fila['nota']; ?></td>
                </tr>

                <?php
              }
            }
            else{
              ?>
              <tr>
                <td colspan = "4" style = "text-align: center;">No se encontraron resultados para este examen.</td>
              </tr>
              <?php
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
</body>
</html>