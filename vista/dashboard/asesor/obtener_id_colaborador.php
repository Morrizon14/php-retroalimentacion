<?php
session_start(); // Asegurarse de iniciar la sesión si no se ha hecho aún

if (isset($_SESSION['id_colaborador'])) {
    echo $_SESSION['id_colaborador'];
} else {
    echo 'No se encontró el ID del colaborador en la sesión';
}
?>
