<?php
session_start();
@include '../../../modelo/conexion.php';

if(!isset($_SESSION['general_name'])){
   header('location:../../login/login.php');
}
$nombre_sesion = $_SESSION['general_name'];
$id_login = $_SESSION['id_login'];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMINISTRADOR - <?php echo $nombre_sesion; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css
">
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <?php @include './php-principal/sidebar.php' ?>
    <?php 
    //Contar empresas
    $sql_empresa = "SELECT COUNT(*) AS count_empresa FROM empresa";
    $result_empresa = mysqli_query($conn, $sql_empresa);
    $row_empresa = mysqli_fetch_assoc($result_empresa);
    $count_empresa = $row_empresa['count_empresa'];
    //Contar tematicas
    $sql_tematica = "SELECT COUNT(*) AS count_tematica FROM tematica";
    $result_tematica = mysqli_query($conn, $sql_tematica);
    $row_tematica = mysqli_fetch_assoc($result_tematica);
    $count_tematica = $row_tematica['count_tematica'];
    //Contar supervisores 
    $sql_supervisor = "SELECT COUNT(*) AS count_supervisor FROM colaborador WHERE id_rol = 2";
    $result_supervisor = mysqli_query($conn, $sql_supervisor);
    $row_supervisor = mysqli_fetch_assoc($result_supervisor);
    $count_supervisor = $row_supervisor['count_supervisor'];
    //Contar asesores
    $sql_asesor = "SELECT COUNT(*) AS count_asesor FROM colaborador WHERE id_rol = 3";
    $result_asesor = mysqli_query($conn, $sql_asesor);
    $row_asesor = mysqli_fetch_assoc($result_asesor);
    $count_asesor = $row_asesor['count_asesor'];
    //Contar campañas
    $sql_campaña = "SELECT COUNT(*) AS count_campaña FROM campaña";
    $result_campaña = mysqli_query($conn, $sql_campaña);
    $row_campaña = mysqli_fetch_assoc($result_campaña);
    $count_campaña = $row_campaña['count_campaña'];
    //Contar preguntas
    $sql_preguntas = "SELECT COUNT(*) AS count_preguntas FROM preguntas";
    $result_preguntas = mysqli_query($conn, $sql_preguntas);
    $row_preguntas = mysqli_fetch_assoc($result_preguntas);
    $count_preguntas = $row_preguntas['count_preguntas'];
    //Contar resultados
    $sql_resultados= "SELECT COUNT(*) AS count_resultados FROM resultados";
    $result_resultados = mysqli_query($conn, $sql_resultados);
    $row_resultados = mysqli_fetch_assoc($result_resultados);
    $count_resultados = $row_resultados['count_resultados'];
    //Contar backoffice
    $sql_backoffice = "SELECT COUNT(*) AS count_backoffice FROM colaborador WHERE id_rol = 1";
    $result_backoffice = mysqli_query($conn, $sql_backoffice);
    $row_backoffice = mysqli_fetch_assoc($result_backoffice);
    $count_backoffice = $row_backoffice['count_backoffice'];
    ?>
    <main>
        <h1>Dashboard - <?php echo $nombre_sesion; ?></h1>
        <div class="row m-3">
    <div class="col-sm-3">
        <div class="card bg-primary">
            <div class="card-body">
                <h5 class="card-title"><?php echo $count_empresa; ?></h5>
                <p class="card-text">Sedes</p>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="card bg-info">
            <div class="card-body">
                <h5 class="card-title"><?php echo $count_tematica; ?></h5>
                <p class="card-text">Tematicas</p>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="card bg-success">
            <div class="card-body">
                <h5 class="card-title"><?php echo $count_supervisor; ?></h5>
                <p class="card-text">Supervisores</p>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="card bg-danger">
            <div class="card-body">
                <h5 class="card-title"><?php echo $count_asesor ; ?></h5>
                <p class="card-text">Asesores</p>
            </div>
        </div>
    </div>
</div>
<div class="row m-3">
    <div class="col-sm-3">
        <div class="card bg-warning">
            <div class="card-body">
                <h5 class="card-title"><?php echo $count_campaña ; ?></h5>
                <p class="card-text">Campañas</p>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="card bg-success">
            <div class="card-body">
                <h5 class="card-title"><?php echo $count_preguntas ; ?></h5>
                <p class="card-text">Preguntas</p>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="card bg-primary">
            <div class="card-body">
                <h5 class="card-title"><?php echo $count_resultados ; ?></h5>
                <p class="card-text">Resultados</p>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="card bg-info">
            <div class="card-body">
                <h5 class="card-title"><?php echo $count_backoffice ; ?></h5>
                <p class="card-text">Backoffice</p>
            </div>
        </div>
    </div>
</div>

    </main>


    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./script.js"></script>
</body>

</html>