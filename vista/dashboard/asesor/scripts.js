// Selección de elementos del DOM
const start_btn = document.querySelector(".start_btn button");
const info_box = document.querySelector(".info_box");
const exit_btn = info_box.querySelector(".buttons .quit");
const continue_btn = info_box.querySelector(".buttons .restart");
const quiz_box = document.querySelector(".quiz_box");
const result_box = document.querySelector(".result_box");
const option_list = document.querySelector(".option_list");
const time_line = document.querySelector("header .time_line");
const timeText = document.querySelector(".timer .time_left_txt");
const timeCount = document.querySelector(".timer .timer_sec");
const next_btn = document.querySelector(".next_btn");
const bottom_ques_counter = document.querySelector("footer .total_que");

// Variables globales para el examen
let que_count = 0;
let que_numb = 1;
let userScore = 0;
let counter;
let counterLine;
const timeValue = 15;
let widthValue = 0;
const que_text = document.querySelector(".que_text");

// Evento al hacer clic en "Iniciar Examen"
start_btn.onclick = () => {
    info_box.classList.add("activeInfo"); // Mostrar información
}

// Evento al hacer clic en "Salir" dentro de la información
exit_btn.onclick = () => {
    info_box.classList.remove("activeInfo"); // Ocultar información
}

// Evento al hacer clic en "Continuar" dentro de la información
continue_btn.onclick = () => {
    info_box.classList.remove("activeInfo"); // Ocultar información
    quiz_box.classList.add("activeQuiz"); // Mostrar caja del examen
    showQuestions(0); // Mostrar la primera pregunta
    questionCounter(1); // Contador de preguntas
    startTimer(timeValue); // Iniciar temporizador
    startTimerLine(widthValue); // Iniciar línea de tiempo
}

// Evento al hacer clic en "Siguiente Pregunta"
next_btn.onclick = () => {
    if (que_count < questions.length - 1) {
        que_count++;
        que_numb++;
        showQuestions(que_count);
        questionCounter(que_numb);
        clearInterval(counter);
        clearInterval(counterLine);
        startTimer(timeValue);
        startTimerLine(widthValue);
        next_btn.classList.remove("show");
    } else {
        clearInterval(counter);
        clearInterval(counterLine);
        showResult();
    }
}

// Función para mostrar preguntas y opciones
function showQuestions(index) {
    const que_tag = `<span>${questions[index].numb}. ${questions[index].question}</span>`;
    let option_tag = '';
    for (let i = 0; i < questions[index].options.length; i++) {
        option_tag += `<div class="option">${questions[index].options[i]}</div>`;
    }
    que_text.innerHTML = que_tag;
    option_list.innerHTML = option_tag;
    const option = option_list.querySelectorAll(".option");

    for (let i = 0; i < option.length; i++) {
        option[i].setAttribute("onclick", "optionSelected(this)");
    }
}

// Función para seleccionar una opción
function optionSelected(answer) {
    clearInterval(counter);
    clearInterval(counterLine);
    let userAns = answer.textContent.trim();
    let correcAns = questions[que_count].answer.trim();
    const allOptions = option_list.children.length;

    if (userAns === correcAns) {
        userScore += questions[que_count].score;
        answer.classList.add("correct");
        answer.insertAdjacentHTML("beforeend", `<div class="icon tick"><i class="fas fa-check"></i></div>`);
    } else {
        answer.classList.add("incorrect");
        answer.insertAdjacentHTML("beforeend", `<div class="icon cross"><i class="fas fa-times"></i></div>`);

        for (let i = 0; i < allOptions; i++) {
            if (option_list.children[i].textContent.trim() === correcAns) {
                option_list.children[i].classList.add("correct");
                option_list.children[i].insertAdjacentHTML("beforeend", `<div class="icon tick"><i class="fas fa-check"></i></div>`);
            }
        }
    }

    for (let i = 0; i < allOptions; i++) {
        option_list.children[i].classList.add("disabled");
    }
    next_btn.classList.add("show");
}

const id_colaborador = document.getElementById('id_colaborador').value;
const id_examen = document.getElementById('id_examen').value;
// Función para mostrar el resultado final
function showResult() {
    result_box.classList.add("activeResult");
    const scoreText = result_box.querySelector(".score_text");

    let totalScore = 0;
    for (let i = 0; i < questions.length; i++) {
        totalScore += questions[i].score;
    }

    let scoreTag = `<span>Tu puntaje es: ${userScore} de ${totalScore}</span>`;
    scoreText.innerHTML = scoreTag;

    // AJAX para enviar la nota al servidor
    $.ajax({
        // Archivo PHP donde se procesa la inserción
        url: '../../../controlador/controlador-asesor/guardar_resultado.php', 
        method: 'POST',
        data: {
            id_colaborador: id_colaborador, 
            id_examen: id_examen, 
            nota: userScore 
        },
        success: function(response) {
            console.log(response); 
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
}


// Función para salir del examen
const quit_quiz = result_box.querySelector(".quit");
quit_quiz.onclick = () => {
    window.location.href = "./lista_examenesPendientes.php";
};

// Función para iniciar el temporizador
function startTimer(time) {
    counter = setInterval(timer, 1000);
    function timer() {
        time--;
        timeCount.textContent = time;

        if (time < 10) {
            timeCount.textContent = "0" + time;
        }

        if (time < 0) {
            clearInterval(counter);
            timeText.textContent = "Tiempo Finalizado";

            const allOptions = option_list.children.length;
            let correcAns = questions[que_count].answer.trim();

            for (let i = 0; i < allOptions; i++) {
                if (option_list.children[i].textContent.trim() === correcAns) {
                    option_list.children[i].classList.add("correct");
                }
            }

            for (let i = 0; i < allOptions; i++) {
                option_list.children[i].classList.add("disabled");
            }

            next_btn.classList.add("show");
        }
    }
}

// Función para iniciar la línea de tiempo
function startTimerLine(time) {
    counterLine = setInterval(timer, 29);
    function timer() {
        time += 1;
        time_line.style.width = time + "px";
        if (time > 549) {
            clearInterval(counterLine);
        }
    }
}

// Función para contar las preguntas
function questionCounter(index) {
    let totalQueCounTag = `<span><p>${index}</p> de <p>${questions.length}</p> Preguntas</span>`;
    bottom_ques_counter.innerHTML = totalQueCounTag;
}
