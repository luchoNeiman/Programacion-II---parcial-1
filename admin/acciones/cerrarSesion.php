<?php
require_once __DIR__ . '/../../bootstrap/init.php';


// Cerramos la sesión.
(new Autenticacion)->cerrarSesion();

$_SESSION['feedback_exito'] = "✅ Cerraste sesión con éxito.";
header("Location: ../index.php");
exit;