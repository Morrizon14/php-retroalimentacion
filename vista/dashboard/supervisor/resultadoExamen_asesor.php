<!-- //SCRIPT PARA IMPRIMIR -->
<script>
    window.onload = function() {
      window.print();
    };
    </script> 
    <script>
    function redireccionarAlCancelar() {

      window.history.back();
    }
    window.onafterprint = function() {
      redireccionarAlCancelar(); // Llama a la función de redireccionamiento
    };    
  </script> 
  

<?php
session_start();
@include '../../../modelo/conexion.php';

if (!isset($_SESSION['supervisor_name'])) {
    header('location: ../../login/login.php');
    exit;
}
$id_login = $_SESSION['id_login'];

if (isset($_GET['id_examen'])) {
  $id_examen = (int)$_GET['id_examen'];
} else {
  echo "No se ha proporcionado el ID del examen.";
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $_SESSION['role']; ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/73c70fe811.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="./imprimirficha.css">
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

      <main>
      <!-- <h2>Id examen: <?php echo $id_examen; ?></h2>-->
      <!-- <h2>Id colaborador: <?php echo $id_login; ?></h2> -->
<h1 style="text-align:center">Ficha de examen</h1>
        <div class="">
          <table class="tabla">
            <thead>
              <tr>
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
  $sql_examen = "SELECT titulo, cantidad_preguntas FROM examenes WHERE id_examen = $id_examen";

  $resultado_examen = mysqli_query($conn, $sql_examen);
  
  if (!$resultado_examen) {
      echo "Error al obtener los datos del examen: " . mysqli_error($conn);
      exit;
  }
  
  $examen = mysqli_fetch_assoc($resultado_examen);
  
  // Liberar el resultado del examen
  mysqli_free_result($resultado_examen);
      ?>
        </div>

        <div class="">
          <table class="tabla">
          <thead>
              <tr>
                <th colspan="2" class="text-left">Datos del examen</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">Titulo del examen</th>
                <td><?php echo isset($examen['titulo']) ? $examen['titulo'] : 'No disponible'; ?></td>
              </tr>
              <tr>
                <th scope="row">Total de preguntas</th>
                <td><?php echo isset($examen['cantidad_preguntas']) ? $examen['cantidad_preguntas'] : 'No disponible'; ?></td>
              </tr>

            </tbody>
            </table>
        </div>
       
        <div class="">
          <table class="tabla">
          <thead>
              <tr>
                <th colspan="2" class="text-left">Resultados del examen</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">Puntaje obtenido</th>
                <td>
                  <?php 
                  // Consulta para obtener el puntaje obtenido
                  $sql_resultados = "SELECT nota FROM resultados WHERE id_examen = $id_examen AND id_colaborador = $id_login";
                  $resultado_resultados = mysqli_query($conn, $sql_resultados);

                  if ($resultado_resultados) {
                    $fila_resultados = mysqli_fetch_assoc($resultado_resultados);
                    $puntaje_obtenido = $fila_resultados['nota'];
                    echo isset($puntaje_obtenido) ? $puntaje_obtenido : 'No disponible';
                    mysqli_free_result($resultado_resultados);
                  } else {
                    echo 'No disponible';
                  }
                  ?>
                </td>
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