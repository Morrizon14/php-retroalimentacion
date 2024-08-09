<?php
@include '../../../../modelo/conexion.php';
session_start();
if (!isset($_SESSION['backoffice_name'])) {
    header('location:../../../../login/login.php');
}
$nombre_sesion = $_SESSION['backoffice_name'];
$id_login = $_SESSION['id_login'];

if (isset($_GET['id_examen'])) {

    //GUARDAMOS EL VALOR DEL ID DEL EXAMEN EN UNA VARIABLE
    $id_examen = $_GET['id_examen'];

    //BUSCAMOS LA CANTIDAD DE PREGUNTAS DEL EXAMEN SELECCIONADO SEGUN SU ID
    $sql_cantidadPreguntasExamen = "SELECT cantidad_preguntas FROM examenes WHERE id_examen = $id_examen";

    $result_cantidadPreguntas = mysqli_query($conn, $sql_cantidadPreguntasExamen);

    if ($result_cantidadPreguntas) {

        $row_cantidadPreguntas = mysqli_fetch_assoc($result_cantidadPreguntas);

        //OBTIENE EL VALOR DEL NOMBRE DE LA EMPRESA
        $numPreguntas = $row_cantidadPreguntas['cantidad_preguntas'];

        // Verificar si ya hay preguntas creadas
        $sql_verificarPreguntas = "SELECT COUNT(*) AS count_preguntas FROM preguntas WHERE id_examen = $id_examen";
        $result_verificarPreguntas = mysqli_query($conn, $sql_verificarPreguntas);

        if ($result_verificarPreguntas) {
            $row_verificarPreguntas = mysqli_fetch_assoc($result_verificarPreguntas);
            $count_preguntas = $row_verificarPreguntas['count_preguntas'];

            if ($count_preguntas > 0) {
                $_SESSION['mensaje'] = "Ya hay preguntas creadas para este examen.";
                header("Location: ../backoffice_bancoPreguntas.php");
                exit;
            }
        } else {
            echo "Error al verificar preguntas: " . mysqli_error($conn);
        }
    } else {
        echo "Error al ejecutar la consulta: para obtener la cantidad de preguntas " . mysqli_error($conn);
    }
} else {
    echo "No se ha proporcionado el ID del examen.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Crear Preguntas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="../backoffice-css/crearPreguntas.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

</head>

<body>
<header>
  <nav class="navbar navbar-expand-lg" style="background-color: #5ed6b3; padding: 20px"> <!-- Cambia bg-primary por el color deseado -->
    <div class="container-fluid">
      <a class="navbar-brand backoffice"  href="../backoffice.php">BACKOFFICE</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end me-5" id="navbarSupportedContent">
        <ul class="navbar-nav mb-2 mb-lg-0">
          <!-- Opciones del menú -->
          <li class="nav-item p-1 regresar">
            <a class="nav-link active" aria-current="page" href="../backoffice_bancoPreguntas.php"><i class="fas fa-arrow-left"></i>&nbsp; &nbsp;  Regresar</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>

        <div class="container">
            <header>Crear preguntas del examen</header>
            <div class="custom-progress-bar" style="--steps: 2;"></div>
            <div class="form-outer">
                <form action="../../../../controlador/controlador-backoffice/crearPreguntas.php" id="multi-step-form" method="POST">
                    <input type="hidden" name="idExamen" value="<?= $id_examen ?>">
                    <input type="hidden" name="numPreguntas" value="<?= $numPreguntas ?>">
                    <!-- Aquí se añadirán los pasos dinámicamente -->
                </form>
            </div>
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    const numPreguntas = <?= $numPreguntas ?>; // Cambia esto al número de preguntas que quieres
                    const fields = ["Nombre de la pregunta", "respuesta correcta", "puntaje", "opcion 1", "opcion 2", "opcion 3", "opcion 4", "opcion 5"];
                    const steps = Array.from({
                        length: numPreguntas
                    }, (_, i) => ({
                        title: `Pregunta ${i + 1}`,
                        fields: fields
                    }));

                    const form = document.getElementById('multi-step-form');
                    const progressContainer = document.querySelector('.custom-progress-bar');

                    // Ajustar el ancho del formulario dinámicamente basado en el número de pasos
                    form.style.width = `${numPreguntas * 100}%`;

                    steps.forEach((step, index) => {
                        const pageNum = index + 1;
                        const page = document.createElement('div');
                        page.classList.add('page');
                        page.style.width = `${100 / numPreguntas}%`; // Ajustar el ancho de cada página dinámicamente

                        if (pageNum === 1) {
                            page.classList.add('slide-page');
                        }

                        const titleDiv = document.createElement('div');
                        titleDiv.classList.add('title');
                        titleDiv.textContent = step.title;
                        titleDiv.style.textAlign = 'center';
                        titleDiv.style.marginBottom = '20px';
                        page.appendChild(titleDiv);

                        const row1 = document.createElement('div');
                        row1.classList.add('row', 'justify-content-center');
                        const row2 = document.createElement('div');
                        row2.classList.add('row', 'justify-content-center');
                        const row3 = document.createElement('div');
                        row3.classList.add('row', 'justify-content-center');

                        step.fields.forEach((field, index) => {
                            const fieldDiv = document.createElement('div');
                            if ([0, 1, 2].includes(index)) {
                                fieldDiv.classList.add('col-md-4');
                                row1.appendChild(fieldDiv);
                            } else if ([3, 4, 5].includes(index)) {
                                fieldDiv.classList.add('col-md-4');
                                fieldDiv.style.margin = '20px 0 10px 0';
                                row2.appendChild(fieldDiv);
                            } else {
                                fieldDiv.classList.add('col-md-4');
                                row3.appendChild(fieldDiv);
                            }

                            const labelDiv = document.createElement('div');
                            labelDiv.classList.add('label');
                            labelDiv.textContent = field;
                            fieldDiv.appendChild(labelDiv);

                            const input = document.createElement('input');
                            input.setAttribute('type', 'text');
                            input.setAttribute('name', `${field.toLowerCase().replace(' ', '_')}${pageNum}`);
                            fieldDiv.appendChild(input);
                        });

                        page.appendChild(row1);
                        page.appendChild(row2);
                        page.appendChild(row3);

                        const btnDiv = document.createElement('div');
                        btnDiv.classList.add('field', 'btns');

                        if (pageNum > 1) {
                            const prevBtn = document.createElement('button');
                            prevBtn.classList.add(`prev-${pageNum - 1}`, 'prev');
                            prevBtn.textContent = 'Atrás';
                            btnDiv.appendChild(prevBtn);
                        }

                        if (pageNum === steps.length) {
                            const submitBtn = document.createElement('button');
                            submitBtn.classList.add('submit', 'disabled');
                            submitBtn.textContent = 'Enviar';
                            submitBtn.setAttribute('disabled', 'disabled');
                            btnDiv.appendChild(submitBtn);
                        } else {
                            const nextBtn = document.createElement('button');
                            nextBtn.classList.add(`next-${pageNum}`, 'next');
                            nextBtn.textContent = 'Siguiente';
                            btnDiv.appendChild(nextBtn);
                        }

                        page.appendChild(btnDiv);
                        form.appendChild(page);

                        const stepDiv = document.createElement('div');
                        stepDiv.classList.add('step');
                        if (pageNum === 1) {
                            stepDiv.classList.add('slide-page');
                        }

                        const stepTitle = document.createElement('p');
                        stepTitle.textContent = `Pregunta ${pageNum}`;
                        stepDiv.appendChild(stepTitle);


                        const bulletDiv = document.createElement('div');
                        bulletDiv.classList.add('bullet');
                        if (pageNum === 1) {
                            bulletDiv.classList.add('active');
                        }
                        const bulletSpan = document.createElement('span');
                        bulletSpan.textContent = pageNum;
                        bulletDiv.appendChild(bulletSpan);
                        stepDiv.appendChild(bulletDiv);

                        const checkDiv = document.createElement('div');
                        checkDiv.classList.add('check', 'fas', 'fa-check');
                        stepDiv.appendChild(checkDiv);

                        progressContainer.appendChild(stepDiv);
                    });

                    const bullet = document.querySelectorAll('.step .bullet');
                    let current = 1;

                    function updateProgress() {
                        bullet.forEach((bullet, idx) => {
                            if (idx < current) {
                                bullet.classList.add("active");
                            } else {
                                bullet.classList.remove("active");
                            }
                        });

                        const totalProgress = ((current - 1) / (bullet.length - 1)) * 100;
                        document.documentElement.style.setProperty("--progress-width", `${totalProgress}%`);
                    }

                    const nextBtns = document.querySelectorAll(".next");
                    const prevBtns = document.querySelectorAll(".prev");

                    nextBtns.forEach(button => {
                        button.addEventListener("click", function(event) {
                            event.preventDefault();
                            if (current < bullet.length) {
                                current += 1;
                                form.style.marginLeft = `-${(current - 1) * 100}%`;
                                updateProgress();
                            }
                        });
                    });

                    prevBtns.forEach(button => {
                        button.addEventListener("click", function(event) {
                            event.preventDefault();
                            if (current > 1) {
                                current -= 1;
                                form.style.marginLeft = `-${(current - 1) * 100}%`;
                                updateProgress();
                            }
                        });
                    });

                    // Función para verificar si todos los campos están llenos
                    function checkFormCompletion() {
                        let allFieldsFilled = true;
                        const inputFields = document.querySelectorAll('input[type="text"]');
                        inputFields.forEach(input => {
                            if (input.value.trim() === '') {
                                allFieldsFilled = false;
                            }
                        });
                        return allFieldsFilled;
                    }

                    const submitBtn = document.querySelector('.submit');

                    // Habilitar o deshabilitar el botón de enviar basado en la validación
                    function updateSubmitButton() {
                        if (checkFormCompletion()) {
                            submitBtn.removeAttribute('disabled');
                            submitBtn.classList.remove('disabled');
                        } else {
                            submitBtn.setAttribute('disabled', 'disabled');
                            submitBtn.classList.add('disabled');
                        }
                    }

                    // Manejar cambios en los campos de entrada
                    const inputFields = document.querySelectorAll('input[type="text"]');
                    inputFields.forEach(input => {
                        input.addEventListener('input', updateSubmitButton);
                    });

                    // Al hacer clic en Enviar, validar el formulario
                    submitBtn.addEventListener('click', function(event) {
                        if (!checkFormCompletion()) {
                            event.preventDefault(); // Evitar el envío si el formulario no está completo
                        }
                    });

                    // Llamar a updateSubmitButton inicialmente para establecer el estado inicial del botón
                    updateSubmitButton();

                    // Función para actualizar el progreso inicial
                    updateProgress();
                });
            </script>
        </div>
</body>

</html>