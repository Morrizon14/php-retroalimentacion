<div class="button-add-student">
    <button type="button" class="btn btn-success me-5" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo"><i class="fas fa-building" style='color:#fff;'></i> Registrar <i class="fa-solid fa-square-plus"></i></button>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Nuevo Empresa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <?php
                    $sql_empresa = "SELECT estadoempresa FROM empresa";
                    $result_empresa = $conn->query($sql_empresa);
                    $conn->close();?>
                    
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <form onsubmit="validarCampos(event)" method="POST" action="../../../controlador/controlador-principal/controlador-agregarempresa.php" enctype="multipart/form-data">
                                <div class="">
                                    <div class="razonsocial-empresa" style="text-align:center; background-color:#CFE2FF; border: 1px solid #9ec5fe; margin-bottom: 5px;"><label for="recipient-name" class="col-form-label">Razon Social:</label></div>
                                    <input type="text" class="form-control" id="razon_social" name="razon_social" style="margin-bottom: 5px;" oninput="soloLetras(this)" onkeyup="validarEmpresa(this);">
                                </div>
                                <div class="">
                                    <div class="rucempresa-empresa" style="text-align:center; background-color:#CFE2FF; border: 1px solid #9ec5fe; margin-bottom: 5px;"> <label for="recipient-name" class="col-form-label">RUC EMPRESA:</label></div>
                                    <input type="text" class="form-control" id="ruc_empresa" name="ruc_empresa" style="margin-bottom: 5px;" oninput="soloLetras(this)">
                                </div>
                                <div class="">
                                    <div class="direccion-empresa" style="text-align:center; background-color:#CFE2FF; border: 1px solid #9ec5fe; margin-bottom: 5px;"> <label for="recipient-name" class="col-form-label">DIRECCIÓN:</label></div>
                                    <input type="text" class="form-control" id="'direccion-empresa" name="direccion-empresa" style="margin-bottom: 5px;" oninput="soloLetras(this)">
                                </div>
                                <div class="">
                                    <div class="ubicacion-empresa" style="text-align:center; background-color:#CFE2FF; border: 1px solid #9ec5fe; margin-bottom: 5px;"> <label for="recipient-name" class="col-form-label">UBICACIÓN:</label></div>
                                    <input type="text" class="form-control" id="ubicacion" name="ubicacion" style="margin-bottom: 5px;" oninput="soloLetras(this)">
                                </div>
                                <div class="">
                                    <div class="celular-empresa" style="text-align:center; background-color:#CFE2FF; border: 1px solid #9ec5fe; margin-bottom: 5px;"> <label for="recipient-name" class="col-form-label">CELULAR:</label></div>
                                    <input type="text" class="form-control" id="celular-empresa" name="celular-empresa" style="margin-bottom: 5px;" oninput="soloLetras(this)">
                                </div>
                                <div class="">
                                    <div class="estado-empresa" style="text-align:center; background-color:#CFE2FF; border: 1px solid #9ec5fe; margin-bottom: 5px;"> <label for="recipient-name" class="col-form-label">ESTADO:</label></div>
                                    <select class="form-select" id="estado-empresa" name="estado-empresa" style="margin-bottom: 5px;" required>
                                        <option value="ACTIVO">ACTIVO</option>
                                        <option value="INACTIVO">INACTIVO</option>
                                    </select>
                                </div>
                                <div class="">
                                    <div class="fecharegistro-empresa" style="text-align:center; background-color:#CFE2FF; border: 1px solid #9ec5fe; margin-bottom: 5px;"> <label for="recipient-name" class="col-form-label">FECHA DE REGISTRO:</label></div>
                                    <input type="text" class="form-control" id="fecha_registro" name="fecha_registro" style="margin-bottom: 5px;" oninput="soloLetras(this)">
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