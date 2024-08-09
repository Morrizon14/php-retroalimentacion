<?php
@include '../../modelo/conexion.php';

if (isset($_POST['click_btn_ver'])) {
  $id = $_POST['user_id'];
    $sql = "SELECT razonsocial, rucempresa, direccion, ubicacion, celular, estadoempresa, log_registroempresa FROM empresa WHERE idempresa = '$id'";
    $resultado = mysqli_query($conn, $sql);

    if (mysqli_num_rows($resultado) > 0) {

        while ($fila = mysqli_fetch_array($resultado)) {
?>
            <div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="">
                                    <input type="hidden" id="idempresa" name="idempresa">
                                    <div class="razonsocial" style="text-align:center; background-color:#CFE2FF; border: 1px solid #9ec5fe; margin-bottom: 5px;" ><label for="razonsocial" class="col-form-label">Razón Social:</label></div>
                                    <div class="input-nombreEnt" ;"><input style="margin-bottom: 5px" class="form-control" type="text" id="razonsocial" name="razonsocial" value="<?php echo $fila['razonsocial'] ?>" readonly>
                                    </div>
                                    </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="rucempresa" style="text-align:center; background-color:#CFE2FF; border: 1px solid #9ec5fe; margin-bottom: 5px;" ><label for="rucempresa" class="col-form-label">Empresa:</label></div>
                                    <div class="input-rucempresa"><input style="margin-bottom: 5px"  class="form-control"  type="text" id="rucempresa" name="rucempresa" value="<?php echo $fila['rucempresa'] ?>" readonly></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="direccion" style="text-align:center; background-color:#CFE2FF; border: 1px solid #9ec5fe; margin-bottom: 5px;" ><label for="direccion" class="col-form-label">Dirección:</label></div>
                                    <div class="input-direccion"><input style="margin-bottom: 5px"  class="form-control"  type="text" id="direccion" name="direccion" value="<?php echo $fila['direccion'] ?>" readonly></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="ubicacion" style="text-align:center; background-color:#CFE2FF; border: 1px solid #9ec5fe; margin-bottom: 5px;" ><label for="ubicacion" class="col-form-label">Ubicación:</label></div>
                                    <div class="input-ubicacion"><input style="margin-bottom: 5px"  class="form-control"  type="text" id="ubicacion" name="ubicacion" value="<?php echo $fila['ubicacion'] ?>" readonly></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="celular" style="text-align:center; background-color:#CFE2FF; border: 1px solid #9ec5fe; margin-bottom: 5px;" ><label for="celular" class="col-form-label">Ubicación:</label></div>
                                    <div class="input-celular"><input style="margin-bottom: 5px"  class="form-control"  type="text" id="celular" name="celular" value="<?php echo $fila['celular'] ?>" readonly></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="estadoempresa" style="text-align:center; background-color:#CFE2FF; border: 1px solid #9ec5fe; margin-bottom: 5px;" ><label for="estadoempresa" class="col-form-label">Ubicación:</label></div>
                                    <div class="input-estadoempresa"><input style="margin-bottom: 5px"  class="form-control"  type="text" id="estadoempresa" name="estadoempresa" value="<?php echo $fila['estadoempresa'] ?>" readonly></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="log_registroempresa" style="text-align:center; background-color:#CFE2FF; border: 1px solid #9ec5fe; margin-bottom: 5px;" ><label for="log_registroempresa" class="col-form-label">Ubicación:</label></div>
                                    <div class="input-log_registroempresa"><input style="margin-bottom: 5px"  class="form-control"  type="text" id="log_registroempresa" name="log_registroempresa" value="<?php echo $fila['log_registroempresa'] ?>" readonly></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

<?php

        }
        
    }
}
?>