<?php
@include '../../modelo/conexion.php';

if (isset($_POST['click_btn_ver'])) {
  $id = $_POST['user_id'];
    $sql = "SELECT  
                                    campaña.id_campaña as id_campaña,
                                    campaña.nombre_campaña as nombreCampaña, 
                                    empresa.razonsocial as nombreEmpresa 
                                FROM 
                                    campaña 
                                INNER JOIN 
                                    empresa ON campaña.id_empresa = empresa.idempresa 
                             where id_campaña = '$id'";
    $resultado = mysqli_query($conn, $sql);

    if (mysqli_num_rows($resultado) > 0) {

        while ($fila = mysqli_fetch_array($resultado)) {
?>
            <div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="">
                                    <input type="hidden" id="id_campaña" name="id_campaña">
                                    <div class="nombre-campaña" style="text-align:center; background-color:#CFE2FF; border: 1px solid #9ec5fe; margin-bottom: 5px;" ><label for="campaña" class="col-form-label">Campaña:</label></div>
                                    <div class="input-nombreEnt" ;"><input style="margin-bottom: 5px" class="form-control" type="text" id="campaña" name="campaña" value="<?php echo $fila['nombreCampaña'] ?>" readonly>
                                    </div>
                                    </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="nombre-empresa" style="text-align:center; background-color:#CFE2FF; border: 1px solid #9ec5fe; margin-bottom: 5px;" ><label for="empresa" class="col-form-label">Empresa:</label></div>
                                    <div class="input-empresa"><input style="margin-bottom: 5px"  class="form-control"  type="text" id="empresa" name="empresa" value="<?php echo $fila['nombreEmpresa'] ?>" readonly></div>
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