<?php
session_start();
@include '../../../modelo/conexion.php';

if (!isset($_SESSION['supervisor_name'])) {
    header('location:../../login/login.php');
    exit(); // Asegura que el script se detenga después de redirigir
}

$nombre_sesion = $_SESSION['supervisor_name'];
$id_login = $_SESSION['id_login'];


?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supervisor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../principal/style.css">
</head>

<body>
    <?php @include './supervisor-principal/sidebar_supervisor.php'; ?>
    <main>
        <h1>Examenes pendientes</h1>
        <div class="container">
            <!-- Lista de examenes -->
            <h4>Lista de examenes</h4>
            <table class="table table-bordered">
                <thead>
                    <tr style="text-align: center;" class="table-info">
                        <th scope="col">#</th>
                        <th scope="col">Campaña</th>
                        <th scope="col">Creador</th>
                        <th scope="col">Número de preguntas</th>
                        <th scope="col">Tiempo</th>
                        <th scope="col">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Consulta SQL para obtener los exámenes destinados a asesores
                    $sql_examenes = "SELECT e.*, r.id_resultado 
                                    FROM examenes e
                                    LEFT JOIN resultados r ON e.id_examen = r.id_examen AND r.id_colaborador = $id_login
                                    WHERE e.id_rol_destino = 2";
                    $resultado = mysqli_query($conn, $sql_examenes);

                    $num_filas = mysqli_num_rows($resultado);

                    if ($num_filas > 0) {
                        
                        $contador = 1;

                        while ($fila = mysqli_fetch_assoc($resultado)) {
                            if (isset($fila['id_resultado'])) {
                                // Examen con resultado (botón para ver resultado)
                                $boton_texto = " Resultado examen";
                                $boton_url = "./resultadoExamen_asesor.php?id_examen=" . $fila['id_examen'];
                                $boton_clase = "btn-success";
                                $icono = "eye-outline";
                            } else {
                                // Examen sin resultado (botón para tomar examen)
                                $boton_texto = " Tomar examen";
                                $boton_url = "./resolverExamen_supervisor.php?id_examen=" . $fila['id_examen'];
                                $boton_clase = "btn-warning";
                                $icono = "pencil-outline";
                            }
                    ?>
                            <tr style="text-align: center;">
                                <th scope="row"><?php echo $contador; ?></th>
                                <td><?php echo htmlspecialchars($fila['titulo']); ?></td>
                                <td><?php echo htmlspecialchars($fila['id_colaborador_creador']); ?></td>
                                <td><?php echo htmlspecialchars($fila['cantidad_preguntas']); ?></td>
                                <td><?php echo htmlspecialchars($fila['duracion_examen']); ?> min</td>
                                <td>
                                    <a href="<?php echo $boton_url; ?>" class="btn <?php echo $boton_clase; ?>"style="display: inline-block; width: 190px;"><b><ion-icon name="<?php echo $icono; ?>"></ion-icon><?php echo $boton_texto; ?></b></a>
                                </td>
                            </tr>
                        <?php
                            $contador++;
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="6">No hay exámenes disponibles sin resultados.</td>
                        </tr>
                    <?php
                    }
                    ?>

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

<?php
// No es necesario liberar el resultado aquí si vas a seguir utilizándolo
// mysqli_free_result($resultado);
mysqli_close($conn);
?>