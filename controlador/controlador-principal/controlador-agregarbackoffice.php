<?php
session_start();
// Incluir archivo de conexión a la base de datos
include '../../modelo/conexion.php';

// Verificación de datos y conexión a la base de datos
if(isset($_POST['submit'])) {
    $nombre = $_POST['nombre-backoffice'];
    $apellido = $_POST['apellido-backoffice'];
    $celular = $_POST['celular-backoffice'];
    $direccion = $_POST['direccion-backoffice'];
    $sexo = $_POST['sexo-backoffice'];
    $fecnac = $_POST['fecnac-backoffice'];
    $empresa = $_POST['nombre-empresa'];
    $campana = $_POST['nombre-campaña'];
    $usuario = $_POST['usuario-backoffice'];
    $contraseña = $_POST['contraseña-backoffice'];
    
    // Aquí deberías realizar la validación de los datos recibidos

    // Iniciar una transacción para asegurar la atomicidad de las operaciones
    mysqli_begin_transaction($conn);

    try {
        // Insertar datos en la tabla backoffice
        $sql1 = "INSERT INTO colaborador (id_rol, nombre, apellido, celular, direccion, sexo, fecha_nacimiento, id_empresa, id_campaña) 
                 VALUES (1, '$nombre', '$apellido', '$celular', '$direccion', '$sexo', '$fecnac', '$empresa', '$campana')";
        
        if(mysqli_query($conn, $sql1)) {
            // Obtener el id del último insert en la tabla backoffice
            $id_colaborador = mysqli_insert_id($conn);

            // Insertar datos en la tabla login
            $sql2 = "INSERT INTO login (id_colaborador, id_rol, usuario, contraseña) 
                     VALUES ('$id_colaborador', 1, '$usuario', '$contraseña')";
            
            if(mysqli_query($conn, $sql2)) {
                // Confirmar la transacción si ambas consultas tienen éxito
                mysqli_commit($conn);
                $_SESSION['mensaje'] = "Usuario agregado correctamente.";
            } else {
                // Si falla la segunda consulta, revertir la transacción
                mysqli_rollback($conn);
                $_SESSION['mensaje'] = "Error al registrar usuario: " . mysqli_error($conn);
            }
        } else {
            // Si falla la primera consulta, revertir la transacción
            mysqli_rollback($conn);
            $_SESSION['mensaje'] ="Error al registrar backoffice: " . mysqli_error($conn);
        }
    } catch (Exception $e) {
        // Manejar cualquier excepción que pueda surgir
        mysqli_rollback($conn);
        $_SESSION['mensaje'] ="Error en la transacción: " . mysqli_error($conn);
    }

    // Cerrar conexión
    mysqli_close($conn);
    header("Location: ../../vista/dashboard/principal/backoffice.php");

}
?>
