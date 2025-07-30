<?php
require_once __DIR__ . '/../bootstrap/init.php';

// Cerramos la sesión.
(new Autenticacion)->cerrarSesion();

$_SESSION['feedback_exito'] = "Cerraste tu sesión con éxito. ¡Te esperamos pronto de vuelta!";
header("Location: ../index.php?seccion=iniciar-sesion");
exit;