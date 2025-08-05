<?php
/*
La lógica de la autenticación va a quedar encapsulada dentro de una clase "Autenticacion".
*/
require_once __DIR__ . '/../bootstrap/init.php';

// Capturamos los datos.
$email      = trim($_POST['email'] ?? '');
$password   = trim($_POST['password'] ?? '');

$errores = [];

// TODO: Validar...
// Validaciones
if ($email === '') {
    $errores['email'] = 'El correo electrónico es obligatorio.';
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errores['email'] = 'El correo electrónico no es válido.';
}

if ($password === '') {
    $errores['password'] = 'La contraseña es obligatoria.';
}

// Si hay errores, redirigimos y guardamos los errores y los datos viejos en sesión
if (!empty($errores)) {
    $_SESSION['feedback_error'] = "Por favor, corregí los errores e intentá de nuevo.";
    $_SESSION['errores'] = $errores;
    $_SESSION['data_vieja'] = $_POST;
    header('Location: ../index.php?seccion=iniciar-sesion');
    exit;
}

$autenticacion = new Autenticacion;

if (!$autenticacion->intentarIngresar($email, $password)) {
    $_SESSION['feedback_error'] = "Las credenciales ingresadas no coinciden con nuestros registros.";
    $_SESSION['data_vieja'] = $_POST;
    header('Location: ../index.php?seccion=iniciar-sesion');
    exit;
}

$_SESSION['feedback_exito'] = "Sesión iniciada con éxito. ¡Hola de nuevo!";
header('Location: ../index.php?seccion=home');
exit;
