<!DOCTYPE html>
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
<?php require 'header.php'; ?>
<h3 class="text-center">

<?php
 if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repeat_password = $_POST['repeat_password'];
    $gender = $_POST['gender'];
    $birthdate = $_POST['birthdate'];
    $city = $_POST['city'];
    $country = $_POST['country'];
    $style = $_POST['style'];
    $photo = $_FILES['photo'];
    if($password != $repeat_password) {
        echo "Las contraseñas no coinciden";
    } else if($photo['type'] != 'image/jpeg' && $photo['type'] != 'image/png') {
        echo "El formato de la imagen no es válido, solo se permiten JPG o PNG";
    } else if($photo['size'] > 10485760) {
        echo "El tamaño de la imagen debe ser menor a 10MB";
    } else {
        if(registrarUsuario($nombre, $password, $email, $gender, $birthdate, $city, $country, $style, $photo, $id_style)) {
            $id = obtenerIdUsuarioPorEmail($email, md5($password));
            if($id != null) {
               iniciarSesion($id);
               header('Location: index.php');
            } else {
                echo "Error al iniciar sesión";
            }
        } else {
            echo "Error al registrar el usuario";
        }
    }
}
?>
</h3>

<button type="submit" class="btn btn-primary">Volver</button>

<?php require 'footer.php'; ?>
</html>