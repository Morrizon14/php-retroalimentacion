<div class="menu">
    <ion-icon name="menu-outline"></ion-icon>
    <ion-icon name="close-outline"></ion-icon>
</div>

<div class="barra-lateral">
    <div>
        <div class="nombre-pagina">
            <ion-icon id="cloud" name="cloud-outline"></ion-icon>
            <span>GENERAL</span>
        </div>
        <div class="usuario">
            <img src="/Jhampier.jpg" alt="">
            <div class="info-usuario">
                <div class="nombre-email">
                    <span class="email">general@gmail.com</span>
                </div>
            </div>
        </div>
    </div>
    <div class="linea mb-3"></div>

    <nav class="navegacion">
        <div class="seccion">
            <p><sub>Menu Principal</sub></p>
            <ul>
                <li>
                    <a id="inbox" href="./principal.php">
                        <ion-icon name="home-outline"></ion-icon>
                        <span>Inicio</span>
                    </a>
                </li>
                <li>
                    <div class="dropdown">
                        <button class="btn  dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            Datos Principales
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="./empresas.php">Empresa</a></li>
                            <li><a class="dropdown-item" href="./campañas.php">Campañas</a></li>
                            <li><a class="dropdown-item" href="./tematica.php">Tematica</a></li>
                            <li><a class="dropdown-item" href="./backoffice.php">Backoffice</a></li>
                            <li><a class="dropdown-item" href="./supervisores.php">Supervisores</a></li>
                            <li><a class="dropdown-item" href="./asesores.php">Asesores</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <div>
        <div class="linea"></div>

        <div class="modo-oscuro">
            <div class="info">
                <ion-icon name="log-in-outline"></ion-icon>
                <a href="../../login/logout.php">Cerrar sesion</a>
            </div>
        </div>
    </div>

</div>