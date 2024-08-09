<div class="button-add-student">
    <button type="button" class="btn btn-success me-5" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo"><i class="fas fa-building" style='color:#fff;'></i> Registrar <i class="fa-solid fa-square-plus"></i></button>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Nueva tematica</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <?php
                $sql_campaña = "SELECT id_campaña, nombre_campaña FROM campaña";$result_campaña = $conn->query($sql_campaña);
                $conn->close();
                ?>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <form onsubmit="validarCampos(event)" method="POST" action="../../../controlador/controlador-principal/controlador-agregartematica.php" enctype="multipart/form-data">
                                <div class="">
                                    <div class="nombre-tematica" style="text-align:center; background-color:#CFE2FF; border: 1px solid #9ec5fe; margin-bottom: 5px;"><label for="recipient-name" class="col-form-label">Tematica:</label></div>
                                    <input type="text" class="form-control" id="nombre-tematica" name="nombre-tematica" style="margin-bottom: 5px;" oninput="soloLetras(this)" onkeyup="validarEmpresa(this);">
                                </div>
                                <div class="">
                                    <div class="nombre-tematica" style="text-align:center; background-color:#CFE2FF; border: 1px solid #9ec5fe; margin-bottom: 5px;"> <label for="recipient-name" class="col-form-label">Campaña:</label></div>
                                    <select class="form-select" id="id_campaña" name="nombre-campaña" style="margin-bottom: 5px;">
                                        <?php
                                        // Verificar si se encontraron resultados
                                        if ($result_campaña->num_rows > 0) {
                                            while ($row = $result_campaña->fetch_assoc()) {
                                                echo "<option value='" . htmlspecialchars($row['id_campaña']) . "'>" . htmlspecialchars($row['nombre_campaña']) . "</option>";
                                            }
                                        } else {
                                            echo "<option value=''>No hay campañas disponibles</option>";
                                        }
                                        ?>
                                    </select>
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