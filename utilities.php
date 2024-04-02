<?php
$utils = parse_ini_file('data.ini');

/**
 * Función para conectar a la base de datos
 */
function conectarDB() {
    global $utils;
    $conn = new mysqli($utils['host'], $utils['user'], $utils['password'], $utils['db']);
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }
    return $conn;
}

/* Esta función devuelve todos los paises disponibles en la base de datos
    * @return resultado de la query SELECT * FROM countries
    */
function paises_disponibles() {
    global $utils;
    $conn = conectarDB();
    $sql = "SELECT * FROM countries";
    $result = $conn->query($sql);
    $conn->close();
    return $result;
}

/*
    * Esta función devuelve todos los estilos disponibles en la base de datos
    * @return resultado de la query SELECT * FROM styles
    */
function estilos_disponibles() {
    global $utils;
    $conn = conectarDB();
    $sql = "SELECT * FROM styles";
    $result = $conn->query($sql);
    $conn->close();
    return $result;
}

/**
 * Función que devuelve un array con los géneros disponibles que son los siguientes pares:
 * 1 => "Hombre",
 * 2 => "Mujer",
 * 3 => "No binario",
 * 4 => "Prefiero no decirlo"
 */
function generos_disponibles() {
    return array(
        1 => "Hombre",
        2 => "Mujer",
        3 => "No binario",
        4 => "Prefiero no decirlo"
    );
}

/**
 * Función para registrar un usuario en la base de datos
 * @param name Nombre del usuario
 * @param pass Contraseña del usuario
 * @param email Correo electrónico del usuario
 * @param gender Género del usuario
 * @param birthdate Fecha de nacimiento del usuario
 * @param city Ciudad del usuario
 * @param id_country ID del país del usuario
 * @param photo Foto de perfil del usuario
 * @param id_style ID del estilo de música favorito del usuario
 */
function registrarUsuario($name, $pass, $email, $gender, $birthdate, $city, $id_country, $photo, $id_style) {
    global $utils;
    $conn = conectarDB();
    $next_id = $conn->insert_id;
    $photo_path = "profiles/$next_id/"; // Ruta de la foto de perfil
    $pass = md5($pass); // Encriptar la contraseña
    $sql = "INSERT INTO users (name, pass, email, gender, birthdate, city, id_country, photo, id_style) 
     VALUES ('$name', '$pass', '$email', $gender, '$birthdate', '$city', $id_country, '$photo_path', $id_style)";
    if ($conn->query($sql) === TRUE) {
        crearCarpetaUsuario($conn->insert_id, $photo); // Crear carpeta para el usuario
        $conn->close();
        return true;
    } else {
        $conn->close();
        return false;
    }
}

/**
 * Función para crear la subcarpeta para un nuevo usuario (comprobando antes que no exista ya)
 * La carpeta se debe crear dentro de /profiles/ con el nombre del ID del usuario
 *  y dentro de ella se debe guardar la foto de perfil
 * @param id_user ID del usuario
 * @param photo Foto de perfil del usuario
 */
function crearCarpetaUsuario($id_user, $photo) {
    $target_dir = "profiles/$id_user/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    $target_file = $target_dir . basename($photo);
    move_uploaded_file($photo, $target_file);
}

/**
 * Función para obtener el id del usuario a partir de su correo electrónico
 * siempre y cuándo la contraseña sea correcta (de lo contrario devuelve null)
 * @param email Correo electrónico del usuario
 * @param pass Contraseña del usuario
 */
function obtenerIdUsuarioPorEmail($email, $pass) {
    global $utils;
    $conn = conectarDB();
    $sql = "SELECT id FROM users WHERE email = '$email' AND pass = '$pass'";
    $result = $conn->query($sql);
    $conn->close();
    if ($result->num_rows > 0) {
        return $result->fetch_assoc()['id'];
    } else {
        return null;
    }
}

/*
* Función para iniciar la sesión del usuario y setear la cookie de sesión
*/
function iniciarSesion($id_user) {
    $_SESSION['id_user'] = $id_user;
    // Establecer cookie de sesión (opcional)
    setcookie('id_user', $id_user, time() + (86400 * 30), "/"); // cookie válida por 30 días
}


/**
 * Función para verificar si el usuario está logueado
 */
function estaLogueado() {
    return isset($_SESSION['id_user']);
}

/**
 * Función para obtener el ID del usuario logueado
 */
function obtenerIdUsuario() {
    return $_SESSION['id_user'];
}

/**
 * Función para cerrar la sesión del usuario
 */
function cerrarSesion() {
    session_unset();
    session_destroy();
    setcookie('id_user', '', time() - 3600, "/");
}
?>