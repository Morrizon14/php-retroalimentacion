<div class="menu">
    <ion-icon name="menu-outline"></ion-icon>
    <ion-icon name="close-outline"></ion-icon>
</div>

<div class="barra-lateral">
    <div>
        <div class="nombre-pagina">
            <ion-icon name="person-circle-outline"></ion-icon>
            <span>SUPERVISOR</span>
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
                    <a id="inbox" href="../supervisor/supervisor.php">
                        <ion-icon name="home-outline"></ion-icon>
                        <span>Inicio</span>
                    </a>
                </li>
                
                <li>
                    <a href="../supervisor/supervisor_bancoPreguntas.php">
                    <ion-icon name="copy-outline"></ion-icon>
                        <span>Banco de Preguntas</span>
                    </a>
                </li>
                <li>
                    <a href="../supervisor/supervisorExamenesPendientes.php">
                        <ion-icon name="clipboard-outline"></ion-icon>
                        <span>Examenes Pendientes</span>
                    </a>
                </li>
                <li>
                    <a href="../supervisor/supervisor_listaExamenes.php">
                        <ion-icon name="document-outline"></ion-icon>
                        <span>Examenes</span>
                    </a>
                </li>
                <div class="seccion">
            <p><sub>Reportes</sub></p>
            <ul>
                <li>
                    <a href="../supervisor/supervisorVerResultadosAsesores.php">
                        <ion-icon name="document-text-outline"></ion-icon>
                        <span>Resultado de examenes</span>
                    </a>
                </li>
            </ul>
        </div>
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