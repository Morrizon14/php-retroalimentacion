<?php
@include '../../modelo/conexion.php';

if (isset($_POST['click_btn_ver'])) {
    $id = $_POST['user_id'];

    $sql = "SELECT 
        colaborador.id_colaborador AS idColaborador,
        colaborador.nombre AS NombreColaborador,
        colaborador.apellido AS ApellidoColaborador,
        colaborador.celular AS Celular,
        colaborador.direccion AS Direccion,
        colaborador.sexo AS Sexo,
        colaborador.fecha_nacimiento AS FechaNacimiento,
        empresa.razonsocial AS NombreEmpresa,
        tematica.nombre_tematica AS NombreTematica,
        login.usuario AS Usuario,
        login.contraseña AS Contraseña
    FROM 
        colaborador colaborador
        INNER JOIN empresa empresa ON colaborador.id_empresa = empresa.idempresa
        INNER JOIN tematica tematica ON colaborador.id_tematica = tematica.id_tematica
        INNER JOIN login login ON colaborador.id_colaborador = login.id_login
    WHERE 
        colaborador.id_colaborador = '$id'";  // Utiliza la variable $id para filtrar por el ID dinámicamente
    $resultado = mysqli_query($conn, $sql);

    if($resultado){

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        while ($fila = mysqli_fetch_assoc($resultado)) {
?>
            <div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="">
                        <input type="hidden" id="id_colaborador" name="id_colaborador">
                            <div class="nombre_asesor" style="text-align:center; background-color:#CFE2FF; border: 1px solid #9ec5fe; margin-bottom: 5px;"><label for="nombre_asesor" class="col-form-label">Nombre del Colaborador:</label></div>
                            <div class="input-nombreEnt"; "><input style="margin-bottom: 5px" class="form-control" type="text" id="nombre_asesor" name="nombre_asesor" value="<?php echo $fila['NombreColaborador'] ?>" readonly></div>

                            <div class="apellido_asesor" style="text-align:center; background-color:#CFE2FF; border: 1px solid #9ec5fe; margin-bottom: 5px;"><label for="apellido_asesor" class="col-form-label">Apellido del Colaborador:</label></div>
                            <div class="input-nombreEnt"><input style="margin-bottom: 5px" class="form-control" type="text" id="apellido_asesor" name="apellido_asesor" value="<?php echo $fila['ApellidoColaborador'] ?>" readonly></div>

                            <div class="celular" style="text-align:center; background-color:#CFE2FF; border: 1px solid #9ec5fe; margin-bottom: 5px;"><label for="celular" class="col-form-label">Celular:</label></div>
                            <div class="input-celular"><input style="margin-bottom: 5px" class="form-control" type="text" id="celular" name="celular" value="<?php echo $fila['Celular'] ?>" readonly></div>

                            <div class="direccion" style="text-align:center; background-color:#CFE2FF; border: 1px solid #9ec5fe; margin-bottom: 5px;"><label for="direccion" class="col-form-label">Dirección:</label></div>
                            <div class="input-direccion"><input style="margin-bottom: 5px" class="form-control" type="text" id="direccion" name="direccion" value="<?php echo $fila['Direccion'] ?>" readonly></div>
                            
                            <div class="sexo_asesor" style="text-align:center; background-color:#CFE2FF; border: 1px solid #9ec5fe; margin-bottom: 5px;"><label for="sexo_asesor" class="col-form-label">Sexo del Colaborador:</label></div>
                            <div class="input-nombreEnt"><input style="margin-bottom: 5px" class="form-control" type="text" id="sexo_asesor" name="sexo_asesor" value="<?php echo $fila['Sexo'] ?>" readonly></div>

                            <div class="fecha_nacimiento" style="text-align:center; background-color:#CFE2FF; border: 1px solid #9ec5fe; margin-bottom: 5px;"><label for="fecha_nacimiento" class="col-form-label">Fecha de nacimiento del Colaborador:</label></div>
                            <div class="input-nombreEnt"><input style="margin-bottom: 5px" class="form-control" type="text" id="fecha_nacimiento" name="fecha_nacimiento" value="<?php echo $fila['FechaNacimiento'] ?>" readonly></div>

                            <div class="rucempresa" style="text-align:center; background-color:#CFE2FF; border: 1px solid #9ec5fe; margin-bottom: 5px;"><label for="rucempresa" class="col-form-label">Nombre de la Empresa:</label></div>
                            <div class="input-rucempresa"><input style="margin-bottom: 5px" class="form-control" type="text" id="rucempresa" name="rucempresa" value="<?php echo $fila['NombreEmpresa'] ?>" readonly></div>

                            <div class="tematica" style="text-align:center; background-color:#CFE2FF; border: 1px solid #9ec5fe; margin-bottom: 5px;"><label for="tematica" class="col-form-label">Tematica:</label></div>
                            <div class="input-tematica"><input style="margin-bottom: 5px" class="form-control" type="text" id="tematica" name="tematica" value="<?php echo $fila['NombreTematica'] ?>" readonly></div>

                            <div class="usuario" style="text-align:center; background-color:#CFE2FF; border: 1px solid #9ec5fe; margin-bottom: 5px;"><label for="usuario" class="col-form-label">Usuario:</label></div>
                            <div class="input-usuario"><input style="margin-bottom: 5px" class="form-control" type="text" id="usuario" name="usuario" value="<?php echo $fila['Usuario'] ?>" readonly></div>

                            <div class="contraseña" style="text-align:center; background-color:#CFE2FF; border: 1px solid #9ec5fe; margin-bottom: 5px;"><label for="contraseña" class="col-form-label">Contraseña:</label></div>
                            <div class="input-contraseña"><input style="margin-bottom: 5px" class="form-control" type="text" id="contraseña" name="contraseña" value="<?php echo $fila['Contraseña'] ?>" readonly></div>

                       </div>
                       </div>
                    </div>
                </div>
            </div>
<?php
            }
        } else {
            // Si no se encontraron registros
            echo "No se encontraron registros para el ID '$id'.";
        }
    }
    } else {
        // Si hubo un error en la consulta, mostrar el mensaje de error de MySQL
        echo "Error: " . mysqli_error($conn);
    }
?>
