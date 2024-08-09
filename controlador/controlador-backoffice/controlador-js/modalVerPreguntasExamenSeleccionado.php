<?php
@include '../../../modelo/conexion.php';

if (isset($_POST['click_btn_ver'])) {
    $id = $_POST['user_id'];
    $sql = "SELECT * FROM preguntas WHERE id_examen = '$id'";
    $resultado = mysqli_query($conn, $sql);

    if (mysqli_num_rows($resultado) > 0) {
        $preguntas_html = '';
        while ($fila = mysqli_fetch_array($resultado)) {
            $preguntas_html .= '<tr style="text-align: center;">';
            $preguntas_html .= '<td class="user_id" style="display: none;">' . $fila['id_pregunta'] . '</td>';
            $preguntas_html .= '<td>' . $fila['pregunta_texto'] . '</td>';
            $preguntas_html .= '<td>' . $fila['opcion_1'] . '</td>';
            $preguntas_html .= '<td>' . $fila['opcion_2'] . '</td>';
            $preguntas_html .= '<td>' . $fila['opcion_3'] . '</td>';
            $preguntas_html .= '<td>' . $fila['opcion_4'] . '</td>';
            $preguntas_html .= '<td>' . $fila['opcion_5'] . '</td>';
            $preguntas_html .= '<td>' . $fila['respuesta_correcta'] . '</td>';
            $preguntas_html .= '<td>' . $fila['puntaje'] . '</td>';
            $preguntas_html .= '</tr>';
        }
        echo "<table class='table table-bordered'>";
        echo "<thead>";
        echo "<tr style='text-align: center;' class='table-info'>";
        echo "<th scope='col' style='display: none;'>id</th>";
        echo "<th scope='col'>Pregunta</th>";
        echo "<th scope='col'>opcion 1</th>";
        echo "<th scope='col'>opcion 2</th>";
        echo "<th scope='col'>opcion 3</th>";
        echo "<th scope='col'>opcion 4</th>";
        echo "<th scope='col'>opcion 5</th>";
        echo "<th scope='col'>Respuesta correcta</th>";
        echo "<th scope='col'>Puntaje</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        echo "$preguntas_html";
        echo "</tbody>";
        echo "</table>";
        if (mysqli_num_rows($resultado) == 0) {
            echo '<p>No hay datos disponibles.</p>';
        } else {
            echo '<p style="text-align: start;">Se encontraron ' . mysqli_num_rows($resultado) . ' preguntas para este examen.</p>';
        }
    } else {
        echo '  <div class="alert alert-warning" role="alert">
                    <p style="text-align: center;">No se ha creado preguntas para este examen</p>
                </div>';
    }
}
