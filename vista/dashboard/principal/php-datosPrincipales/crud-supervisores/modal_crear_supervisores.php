<div class="button-add-student">
    <button type="button" class="btn btn-success me-5" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo"><i class="fas fa-building" style='color:#fff;'></i> Registrar <i class="fa-solid fa-square-plus"></i></button>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Nuevo Supervisor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <form onsubmit="validarCampos(event)" method="POST" action="../../../controlador/controlador-principal/controlador-agregarsupervisor.php" enctype="multipart/form-data">
                                <div class="">
                                    <div class="nombre-supervisor" style="text-align:center; background-color:#CFE2FF; border: 1px solid #9ec5fe; margin-bottom: 5px;"><label for="recipient-name" class="col-form-label">Nombre:</label></div>
                                    <input type="text" class="form-control" id="nombre-supervisor" name="nombre-supervisor" style="margin-bottom: 5px;" oninput="soloLetras(this)" onkeyup="validarEmpresa(this);">
                                </div>
                                <div class="">
                                    <div class="apellido-supervisor" style="text-align:center; background-color:#CFE2FF; border: 1px solid #9ec5fe; margin-bottom: 5px;"><label for="recipient-name" class="col-form-label">Apellido:</label></div>
                                    <input type="text" class="form-control" id="apellido-supervisor" name="apellido-supervisor" style="margin-bottom: 5px;" oninput="soloLetras(this)" onkeyup="validarEmpresa(this);">
                                </div>
                                <div class="">
                                    <div class="celular-supervisor" style="text-align:center; background-color:#CFE2FF; border: 1px solid #9ec5fe; margin-bottom: 5px;"> <label for="recipient-name" class="col-form-label">Celular:</label></div>
                                    <input type="text" class="form-control" id="celular-supervisor" name="celular-supervisor" style="margin-bottom: 5px;" oninput="soloLetras(this)">
                                </div>
                                <div class="">
                                    <div class="direccion-supervisor" style="text-align:center; background-color:#CFE2FF; border: 1px solid #9ec5fe; margin-bottom: 5px;"> <label for="recipient-name" class="col-form-label">Dirección:</label>:</label></div>
                                    <input type="text" class="form-control" id="direccion-supervisor" name="direccion-supervisor" style="margin-bottom: 5px;" oninput="soloLetras(this)">
                                </div>
                                <div class="">
                                    <div class="sexo-supervisor" style="text-align:center; background-color:#CFE2FF; border: 1px solid #9ec5fe; margin-bottom: 5px;"> <label for="recipient-name" class="col-form-label">Sexo:</label>:</label></div>
                                    <select class="form-select" id="sexo-supervisor" name="sexo-supervisor" style="margin-bottom: 5px;">
                                    <option value="masculino">Masculino</option>
                                    <option value="femenino">Femenino</option>
                                  </select>
                                </div>
                                <div class="">
                                    <div class="fecnac-supervisor" style="text-align:center; background-color:#CFE2FF; border: 1px solid #9ec5fe; margin-bottom: 5px;"><label for="recipient-name" class="col-form-label">Fecha nacimiento:</label></div>
                                    <input type="date" class="form-control" id="fecnac-supervisor" name="fecnac-supervisor" style="margin-bottom: 5px;" oninput="soloLetras(this)" onkeyup="validarEmpresa(this);">
                                </div>
                                <div class="">
                                    <div class="empresa-supervisor" style="text-align:center; background-color:#CFE2FF; border: 1px solid #9ec5fe; margin-bottom: 5px;"><label for="recipient-name" class="col-form-label">Empresa:</label></div>
                                    <select class="form-select" id="empresa-supervisor" name="empresa-supervisor" required>
                                        <?php
                                        $sql_empresas = "SELECT idempresa, razonsocial FROM empresa";
                                        $result_empresas = $conn->query($sql_empresas);
                                        if ($result_empresas->num_rows > 0) {
                                            while ($row = $result_empresas->fetch_assoc()) {
                                                $idEmpresa = $row['idempresa'];
                                                $razonSocial = htmlspecialchars($row['razonsocial']);
                                                echo "<option value='$idEmpresa'>$razonSocial</option>";
                                            }
                                        } else {
                                            echo "<option value=''>No hay empresas disponibles</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="">
                                    <div class="campaña-supervisor" style="text-align:center; background-color:#CFE2FF; border: 1px solid #9ec5fe; margin-bottom: 5px;"><label for="recipient-name" class="col-form-label">Campaña:</label></div>
                                    <select class="form-select" id="campaña-supervisor" name="campaña-supervisor" required>
                                        <?php
                                        $sql_campaña = "SELECT id_campaña, nombre_campaña FROM campaña";
                                        $result_campaña = $conn->query($sql_campaña);
                                        if ($result_campaña->num_rows > 0) {
                                            while ($row = $result_campaña->fetch_assoc()) {
                                                $idCampaña = $row['id_campaña'];
                                                $nombreCampaña = htmlspecialchars($row['nombre_campaña']);
                                                echo "<option value='$idCampaña'>$nombreCampaña</option>";
                                            }
                                        } else {
                                            echo "<option value=''>No hay campañas disponibles</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="">
                                    <div class="usuario-supervisor" style="text-align:center; background-color:#CFE2FF; border: 1px solid #9ec5fe; margin-bottom: 5px;"><label for="recipient-name" class="col-form-label">Usuario:</label></div>
                                    <input type="text" class="form-control" id="usuario-supervisor" name="usuario-supervisor" style="margin-bottom: 5px;" oninput="soloLetras(this)" onkeyup="validarEmpresa(this);">
                                </div>
                                <div class="">
                                    <div class="contraseña-supervisor" style="text-align:center; background-color:#CFE2FF; border: 1px solid #9ec5fe; margin-bottom: 5px;"><label for="recipient-name" class="col-form-label">Contraseña:</label></div>
                                    <input type="text" class="form-control" id="contraseña-supervisor" name="contraseña-supervisor" style="margin-bottom: 5px;" oninput="soloLetras(this)" onkeyup="validarEmpresa(this);">
                                </div>
                                <div class="modal-footer d-flex justify-content-center">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                                    <button type="submit" name="submit" class="btn btn-success">Registrar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
                function validarCampos(event) {
            const campos = document.querySelectorAll('.form-control');
            let formularioValido = true;

            campos.forEach(campo => {
                if (campo.value.trim() === '') {
                    formularioValido = false;
                    campo.style.borderColor = 'red';
                } else {
                    campo.style.borderColor = '';
                }
            });

            if (!formularioValido) {
                alert('Todos los campos deben estar llenos.');
                event.preventDefault();
            }
        }
    </script>
</div>