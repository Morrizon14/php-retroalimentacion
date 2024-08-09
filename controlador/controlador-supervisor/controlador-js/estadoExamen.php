<?php
@include '../../../modelo/conexion.php';

// Verificar si se reciben los datos correctamente
if(isset($_POST['id']) && isset($_POST['estado'])) {
    $id = $_POST['id'];
    $estado = $_POST['estado'];

    // Agregar depuración
    //echo "ID recibido: " . $id . ", Estado recibido: " . $estado;

    // Actualizar el estado en la base de datos
    $sql = "UPDATE examenes SET estado='$estado' WHERE id_examen=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Estado actualizado correctamente";
    } else {
        echo "Error al actualizar el estado: " . $conn->error;
    }
} else {
    echo "Error: No se recibieron datos adecuadamente.";
}

$conn->close();
?>