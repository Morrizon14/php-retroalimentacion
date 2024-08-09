<div class="menu">
    <ion-icon name="menu-outline"></ion-icon>
    <ion-icon name="close-outline"></ion-icon>
</div>

<div class="barra-lateral">
    <div>
        <div class="nombre-pagina">
            <ion-icon name="person-circle-outline"></ion-icon>
            <span>BACKOFFICE</span>
        </div>
        <div class="usuario">
            <img src="/Jhampier.jpg" alt="">
            <div class="info-usuario">
                <div class="nombre-email">
                    <span class="email"><?php echo $fila['usuario']; ?></span>
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
                    <a id="inbox" href="../../backoffice/backoffice.php">
                        <ion-icon name="home-outline"></ion-icon>
                        <span>Inicio</span>
                    </a>
                </li>
                <li>
                    <a href="../../backoffice/backofficelistaExamenes.php">
                        <ion-icon name="document-outline"></ion-icon>
                        <span>Examen</span>
                    </a>
                </li>
                <li>
                    <a href="../../backoffice/backoffice_bancoPreguntas.php">
                        <ion-icon name="copy-outline"></ion-icon>
                        <span>Banco de preguntas</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="seccion">
            <p><sub>Reportes</sub></p>
            <ul>
                <li>
                    <a href="../../backoffice/verResultadosBackoffice.php">
                        <ion-icon name="document-text-outline"></ion-icon>
                        <span>Resultado de examenes</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <div>
        <div class="linea"></div>

        <div class="modo-oscuro">
            <div class="info">
                <ion-icon name="log-in-outline"></ion-icon>
                <a href="../../../../login/logout.php">Cerrar sesion</a>
            </div>
        </div>

        
    </div>

</div>