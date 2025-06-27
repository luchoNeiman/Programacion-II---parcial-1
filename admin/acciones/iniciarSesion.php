<?php
require_once __DIR__ . '/../../bootstrap/init.php';


// Capturamos los datos.
$email      = $_POST['email'];
$password   = $_POST['password'];

$autenticacion = new Autenticacion;

if(!$autenticacion->intentarIngresar($email, $password)) {
    $_SESSION['feedback_error'] = "❌Las credenciales ingresadas no coinciden con nuestros registros.";
    $_SESSION['data_vieja'] = $_POST;
    header('Location: ../index.php');
    exit;
}

$_SESSION['feedback_exito'] = "✅ Iniciaste sesión correctamente.";
header('Location: ../index.php?seccion=dashboard');
exit;