<?php
require_once __DIR__ . '/../bootstrap/init.php';

$email = $_POST['email'];
$password = $_POST['password'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];

// TODO: Validar...

try {
    (new Usuario)->crear([
        'nombre' => $nombre,
        'apellido' => $apellido,
        'email' => $email,
        // No olvidarnos de hashear el password.
        'password' => password_hash($password, PASSWORD_DEFAULT),
        'rol_fk' => Usuario::ROL_USUARIO, // Importante que acá hardcodeemos que es un usuario común.
    ]);

    // TODO: Completar el autenticar.
    // (new Autenticacion)->autenticar($usuario);

    $_SESSION['feedback_exito'] = "¡Cuenta creada con éxito!";
    header("Location: ../index.php?seccion=home");
    exit;
} catch (\Throwable $th) {
    $_SESSION['feedback_error'] = "Ocurrió un error. La cuenta no pudo ser creada.";
    $_SESSION['data_vieja'] = $_POST;
    header("Location: ../index.php?seccion=registrarse");
    exit;
}