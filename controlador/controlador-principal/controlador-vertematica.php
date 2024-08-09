<?php
@include '../../modelo/conexion.php';

if (isset($_POST['click_btn_ver'])) {
  $id = $_POST['user_id'];
    $sql = "SELECT  tematica.id_tematica as idTematica,
                                        tematica.nombre_tematica as nombreTematica,
                                        campaña.nombre_campaña as nombreCampaña
                                FROM tematica INNER JOIN campaña ON
                                        tematica.id_campaña = campaña.id_campaña where id_tematica = '$id'";
    $resultado = mysqli_query($conn, $sql);

    if (mysqli_num_rows($resultado) > 0) {

        while ($fila = mysqli_fetch_array($resultado)) {
?>
            <div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="">
                                    <input type="hidden" id="id_tematica" name="id_tematica">
                                    <div class="nombre-tematica" style="text-align:center; background-color:#CFE2FF; border: 1px solid #9ec5fe; margin-bottom: 5px;" ><label for="tematica" class="col-form-label">Tematica:</label></div>
                                    <div class="input-nombreEnt" ;"><input style="margin-bottom: 5px" class="form-control" type="text" id="tematica" name="tematica" value="<?php echo $fila['nombreTematica'] ?>" readonly>
                                    </div>
                                    </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="nombre-campaña" style="text-align:center; background-color:#CFE2FF; border: 1px solid #9ec5fe; margin-bottom: 5px;" ><label for="campaña" class="col-form-label">Campaña:</label></div>
                                    <div class="input-campaña"><input style="margin-bottom: 5px"  class="form-control"  type="text" id="campaña" name="campaña" value="<?php echo $fila['nombreCampaña'] ?>" readonly></div>
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