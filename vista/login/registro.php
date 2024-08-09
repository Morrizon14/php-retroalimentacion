<?php
    @include '../../controlador/controlador-login/controlador-registro.php'
  ?>

  <!DOCTYPE html>
  <html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear usuario</title>
    <link rel="stylesheet" href="./registro.css">
    <link rel="stylesheet" href="../css/components/header.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <script src="https://kit.fontawesome.com/73c70fe811.js" crossorigin="anonymous"></script>
  </head>
  <body>
  <?php @include '../components/header.php'?>

  <div class="contenedor">
        
        <div class="form-container">
            <h3 class="titulo-Formulario">Crear Cuenta de Asesor</h3>
            <?php
                if(isset($error)){
                    foreach($error as $error){
                        echo '<span class="error-msg">'.$error.'</span>';
                    };
                }
            ?>
    
            <form action="" method="post" class="formulario" id="formulario">

                 <!-- Grupo: Genero -->
           <div class="formulario__grupo 5" id="grupo__genero_cliente">
             <label for="genero_cliente" class="label_select">Genero</label>
             <div class="formulario__grupo-input">
                        <select name="genero_cliente" class="formulario__input" name="genero_cliente" id="genero_cliente">
                            <option value="masculino">masculino</option>
                            <option value="femenino">femenino</option>
                        </select>
             </div>
           </div>
           <!-- Grupo: dni-cliente -->
<!--            <div class="formulario__grupo 2" id="grupo__dni_cliente">
             <div class="formulario__grupo-input">
               <input type="text" class="formulario__input" name="dni_cliente" id="dni_cliente" placeholder=" " value="<?php if(isset($dni_cliente)) echo $dni_cliente?>">
                         <label for="dni_cliente" class="formulario__label">DNI</label>
               <i class="formulario__validacion-estado fas fa-times-circle"></i>
             </div>
             <p class="formulario__input-error">El Dni tiene que ser de 7 a 9 dígitos.</p>
           </div> -->
           <!-- Grupo: Nombre -->
           <div class="formulario__grupo 3" id="grupo__nombre_cliente">
             <div class="formulario__grupo-input">
               <input type="text" class="formulario__input" name="nombre_cliente" id="nombre_cliente" placeholder=" " value="<?php if(isset($nombre_cliente)) echo $nombre_cliente?>">
                         <label for="nombre_cliente" class="formulario__label">Nombre</label>
               <i class="formulario__validacion-estado fas fa-times-circle"></i>
             </div>
             <p class="formulario__input-error">El nombre tiene que ser de 3 a 40 dígitos y solo puede contener Letras, espacios y puede llevar acentos.</p>
           </div>
           <!-- Grupo: Apellido -->
           <div class="formulario__grupo 4" id="grupo__apellido_cliente">
             
             <div class="formulario__grupo-input">
               <input type="text" class="formulario__input" name="apellido_cliente" id="apellido_cliente" placeholder=" " value="<?php if(isset($apellido_cliente)) echo $apellido_cliente?>">
                         <label for="apellido_cliente" class="formulario__label">Apellido</label>
               <i class="formulario__validacion-estado fas fa-times-circle"></i>
             </div>
             <p class="formulario__input-error">El apellido tiene que ser de 3 a 50 dígitos y solo puede contener Letras, espacios y puede llevar acentos.</p>
           </div>
           
           <!-- Grupo: Direccion -->
           <div class="formulario__grupo 6" id="grupo__direccion_cliente">
             <div class="formulario__grupo-input">
               <input type="text" class="formulario__input" name="direccion_cliente" id="direccion_cliente" placeholder=" " value="<?php if(isset($direccion_cliente)) echo $direccion_cliente?>">
                         <label for="direccion_cliente" class="formulario__label">Direccion</label>
               <i class="formulario__validacion-estado fas fa-times-circle"></i>
             </div>
             <p class="formulario__input-error">La direccion es incorrecta</p>
           </div>
           <!-- Grupo: Teléfono -->
           <div class="formulario__grupo 7" id="grupo__telefono_cliente">
             <div class="formulario__grupo-input">
               <input type="text" class="formulario__input" name="telefono_cliente" id="telefono_cliente" placeholder=" " value="<?php if(isset($telefono_cliente)) echo $telefono_cliente?>">
                         <label for="telefono_cliente" class="formulario__label">Teléfono</label>
               <i class="formulario__validacion-estado fas fa-times-circle"></i>
             </div>
             <p class="formulario__input-error">El telefono solo puede contener numeros y son de 7 a 14 dígitos.</p>
           </div>
           <!-- Grupo: Correo Electronico -->
           <div class="formulario__grupo 8" id="grupo__correo">
             <div class="formulario__grupo-input">
               <input type="text" class="formulario__input" name="email" id="correo" placeholder=" " value="<?php if(isset($email)) echo $email?>">
                         <label for="email" class="formulario__label">Correo Electrónico</label>
               <i class="formulario__validacion-estado fas fa-times-circle"></i>
             </div>
             <p class="formulario__input-error">El correo solo puede contener letras, numeros, puntos, guiones y guion bajo. <b><i>ejemplo@correo.com</i></b></p>
           </div>
           <!-- Grupo: Contraseña -->
           <div class="formulario__grupo 9" id="grupo__password">
             <div class="formulario__grupo-input">
               <input type="password" class="formulario__input" name="password" id="password" placeholder=" ">
                         <label for="password" class="formulario__label">Contraseña</label>
               <i class="formulario__validacion-estado fas fa-times-circle"></i>
             </div>
             <p class="formulario__input-error">La contraseña tiene que ser de 3 a 12 dígitos.</p>
           </div>
           <!-- Grupo: Contraseña 2 -->
           <div class="formulario__grupo 10" id="grupo__password2">
             <div class="formulario__grupo-input">
               <input type="password" class="formulario__input" name="cpassword" id="cpassword" placeholder=" ">
                         <label for="cpassword" class="formulario__label">Repetir Contraseña</label>
               <i class="formulario__validacion-estado fas fa-times-circle"></i>
             </div>
             <p class="formulario__input-error">Ambas contraseñas deben ser iguales.</p>
           </div>
           
           <!-- <div class="formulario__grupo" id="grupo__"></div> -->
           <!-- Grupo: Terminos y Condiciones -->
           <!-- <div class="formulario__grupo grupo__terminos 12" id="grupo__terminos">
             <label class="formulario__label">
               <input class="formulario__checkbox" type="checkbox" name="terminos" id="terminos">
               <span class="terminos">Acepto los Terminos y Condiciones </span>
             </label>
           </div> -->
           <div class="formulario__mensaje" id="formulario__mensaje">
             <p><i class="fas fa-exclamation-triangle"></i> <!-- <b>Error:</b> --> Rellena todo el formulario correctamente.</p>
           </div>
       
           <div class="formulario__grupo formulario__grupo-btn-enviar 13">
            <button type="submit" class="formulario__btn" name="submit" id="enviar" >Crear Cuenta</button>
            <p class="formulario__mensaje-exito" id="formulario__mensaje-exito">Formulario enviado exitosamente!</p>
          </div>
       
               <!-- <input type="submit" name="submit" value="Crear cuenta" class="form-btn"> -->
           
        </form>
            <div class="tienes-cuenta">
                <p>Ya tienes una cuenta? <a href="login.php">Inicia Sesion</a></p>
            </div>
        </div>
    </div>
   <?php
      @include '../components/footer.php'
    ?>
    <script src="./registro.js"></script>
   </body>
   </html>