  <?php
    @include '../../controlador/controlador-login/controlador-login.php'

  ?>

  <!DOCTYPE html>
  <html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./login.css">
    <link rel="stylesheet" href="../css/components/header.css">

    <script src="https://kit.fontawesome.com/73c70fe811.js" crossorigin="anonymous"></script>
  </head>
  <body>
  <div class="contenedor">

    <?php
      @include '../components/header.php'?>

    <div class="form-container">
      
      <form action="" method="post" class="formulario" id="formulario">
          <h3 class="titulo-Formulario">INICIAR SESION</h3>
          <?php
              if(isset($error)){
                  foreach($error as $error){
                      echo '<span class="error-msg">'.$error.'</span>';
                  };
              }
          ?>
      
    <!-- Grupo: Correo Electronico -->
        <div class="formulario__grupo 1" id="grupo__correo">
          <div class="formulario__grupo-input">
            <input type="text" class="formulario__input" name="email" id="correo" placeholder=" " value="<?php if(isset($email)) echo $email?>">
            <label for="email" class="formulario__label">Correo Electrónico</label>
            <i class="formulario__validacion-estado fas fa-times-circle"></i>
            <i class="fa-solid fa-user"></i>
      <!--                      <i class="fa-regular fa-envelope fa-xl iconos"></i>
      -->	</div>
                  
          <p class="formulario__input-error">El correo solo puede contener letras, numeros, puntos, guiones y guion bajo. <b><i>ejemplo@correo.com</i></b></p>
        </div>
          
    <!-- Grupo: Contraseña -->
        <div class="formulario__grupo 2" id="grupo__password">
            <div class="formulario__grupo-input">
              <input type="password" class="formulario__input" name="password" id="password" placeholder=" ">
              <label for="password" class="formulario__label">Contraseña</label>
              <i class="formulario__validacion-estado fas fa-times-circle circulo-error"></i>
              <i class="fa-solid fa-key"></i>

              <!-- <i class="fa-regular fa-envelope fa-xl iconos"></i> -->
                                   
              <p class="formulario__input-error">La contraseña tiene que ser de 3 a 12 dígitos.</p>
            </div>
            <div class="formulario__grupo formulario__grupo-btn-enviar">
              <button type="submit" class="formulario__btn" name="submit" id="enviar" >Ingresar</button>
            </div>
        </div>
      </form>
    </div>      
   </div>
    <?php @include '../components/footer.php'?>   
    <script src="./login.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   </body>
   </html>