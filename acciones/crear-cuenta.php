<?php
require_once __DIR__ . '/../bootstrap/init.php';
// Capturamos los datos.
$nombre            = trim($_POST['nombre'] ?? '');
$apellido          = trim($_POST['apellido'] ?? '');
$email             = trim($_POST['email'] ?? '');
$emailconfirmed    = trim($_POST['emailconfirmed'] ?? '');
$password          = trim($_POST['password'] ?? '');
$passwordconfirmed = trim($_POST['passwordconfirmed'] ?? '');

$errores = [];

// TODO: Validar...
if ($nombre === '') {
    $errores['nombre'] = 'El nombre es obligatorio.';
}
if ($apellido === '') {
    $errores['apellido'] = 'El apellido es obligatorio.';
}
if ($email === '') {
    $errores['email'] = 'El correo electrónico es obligatorio.';
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errores['email'] = 'El correo electrónico no es válido.';
}
if ($emailconfirmed === '') {
    $errores['emailconfirmed'] = 'Debes confirmar tu correo electrónico.';
} elseif ($email !== $emailconfirmed) {
    $errores['emailconfirmed'] = 'Los correos electrónicos no coinciden.';
}
if ($password === '') {
    $errores['password'] = 'La contraseña es obligatoria.';
}
if ($passwordconfirmed === '') {
    $errores['passwordconfirmed'] = 'Debes confirmar tu contraseña.';
} elseif ($password !== $passwordconfirmed) {
    $errores['passwordconfirmed'] = 'Las contraseñas no coinciden.';
}

// Validar si el email ya está registrado
if ((new Usuario())->existeEmail($email)) {
    $errores['email'] = 'El correo electrónico ya está registrado.';
}

// Si hay errores, redirigir y guardar errores y datos viejos
if (!empty($errores)) {
    $_SESSION['feedback_error'] = "Por favor, corregí los errores e intentá de nuevo.";
    $_SESSION['errores'] = $errores;
    $_SESSION['data_vieja'] = $_POST;
    header("Location: ../index.php?seccion=registrarse");
    exit;
}

try {
    (new Usuario)->crear([
        'nombre' => ucfirst(strtolower($nombre)),
        'apellido' => ucfirst(strtolower($apellido)),
        'email' => $email,
        // No olvidarnos de hashear el password.
        'password' => password_hash($password, PASSWORD_DEFAULT),
        'rol_fk' => Usuario::ROL_USUARIO, // Importante que acá hardcodeemos que es un usuario común.
    ]);

    $_SESSION['feedback_exito'] = "¡Cuenta creada con éxito!";
    header("Location: ../index.php?seccion=iniciar-sesion");
    exit;
} catch (\Throwable $th) {
    $_SESSION['feedback_error'] = "Ocurrió un error. La cuenta no pudo ser creada.";
    $_SESSION['data_vieja'] = $_POST;
    header("Location: ../index.php?seccion=registrarse");
    exit;
}