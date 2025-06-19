<?php
require_once __DIR__ . '/../../bootstrap/autoload.php';
session_start();

// Capturamos los datos.
$email      = $_POST['email'];
$password   = $_POST['password'];

$autenticacion = new Autenticacion;

if(!$autenticacion->intentarIngresar($email, $password)) {
    $_SESSION['feedback_error'] = "Las credenciales ingresadas no coinciden con nuestros registros.";
    $_SESSION['data_vieja'] = $_POST;
    header('Location: ../index.php');
    exit;
}

$_SESSION['feedback_exito'] = "Sesión iniciada con éxito. ¡Hola de nuevo!";
header('Location: ../index.php?seccion=dashboard');
exit;