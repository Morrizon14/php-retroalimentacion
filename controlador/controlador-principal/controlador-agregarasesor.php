<?php
session_start();
// Verificación de datos y conexión a la base de datos
if(isset($_POST['submit'])) {
  include '../../modelo/conexion.php';
    $nombre = $_POST['nombre_asesor'];
    $apellido = $_POST['apellido_asesor'];
    $celular = $_POST['celular-asesor'];
    $direccion = $_POST['direccion-asesor'];
    $sexo = $_POST['sexo-asesor'];
    $fecnac = $_POST['fecnac-asesor'];
    $empresa = $_POST['empresa-asesor'];
    $tematica = $_POST['tematica-asesor'];
    $usuario = $_POST['usuario-asesor'];
    $contraseña = $_POST['contraseña-asesor'];
    
    
    // Aquí deberías realizar la validación de los datos recibidos

    
    // Iniciar una transacción para asegurar la atomicidad de las operaciones
    mysqli_begin_transaction($conn);

    try {
        // Insertar datos en la tabla asesores
        $sql1 = "INSERT INTO colaborador (id_rol, nombre, apellido, celular, direccion, sexo, fecha_nacimiento, id_empresa, id_tematica) 
                 VALUES (3, '$nombre', '$apellido', '$celular', '$direccion', '$sexo', '$fecnac', '$empresa', '$tematica')";
        
        if(mysqli_query($conn, $sql1)) {
            // Obtener el id del último insert en la tabla asesores
            $id_colaborador = mysqli_insert_id($conn);

            // Insertar datos en la tabla usuarios
            $sql2 = "INSERT INTO login (id_colaborador, id_rol, usuario, contraseña) 
                     VALUES ('$id_colaborador', 3, '$usuario', '$contraseña')";
            
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
            $_SESSION['mensaje'] ="Error al registrar asesor: " . mysqli_error($conn);
            
        }
    } catch (Exception $e) {
        // Manejar cualquier excepción que pueda surgir
        mysqli_rollback($conn);
        $_SESSION['mensaje'] ="Error en la transacción: " . mysqli_error($conn);
    }

    // Cerrar conexión
    mysqli_close($conn);
    header("Location: ../../vista/dashboard/principal/asesores.php");
}
?>
