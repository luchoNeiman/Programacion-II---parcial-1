<?php
require_once __DIR__ . '/../../bootstrap/autoload.php';
session_start();

// Cerramos la sesión.
(new Autenticacion)->cerrarSesion();

$_SESSION['feedback_exito'] = "Sesión cerrada con éxito. ¡Te esperamos pronto de vuelta!";
header("Location: ../index.php");
exit;