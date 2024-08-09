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
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Supervisor</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="../principal/style.css">
</head>

<body>
  <?php
  $sql_supervisor = "SELECT usuario from login WHERE id_login = $id_login ";
  $resultado = mysqli_query($conn, $sql_supervisor);
  if ($resultado && mysqli_num_rows($resultado) > 0) {
    while ($fila = mysqli_fetch_assoc($resultado)) {
  ?>
      <?php @include './supervisor-principal/sidebar_supervisor.php' ?>
  <?php
    }
  }
  mysqli_free_result($resultado);
  mysqli_close($conn);
  ?>
  <main>
    <h1>Hola soy supervisor</h1>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Procesar los detalles del examen enviado aquí
      // ...
      // Luego, mostrar los campos de entrada para las preguntas
      $total_questions = $_POST['total']; // Obtener el número total de preguntas del formulario

      // Mostrar los campos de entrada para cada pregunta
      echo '<div class="row">';
      echo '<span class="title1" style="margin-left:40%;font-size:30px;"><b>Detalles del examen</b></span><br /><br />';
      echo '<div class="col-md-3"></div><div class="col-md-6">';
      echo '<form class="form-horizontal title1" name="form" method="POST">';
      echo '<fieldset>';

      for ($i = 1; $i <= $total_questions; $i++) {
        echo '<div class="form-group">';
        echo '<label class="col-md-12 control-label" for="qns' . $i . '">Pregunta ' . $i . '</label>';
        echo '<div class="col-md-12">';
        echo '<textarea rows="3" cols="5" name="qns' . $i . '" class="form-control" placeholder="Escribe la pregunta número ' . $i . ' acá..." required></textarea>';
        echo '</div>';
        echo '</div>';


        // Aquí puedes mostrar los campos de entrada para las opciones de la pregunta 
        // ************************************************ */
        echo '<div class="form-group">';
        echo '<label class="col-md-12 control-label" for="' . $i . '1"></label>';
        echo '<div class="col-md-12">';
        echo '<input id="' . $i . '1" name="' . $i . '1" placeholder="Ingresa la opción a" class="form-control input-md" type="text">';
        echo '</div>';
        echo '</div>';
        //************************************************ */
        echo '<div class="form-group">';
        echo '<label class="col-md-12 control-label" for="' . $i . '2"></label>';
        echo '<div class="col-md-12">';
        echo '<input id="' . $i . '2" name="' . $i . '2" placeholder="Ingresa la opción b" class="form-control input-md" type="text">';
        echo '</div>';
        echo '</div>';
        // *********************************************** */
        echo '<div class="form-group">';
        echo '<label class="col-md-12 control-label" for="' . $i . '3"></label>';
        echo '<div class="col-md-12">';
        echo '<input id="' . $i . '3" name="' . $i . '3" placeholder="Ingresa la opción c" class="form-control input-md" type="text">';
        echo '</div>';
        echo '</div>';
        // ************************************************** */
        echo '<div class="form-group">';
        echo '<label class="col-md-12 control-label" for="' . $i . '4"></label>';
        echo '<div class="col-md-12">';
        echo '<input id="' . $i . '4" name="' . $i . '4" placeholder="Ingresa la opción d" class="form-control input-md" type="text">';
        echo '</div>';
        echo '</div>';
        // También puedes mostrar un campo de selección para la respuesta correcta
        // ...
        echo '<div class="form-group">';
        echo '<label class="col-md-12 control-label" for="ans' . $i . '">Escoge la respuesta correcta para la pregunta ' . $i . '</label>';
        echo '<div class="col-md-12">';
        echo '<select id="ans' . $i . '" name="ans' . $i . '" placeholder="Escoge la respuesta correcta " class="form-control input-md">';
        echo '<option value="a">Seleccione la respuesta a la pregunta ' . $i . '</option>';
        echo '<option value="a">opcion a</option>';
        echo '<option value="b">opcion b</option>';
        echo '<option value="c">opcion c</option>';
        echo '<option value="d">opcion d</option>';
        echo '</select>';
        echo '</div>';
        echo '</div>';
      }

      // Agregar un botón de envío para enviar las preguntas
      echo '<div class="form-group">';
      echo '<label class="col-md-12 control-label" for=""></label>';
      echo '<div class="col-md-12">';
      echo '<input type="submit" style="margin-left:45%" class="btn btn-primary" value="Enviar preguntas" class="btn btn-primary"/>';
      echo '</div>';
      echo '</div>';

      echo '</fieldset>';
      echo '</form>';
      echo '</div>';
      echo '</div>';
    } else {
      // Si no se ha enviado el formulario de detalles del examen, mostrar ese formulario
      // ...
    }
    ?>
  </main>

  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../principal/script.js"></script>
</body>

</html>