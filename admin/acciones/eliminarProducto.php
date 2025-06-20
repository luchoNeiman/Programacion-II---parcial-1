<?php
require_once __DIR__ . '/../../bootstrap/autoload.php';

session_start();

$autenticacion = new Autenticacion;
if(!$autenticacion->estaAutenticado()) {
    $_SESSION['feedback_error'] = "Para realizar esta acción es necesario primero iniciar sesión.";
    header("Location: ../index.php");
    exit;
}

$id = $_GET['id'];

$producto = (new Producto)->porId($id);

try {
    (new Producto)->eliminar($id);
    $_SESSION['feedback_exito'] = "El producto <b>" . $producto->getTitulo() . "</b> se eliminó con éxito.";
} catch (\Throwable $th) {
    // throw $th;
    $_SESSION['feedback_error'] = "Ocurrió un error inesperado al tratar de eliminar la producto. Por favor, probá de nuevo más tarde.";
}

header("Location: ../index.php?seccion=productos");