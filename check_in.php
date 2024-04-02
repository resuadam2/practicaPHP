<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Práctica PHP</title>
    <meta name="description" content="Práctica PHP">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">  
    <?php require 'utilities.php'; ?>
</head>
  <body>
    <?php require 'header.php'; ?>

    <div class="container text-center">
        <div class="row"> 
            <div class="col-md-12">
                <h4>Registro de usuario</h4>
                <p>Por favor, complete el siguiente formulario para registrarse en el sitio.</p>
            </div>
        </div>
        <form action="new_check_in.php" method="post">
          <div class="row">
            <div class="col-md-6">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label">Correo electrónico</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            </div>
            <div class="row">
            <div class="col-md-6">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="col-md-6">
              <label for="repeat_password" class="form-label">Repetir contraseña</label>
              <input type="password" class="form-control" id="repeat_password" name="repeat_password" required>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <label for="gender" class="form-label">Género</label>
              <select class="form-select" id="gender" name="gender" required>
                <option value="">Seleccione un género</option>

                <!-- Esto está fallando, hay que ver como recorrer la row para usar el id como value y el 
                nombre del país como texto
              
              -->


                <?php foreach (generos_disponibles() as $key => $value): ?>
                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-md-6">
              <label for="birthdate" class="form-label">Fecha de nacimiento</label>
              <input type="date" class="form-control" id="birthdate" name="birthdate" required>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <label for="city" class="form-label">Ciudad</label>
              <input type="text" class="form-control" id="city" name="city" required>
            </div>
            <div class="col-md-6">
              <label for="country" class="form-label">País</label>
              <select class="form-select" id="country" name="country" required>
                <option value="">Seleccione un país</option>
                <?php $paises = paises_disponibles(); ?>
                <?php while ($pais = $paises->fetch_assoc()): ?>
                    <option value="<?php echo $pais['id']; ?>"><?php echo $pais['name']; ?></option>
                <?php endwhile; ?>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <label for="style" class="form-label">Estilo de música favorito</label>
              <select class="form-select" id="style" name="style" required>
                <option value="">Seleccione un estilo</option>
                <?php $estilos = estilos_disponibles(); ?>
                <?php while ($estilo = $estilos->fetch_assoc()): ?>
                    <option value="<?php echo $estilo['id']; ?>"><?php echo $estilo['name']; ?></option>
                <?php endwhile; ?>
              </select>
            </div>
            <div class="col-md-6">
              <label for="photo" class="form-label">Foto de perfil</label>
              <input type="file" class="form-control" id="photo" name="photo" required>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-md-5">
            </div>
            <div class="col-md-2">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="terms" required>
                <label class="form-check-label" for="terms">
                  Acepto los términos y condiciones
                </label>
              </div>
            </div>
            <div class="col-md-5">
            </div>
          </div>
          <br>
            <button type="submit" class="btn btn-primary">Registrarse</button>
            <button type="reset" class="btn btn-secondary">Limpiar</button>
        </form>
        
    </div>

    <?php require 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>