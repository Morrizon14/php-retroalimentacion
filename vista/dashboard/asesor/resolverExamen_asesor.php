<?php
session_start();
@include '../../../modelo/conexion.php';

if (!isset($_SESSION['asesor_name'])) {
    header('location: ../../login/login.php');
    exit;
}

if (isset($_GET['id_examen'])) {
    $id_examen = (int)$_GET['id_examen'];
} else {
    echo "No se ha proporcionado el ID del examen.";
    exit;
}

$id_colaborador = $_SESSION['id_login'];
@include '../../../controlador/controlador-asesor/listar-preguntas.php';

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrar Datos JSON en el Mismo Archivo PHP</title>
    <link rel="stylesheet" href="./asesor.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

</head>

<body>
    <p><?php echo $id_login ?></p>
    <!-- start Quiz button -->
    <div class="start_btn"><button>Iniciar Examen</button></div>

    <!-- Info Box -->
    <div class="info_box">
        <div class="info-title"><span>Reglas de tu Examen en Línea</span></div>
        <div class="info-list">
            <div class="info">1. Solo tendrás <span>15 segundos</span> para responder cada pregunta.</div>
            <div class="info">2. Una vez que seleccionas tu respuesta, no se puede deshacer.</div>
            <div class="info">3. No puedes seleccionar ninguna opción una vez que se acaba el tiempo.</div>
            <div class="info">4. No puedes salir del Quiz mientras está corriendo el tiempo.</div>
            <div class="info">5. Obtendrás puntos con base en tus respuestas correctas.</div>
        </div>
        <div class="buttons">
            <button class="quit">Salir</button>
            <button class="restart">Continuar</button>
        </div>
    </div>

    <!-- Quiz Box -->
    <div class="quiz_box">
        <header>
            <div class="title">Examen en línea</div>
            <div class="timer">
                <div class="time_left_txt">Tiempo Restante</div>
                <div class="timer_sec">15</div>
            </div>
            <div class="time_line"></div>
        </header>
        <section>
            <div class="que_text">
                <!-- Aquí se insertará la pregunta desde JavaScript -->
            </div>
            <div class="option_list">
                <!-- Aquí se insertarán las opciones desde JavaScript -->
            </div>
        </section>

        <!-- footer of Quiz Box -->
        <footer>
            <div class="total_que">
                <!-- Aquí se insertará el número de pregunta desde JavaScript -->
            </div>
            <button class="next_btn">Siguiente Pregunta</button>
        </footer>
    </div>

    <!-- Result Box -->
    <div class="result_box">
        <div class="icon">
            <i class="fas fa-crown"></i>
        </div>
        <div class="complete_text">¡Has finalizado tu examen!</div>
        <div class="score_text">
            <!-- Aquí se insertará el resultado del puntaje desde JavaScript -->
        </div>
        <div class="buttons">
            <!-- <button class="restart">Repetir</button> -->
            <button class="quit">Salir</button>
        </div>
    </div>

    <input type="hidden" id="id_colaborador" value="<?php echo $id_colaborador; ?>">
    <input type="hidden" id="id_examen" value="<?php echo $id_examen; ?>">

    <script>
        const questions = <?php echo $questions_json; ?>;
    </script>
    <script src="./scripts.js"></script>
</body>

</html>