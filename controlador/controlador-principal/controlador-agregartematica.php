<?php
session_start();
// Verificar si se recibió el formulario
if(isset($_POST['submit'])) {
    // Incluir archivo de conexión
    include '../../modelo/conexion.php';

    // Obtener datos del formulario si están definidos
    $tematica = $_POST['nombre-tematica'] ;
    $campana = $_POST['nombre-campaña'] ;

    // Preparar consulta SQL para inserción
    $sql = "INSERT INTO tematica (nombre_tematica, id_campaña) 
            VALUES ('$tematica', '$campana')";

    // Ejecutar consulta
    if(mysqli_query($conn, $sql)) {
        mysqli_commit($conn);
        $_SESSION['mensaje'] = "Temática registrada correctamente.";
    } else {
        // Error en la inserción
        echo "<script>alert('Error al registrar temática');</script>";
        echo "Error: " . mysqli_error($conn); // Mostrar detalles del error SQL
    }

    // Cerrar conexión
    mysqli_close($conn);
    header("Location: ../../vista/dashboard/principal/tematica.php");
}
?>
