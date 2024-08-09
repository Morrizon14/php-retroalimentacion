<header>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="../css/components/header.css">
  <link rel="stylesheet" href="../../css/components/header.css" >
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                </ul>
                <div class="d-flex m-4" role="search">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="25" fill="currentColor" class="bi bi-person-fill icono-usuario" viewBox="0 0 16 16">
                        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                    </svg>
                    <a class="nav-link active" aria-current="page" href="">
                        <?php 
                            switch ($_SESSION['role']) {
                                case 'backoffice':
                                    echo 'Hola Backoffice: ' . $_SESSION['backoffice_name'];
                                    break;
                                case 'supervisor':
                                    echo 'Hola Supervisor: ' . $_SESSION['supervisor_name'];
                                    break;
                                case 'asesor':
                                    echo 'Hola Asesor: ' . $_SESSION['asesor_name'];
                                    break;
                                default:
                                    echo 'Hola...';
                                    break;
                            }
                        ?>
                    </a>
                </div>
                <div class="d-flex m-4" role="search">
                    <a class="nav-link active" aria-current="page" href="../../../vista/login/logout.php">Cerrar sesión</a>
                </div>
            </div>
        </div>
    </nav>
</h>