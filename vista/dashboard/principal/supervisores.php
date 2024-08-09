<?php
session_start();
@include '../../../modelo/conexion.php';

if(!isset($_SESSION['general_name'])){
   header('location:../../login/login.php');
}
$nombre_sesion = $_SESSION['general_name'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supervisores - <?php echo $nombre_sesion; ?></title>
    <link rel="icon" href="../../login/icono.ico" type="image/x-icon">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="./style.css">

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="./script.js"></script>
    <script src="./js-principal/validarInputs.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

    <!-- DataTables JavaScript -->
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.25/b-1.7.1/b-html5-1.7.1/datatables.min.js"></script>

    <!-- JSZip (necesario para Buttons) -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <!-- DataTables Buttons extension -->
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>

    <!-- jsPDF and pdfmake for PDF export -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.25/b-1.7.1/b-html5-1.7.1/datatables.min.css" />

    <!-- SCRIPT AJAX TABLA EMPRESAS -->
    <script src="./js-principal/tabla-empresas.js"></script>

    <!-- SCRIPT AJAX - ESTADO DEL BOTON Y DEL EMPRESAS -->
    <script src="./js-principal/estadoBotonEmpresas.js"></script>

    <!-- SCRIPT AJAX - VER INFORMACION EMPRESAS SELECCIONADO-->
    <script src="./js-principal/verInformacionEmpresaSeleccionado.js"></script>

    <!-- SCRIPT AJAX - EDITAR INFORMACION EMPRESAS SELECCIONADO-->
    <script src="./js-principal/editarInformacionEmpresaSeleccionado.js"></script>

    <!-- SCRIPT AJAX - VER INFORMACION DE TODOS LAS EMPRESAS DESACTIVOS -->
    <script src="./js-principal/verInformacionTablaModalEmpresasNoSeleccionado.js"></script>


</head>
<body class="bg-content">

    <!-- EMPIEZA sidebar -->
    <?php @include './php-principal/sidebar.php' ?>
    <!-- FINALIZA sidebar -->

    <main class="dashboard d-flex">

        <!-- MODAL PARA VER LA TABLA COMPLETA DE LAS EMPRESAS DESACTIVOS -->
        <?php @include './php-principal/modal_ver_empresas_desactivos.php' ?>


        <!-- MODAL PARA VER LA INFORMACION COMPLETA DE LA EMPRESA SELECCIONADO -->
        <?php @include './php-principal/modal_ver_empresa_seleccionado.php' ?>

        <!--  MODAL PARA EDITAR LA INFORMACION COMPLETA DE LA EMPRESA SELECCIONADO  -->
        <?php @include './php-principal/modal_editar_empresa_seleccionado.php' ?>

        <!-- start content page -->
        <div class="container-fluid px">

            <!-- ***** MODAL DE ALERTA DE PROCESO EXITOSO USANDO SESSION Y SWEET ALERT2 ***** -->
            <?php @include './php-principal/modal_alerta_exitoso_conSession.php' ?>

            <!-- EMPEZAR TABLA DE LISTA DE CAMPAÑAS -->
            <div class="student-list-header d-flex justify-content-between align-items-center py-2">
                <div class="title h6 fw-bold">Datos Supervisores - <?php echo $nombre_sesion; ?></div>

                <div class="btn-add d-flex gap-3 align-items-center">

                    <!-- *** MODAL PARA CREAR TEMATICAS ***-->
                    <?php @include './php-datosPrincipales/crud-supervisores/modal_crear_supervisores.php' ?>
                    <!-- *************************************** -->

                    <div class="btn-postulantes-desactivos">
                        <a href="" class="btn-verDesactivo"><i class="fas fa-eye-slash me-5 h4"></i></a>
                    </div>
                </div>
            </div>

            <div class="table-responsive col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <!-- Necesario Clase busqueda: tabla -->
                <table class="table student_list table-borderless tabla table-striped tabla w-100" id="myTable">
                    <thead class="table-dark ">
                        <style>
                            .centrado {
                                text-align: center !important;
                                vertical-align: middle !important;
                            }
                        </style>

                        <tr class="align-middle centrado"><!--  -->
                            <th style="display: none;">ID</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Celular</th>
                            <th>Fecha nacimineto</th>
                            <th>Empresa</th>
                            <th>Campaña</th>
                            <th> </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include '../../../modelo/conexion.php';
                        /* $sql = "SELECT * FROM colaborador WHERE id_rol = 2 "; */
                        $sql = "SELECT 
                                    colaborador.id_colaborador AS idColaborador,
                                    colaborador.nombre AS nombreColaborador,
                                    colaborador.apellido AS apellidoColaborador,
                                    colaborador.celular AS celularColaborador,
                                    colaborador.fecha_nacimiento AS fechanacimientoColaborador,
                                    empresa.razonsocial AS nombreEmpresa,
                                    campaña.nombre_campaña AS nombreCampaña 
                                FROM 
                                    colaborador 
                                LEFT JOIN 
                                    empresa ON colaborador.id_empresa = empresa.idempresa 
                                LEFT JOIN 
                                    campaña ON colaborador.id_campaña = campaña.id_campaña
                                WHERE colaborador.id_rol = 2 ";

                        $resultado = mysqli_query($conn, $sql);
                        if ($resultado && mysqli_num_rows($resultado) > 0) {
                            while ($fila = mysqli_fetch_assoc($resultado)) {
                        ?>
                                <tr class="bg-white align-middle centrado">
                                    <td class="user_id" style="display: none;"><?php echo $fila['idColaborador']; ?></td>
                                    <td class=""><?php echo $fila['nombreColaborador']; ?></td>
                                    <td class=""><?php echo $fila['apellidoColaborador']; ?></td>
                                    <td class=""><?php echo $fila['celularColaborador']; ?></td>
                                    <td class=""><?php echo $fila['fechanacimientoColaborador']; ?></td>
                                    <td class=""><?php echo $fila['nombreEmpresa']; ?></td>
                                    <td class=""><?php echo $fila['nombreCampaña']; ?></td>
                                    <td class="">
                                        <a href="" class=" btn-ver me-0"><i class="far fa-eye" style="color: #2E59EA;"></i></a>
                                        <a href="" class="btn-editar ms-0"><i class="far fa-pen" style="color: #EAD42E;"></i></a>
                                    </td>
                                </tr>
                        <?php
                            }
                        }
                        mysqli_free_result($resultado);
                        mysqli_close($conn);

                        ?>

                    </tbody>
                </table>
            </div>

        </div>
        <!-- end contentpage -->
    </main>

</body>
</html>