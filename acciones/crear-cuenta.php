<?php
require_once __DIR__ . '/../bootstrap/init.php';

$email = $_POST['email'];
$password = $_POST['password'];
// $rol_fk = $_POST['rol_fk'];

// TODO: Validar...

try {
    (new Usuario)->crear([
        'email' => $email,
        // No olvidarnos de hashear el password.
        'password' => password_hash($password, PASSWORD_DEFAULT),
        'rol_fk' => Usuario::ROL_USUARIO, // Importante que acá hardcodeemos que es un usuario común.
        // 'rol_fk' => $rol_fk,
    ]);

    // TODO: Completar el autenticar.
    // (new Autenticacion)->autenticar($usuario);

    $_SESSION['feedback_exito'] = "¡Cuenta creada con éxito!";
    header("Location: ../index.php?seccion=iniciar-sesion");
    exit;
} catch (\Throwable $th) {
    $_SESSION['feedback_error'] = "Ocurrió un error. La cuenta no pudo ser creada.";
    $_SESSION['data_vieja'] = $_POST;
    header("Location: ../index.php?seccion=registrarse");
    exit;
}