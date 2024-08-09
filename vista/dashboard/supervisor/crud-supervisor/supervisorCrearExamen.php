<?php
session_start();
@include '../../../../modelo/conexion.php';

if (!isset($_SESSION['supervisor_name'])) {
  header('location:../../../../login/login.php');
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
  <script src="https://kit.fontawesome.com/73c70fe811.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../../principal/style.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="../supervisor-css/crearExamen.css">


</head>

<body>
  <?php @include '../supervisor-principal/sidebar_supervisor_copy.php' ?>

  <main>
    <h1>Agregar Examen</h1>

      <div class="container form-exam" style="padding: 0%; border: 1px solid #bee5eb;">

        <!-- ***** MODAL DE ALERTA DE PROCESO EXITOSO USANDO SESSION Y SWEET ALERT2 ***** -->
        <?php @include '../supervisor-principal/modal_alerta_exitoso_conSession.php'?>

        <div class="container title-1" style="padding: 0%; border: 1px solid #bee5eb;"><span class="title1" style="margin-left:29%;font-size:30px;"><b>Detalles del examen</b></span><br /><br /></div>
        <div class="col-md-3"></div>
        <div class="col-md-6">

          <?php

          $sql_campañas = "SELECT 
                        colaborador.id_rol as id_rol,
                        colaborador.id_colaborador as id_colaborador,
                        colaborador.id_campaña as id_campaña,
                        campaña.nombre_campaña as nombre_campaña
                      FROM colaborador
                      INNER JOIN
                      campaña ON colaborador.id_campaña = campaña.id_campaña
                      WHERE colaborador.id_rol  = 2";
          $result = $conn->query($sql_campañas);
          if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $id_campaña =  $row['id_campaña'];

            $sql_tematicas = "SELECT * FROM tematica WHERE id_campaña = $id_campaña";
            $result_tematicas = $conn->query($sql_tematicas);
            

          } else {
            echo "No hay campañas activas";
          }

          ?>
          <div class="container formulario">
          <form class="form-horizontal title1" name="form" action="../../../../controlador/controlador-supervisor/crearExamen.php" method="POST" enctype="multipart/form-data">
            <fieldset>
              <!-- Text input-->
              <input type="hidden" id="id_login" name="id_login" value="<?php echo $id_login ?>">
              <div class="form-group">
                <label class="col-md-12 control-label" for="name"></label>
                <div class="col-md-12">
                  <label for="tematica">Tematica del examen</label>
                  <select name="tematica" id="tematica" class="form-select" style="width: 500px;">
                    <?php
                    if ($result_tematicas->num_rows > 0) {
                      while ($row_tematicas = $result_tematicas->fetch_assoc()) {
                        echo "<option value='" . $row_tematicas['id_tematica'] . "'>" . $row_tematicas['nombre_tematica'] . "</option>";
                      }
                    } else {
                      echo "No hay tematicas dispobilbes ";
                    }
                    ?>
                  </select>
                </div>
              </div>

              <!-- Text input-->
              <div class="form-group">
                <label class="col-md-12 control-label" for="total"></label>
                <div class="col-md-12">
                  <label for="total">Titulo del examen</label>
                  <input id="titulo" name="titulo" placeholder="Ingrese el titulo del examen" class="form-control input-md" type="text" required>
                </div>
              </div>

              <!-- Text input-->
              <div class="form-group">
                <label class="col-md-12 control-label" for="total"></label>
                <div class="col-md-12">
                  <label for="total">Cantidad de preguntas</label>
                  <input id="total" name="total" placeholder="Ingrese el número total de preguntas" class="form-control input-md" type="number" required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-12 control-label" for="fecha_realizacion">Fecha de realizacion del examen</label>
                <div class="col-md-12">
                  <input id="fecha_realizacion" name="fecha_realizacion" class="form-control input-md" type="date" required>
                </div>
              </div>

              <!-- Text input-->
              <div class="form-group">
                <label class="col-md-12 control-label" for="duracion">Duracion del examen: (en minutos)</label>
                <div class="col-md-12">
                  <input id="duracion" name="duracion" placeholder="Ingrese el límite de tiempo para la prueba en minutos" class="form-control input-md" min="1" type="number" required>
                </div>
              </div>

              <!-- Text input-->
              <div class="form-group">
                <label class="col-md-12 control-label" for="name"></label>
                <div class="col-md-12">
                  <label for="rol_destino">Destino de examen</label>
                  <select name="rol_destino" id="rol_destino" class="form-select" style="margin-bottom: 5px; width: 500px;">
                    <option value="3">asesores</option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <button type="submit" name="submit" class="btn btn-success" style="margin-top: 10px; margin-bottom: 10px;">Crear examen</button>
              </div>

            </fieldset>
          </form>
                  </div>
        </div>

      </div>
    </div>
  </main>

  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../../principal/script.js"></script>
</body>

</html