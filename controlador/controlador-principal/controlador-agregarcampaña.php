<?php 
session_start();
// Verificar si se recibió el formulario
if(isset($_POST['submit'])) {
    // Incluir archivo de conexión
    include '../../modelo/conexion.php';

    // Obtener datos del formulario
    $nombreCampaña = $_POST['nombre-campaña'];
    $nombreEmpresa = $_POST['nombre-empresa'];

    // Verificar si la empresa existe
    $sql_empresa = "SELECT idempresa FROM empresa WHERE razonsocial = '$nombreEmpresa'";
    $result_empresa = mysqli_query($conn, $sql_empresa);

    if(mysqli_num_rows($result_empresa) > 0) {
        $row = mysqli_fetch_assoc($result_empresa);
        $idEmpresa = $row['idempresa'];

        // Preparar consulta SQL para inserción
        $sql = "INSERT INTO campaña (nombre_campaña, id_empresa) VALUES ('$nombreCampaña', '$idEmpresa')";

        // Ejecutar consulta
        if(mysqli_query($conn, $sql)) {
            // Inserción exitosa, redirigir o mostrar mensaje
            $_SESSION['mensaje'] = "Campaña agregada correctamente.";

            // Puedes redirigir después de mostrar el mensaje
        } else {
            // Error en la inserción
            $_SESSION['mensaje'] = "Error al agregar campaña.";
        }
    } else {
        // La empresa no existe
        $_SESSION['mensaje'] = "La empresa no existe";
    }

    mysqli_close($conn);
    header("Location: ../../vista/dashboard/principal/campañas.php");

}
?>

