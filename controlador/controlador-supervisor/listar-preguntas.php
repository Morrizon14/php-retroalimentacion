<?php

    // Consulta para obtener las preguntas
$sql = "SELECT id_pregunta, pregunta_texto, opcion_1, opcion_2, opcion_3, opcion_4, opcion_5, respuesta_correcta, puntaje FROM preguntas where id_examen = $id_examen";
$result = $conn->query($sql);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if ($result === false) {
    die("Error en la consulta: " . $conn->error);
}

$questions = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $options = [];
        if (!empty($row["opcion_1"])) $options[] = $row["opcion_1"];
        if (!empty($row["opcion_2"])) $options[] = $row["opcion_2"];
        if (!empty($row["opcion_3"])) $options[] = $row["opcion_3"];
        if (!empty($row["opcion_4"])) $options[] = $row["opcion_4"];
        if (!empty($row["opcion_5"])) $options[] = $row["opcion_5"];

        $questions[] = [
            "numb" => $row["id_pregunta"],
            "question" => $row["pregunta_texto"],
            "answer" => $row["respuesta_correcta"],
            "options" => $options,
            "score" => (int)$row["puntaje"] // Nuevo campo para el puntaje
        ];
    }
} else {
    echo "0 results";
}
$conn->close();

$questions_json = json_encode($questions);

?>