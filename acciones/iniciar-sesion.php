<?php
/*
La lógica de la autenticación va a quedar encapsulada dentro de una clase "Autenticacion".
*/
require_once __DIR__ . '/../bootstrap/init.php';

// Capturamos los datos.
$email      = $_POST['email'];
$password   = $_POST['password'];

// TODO: Validar...

$autenticacion = new Autenticacion;

if(!$autenticacion->intentarIngresar($email, $password)) {
    $_SESSION['feedback_error'] = "Las credenciales ingresadas no coinciden con nuestros registros.";
    $_SESSION['data_vieja'] = $_POST;
    header('Location: ../index.php?seccion=iniciar-sesion');
    exit;
}

$_SESSION['feedback_exito'] = "Sesión iniciada con éxito. ¡Hola de nuevo!";
header('Location: ../index.php?seccion=home');
exit;