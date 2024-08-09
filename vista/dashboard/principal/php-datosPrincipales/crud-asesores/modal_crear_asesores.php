<div class="button-add-student">
    <button type="button" class="btn btn-success me-5" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo"><i class="fas fa-building" style='color:#fff;'></i> Registrar <i class="fa-solid fa-square-plus"></i></button>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Nuevo Asesor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <form onsubmit="validarCampos(event)" method="POST" action="../../../controlador/controlador-principal/controlador-agregarasesor.php" enctype="multipart/form-data">
                                <div class="">
                                    <div class="nombre-asesor" style="text-align:center; background-color:#CFE2FF; border: 1px solid #9ec5fe; margin-bottom: 5px;"><label for="recipient-name" class="col-form-label">Nombre:</label></div>
                                    <input type="text" class="form-control" id="nombre_asesor" name="nombre_asesor" style="margin-bottom: 5px;" oninput="soloLetras(this)" onkeyup="validarEmpresa(this);">
                                </div>
                                <div class="">
                                    <div class="apellido_asesor" style="text-align:center; background-color:#CFE2FF; border: 1px solid #9ec5fe; margin-bottom: 5px;"><label for="recipient-name" class="col-form-label">Apellido:</label></div>
                                    <input type="text" class="form-control" id="apellido_asesor" name="apellido_asesor" style="margin-bottom: 5px;" oninput="soloLetras(this)" onkeyup="validarEmpresa(this);">
                                </div>
                                <div class="">
                                    <div class="celular-asesor" style="text-align:center; background-color:#CFE2FF; border: 1px solid #9ec5fe; margin-bottom: 5px;"> <label for="recipient-name" class="col-form-label">Celular:</label></div>
                                    <input type="text" class="form-control" id="celular-asesor" name="celular-asesor" style="margin-bottom: 5px;" oninput="soloLetras(this)">
                                </div>
                                <div class="">
                                    <div class="direccion-asesor" style="text-align:center; background-color:#CFE2FF; border: 1px solid #9ec5fe; margin-bottom: 5px;"> <label for="recipient-name" class="col-form-label">Dirección:</label></div>
                                    <input type="text" class="form-control" id="direccion-asesor" name="direccion-asesor" style="margin-bottom: 5px;" oninput="soloLetras(this)">
                                </div>
                                <div class="">
                                    <div class="sexo-asesor" style="text-align:center; background-color:#CFE2FF; border: 1px solid #9ec5fe; margin-bottom: 5px;"> <label for="recipient-name" class="col-form-label">Sexo:</label></div>
                                    <!-- <input type="text" class="form-control" id="sexo-asesor" name="sexo-asesor" style="margin-bottom: 5px;" oninput="soloLetras(this)"> -->
                                    <select class="form-select" id="sexo-asesor" name="sexo-asesor" style="margin-bottom: 5px;">
                                    <option value="masculino">Masculino</option>
                                    <option value="femenino">Femenino</option>
                                  </select>
                                </div>
                                <div class="">
                                    <div class="fecnac-asesor" style="text-align:center; background-color:#CFE2FF; border: 1px solid #9ec5fe; margin-bottom: 5px;"><label for="recipient-name" class="col-form-label">Fecha nacimiento:</label></div>
                                    <input type="date" class="form-control" id="fecnac-asesor" name="fecnac-asesor" style="margin-bottom: 5px;" oninput="soloLetras(this)" onkeyup="validarEmpresa(this);">
                                </div>
                                <div class="">
                                    <div class="empresa-asesor" style="text-align:center; background-color:#CFE2FF; border: 1px solid #9ec5fe; margin-bottom: 5px;"><label for="recipient-name" class="col-form-label">Empresa:</label></div>
                                    <select class="form-select" id="empresa-asesor" name="empresa-asesor" required>
                                        <!-- Aquí se generan dinámicamente las opciones -->
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
                                    <div class="tematica-asesor" style="text-align:center; background-color:#CFE2FF; border: 1px solid #9ec5fe; margin-bottom: 5px;"><label for="recipient-name" class="col-form-label">Tematica:</label></div>
                                    <select class="form-select" id="tematica-asesor" name="tematica-asesor" required>
                                        <!-- Aquí se generan dinámicamente las opciones -->
                                        <?php
                                        $sql_temáticas = "SELECT id_tematica, nombre_tematica FROM tematica";
                                        $result_temáticas = $conn->query($sql_temáticas);
                                        if ($result_temáticas->num_rows > 0) {
                                            while ($row = $result_temáticas->fetch_assoc()) {
                                                $idTematica = $row['id_tematica'];
                                                $nombreTematica = htmlspecialchars($row['nombre_tematica']);
                                                echo "<option value='$idTematica'>$nombreTematica</option>";
                                            }
                                        } else {
                                            echo "<option value=''>No hay temáticas disponibles</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="">
                                    <div class="usuario-asesor" style="text-align:center; background-color:#CFE2FF; border: 1px solid #9ec5fe; margin-bottom: 5px;"><label for="recipient-name" class="col-form-label">Usuario:</label></div>
                                    <input type="text" class="form-control" id="usuario-asesor" name="usuario-asesor" style="margin-bottom: 5px;" oninput="soloLetras(this)" onkeyup="validarEmpresa(this);">
                                </div>
                                <div class="">
                                    <div class="contraseña-asesor" style="text-align:center; background-color:#CFE2FF; border: 1px solid #9ec5fe; margin-bottom: 5px;"><label for="recipient-name" class="col-form-label">Contraseña:</label></div>
                                    <input type="text" class="form-control" id="contraseña-asesor" name="contraseña-asesor" style="margin-bottom: 5px;" oninput="soloLetras(this)" onkeyup="validarEmpresa(this);">
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