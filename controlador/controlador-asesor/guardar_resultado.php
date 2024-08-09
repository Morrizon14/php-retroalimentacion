<?php

session_start();
@include '../../modelo/conexion.php';
// Recibir datos del POST
$id_colaborador = $_POST['id_colaborador'];
$id_examen = $_POST['id_examen'];
$nota = $_POST['nota'];

// Preparar la consulta SQL (usando sentencias preparadas para seguridad)
$sql = "INSERT INTO resultados (id_colaborador, id_examen, nota) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iii", $id_colaborador, $id_examen, $nota);
// Ejecutar la consulta
if ($stmt->execute()) {
    echo "Nota guardada correctamente.";
} else {
    echo "Error al guardar la nota: " . $stmt->error;
}

// Cerrar la conexión y liberar recursos
$stmt->close();
$conn->close();

?>
