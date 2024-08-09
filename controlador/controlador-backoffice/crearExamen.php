
<?php
@include '../../modelo/conexion.php';
session_start();

?>

<?php
// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $id_colaborador_creador = $_POST["id_login"];
  $id_rol_destino = $_POST["rol_destino"];
  $id_tematica = $_POST["tematica"];
  $titulo = $_POST["titulo"];
  $cantidad_preguntas = $_POST["total"];
  $fecha_realizacion = $_POST["fecha_realizacion"];
  $duracion_examen = $_POST["duracion"];
  $fecha_creacion = date('Y-m-d'); //Se guarda la fecha actual
  $estado = "desactivo";

  // Preparar la consulta SQL para insertar los datos en la tabla
  $sql_crearExamen_backoffice = "INSERT INTO examenes (id_colaborador_creador, id_rol_destino, id_tematica,titulo, cantidad_preguntas, fecha_realizacion, duracion_examen, fecha_creacion, estado) 
                VALUES ('$id_colaborador_creador', '$id_rol_destino', '$id_tematica', '$titulo', '$cantidad_preguntas', '$fecha_realizacion', '$duracion_examen', '$fecha_creacion', '$estado')";
  $query = mysqli_query($conn, $sql_crearExamen_backoffice);


  // Ejecutar la consulta y verificar si fue exitosa
  if ($query) {
    $_SESSION['mensaje'] = "Examen creado exitosamente";
    header("Location: ../../vista/dashboard/backoffice/crud-examenes/backofficeCrearExamen.php");
  } else {
    $_SESSION['mensaje'] = "Error al crear examen";
    header("Location: ../../vista/dashboard/backoffice/crud-examenes/backofficeCrearExamen.php");
  }
}

?>

