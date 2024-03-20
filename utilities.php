<?php
$utils = parse_ini_file('data.ini');

function conectarDB() {
    global $utils;
    $conn = new mysqli($utils['host'], $utils['user'], $utils['password'], $utils['db']);
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }
    return $conn;
}

function iniciarSesion($id_user) {
    $_SESSION['id_user'] = $id_user;
    // Establecer cookie de sesión (opcional)
    setcookie('id_user', $id_user, time() + (86400 * 30), "/"); // cookie válida por 30 días
}

function estaLogueado() {
    return isset($_SESSION['id_user']);
}

function obtenerIdUsuario() {
    return $_SESSION['id_user'];
}

function cerrarSesion() {
    session_unset();
    session_destroy();
    setcookie('id_user', '', time() - 3600, "/");
}
?>