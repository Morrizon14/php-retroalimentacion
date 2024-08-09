<?php
session_start();
// Incluir archivo de conexión a la base de datos
include '../../modelo/conexion.php';

// Verificación de datos y conexión a la base de datos
if(isset($_POST['submit'])) {
    $nombre = $_POST['nombre-supervisor'];
    $apellido = $_POST['apellido-supervisor'];
    $celular = $_POST['celular-supervisor'];
    $direccion = $_POST['direccion-supervisor'];
    $sexo = $_POST['sexo-supervisor'];
    $fecnac = $_POST['fecnac-supervisor'];
    $empresa = $_POST['empresa-supervisor'];
    $campana = $_POST['campaña-supervisor'];
    $usuario = $_POST['usuario-supervisor'];
    $contraseña = $_POST['contraseña-supervisor'];
    
    // Aquí deberías realizar la validación de los datos recibidos

    // Iniciar una transacción para asegurar la atomicidad de las operaciones
    mysqli_begin_transaction($conn);

    try {
        // Insertar datos en la tabla supervisor
        $sql1 = "INSERT INTO colaborador (id_rol, nombre, apellido, celular, direccion, sexo, fecha_nacimiento, id_empresa, id_campaña) 
                 VALUES (2, '$nombre', '$apellido', '$celular', '$direccion', '$sexo', '$fecnac', '$empresa', '$campana')";
        
        if(mysqli_query($conn, $sql1)) {
            // Obtener el id del último insert en la tabla supervisor
            $id_colaborador = mysqli_insert_id($conn);

            // Insertar datos en la tabla login
            $sql2 = "INSERT INTO login (id_colaborador, id_rol, usuario, contraseña) 
                     VALUES ('$id_colaborador', 2, '$usuario', '$contraseña')";
            
            if(mysqli_query($conn, $sql2)) {
                // Confirmar la transacción si ambas consultas tienen éxito
                mysqli_commit($conn);
                $_SESSION['mensaje'] = "Supervisor y usuario agregado correctamente.";
            } else {
                // Si falla la segunda consulta, revertir la transacción
                mysqli_rollback($conn);
                $_SESSION['mensaje'] = "Error al registrar usuario: " . mysqli_error($conn);
            }
        } else {
            // Si falla la primera consulta, revertir la transacción
            mysqli_rollback($conn);
            echo "Error al registrar supervisor: " . mysqli_error($conn);
        }
    } catch (Exception $e) {
        // Manejar cualquier excepción que pueda surgir
        mysqli_rollback($conn);
        echo "Error en la transacción: " . $e->getMessage();
    }

    // Cerrar conexión
    mysqli_close($conn);
    header("Location: ../../vista/dashboard/principal/supervisores.php");

}
?>
