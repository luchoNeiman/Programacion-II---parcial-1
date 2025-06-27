<?php
require_once __DIR__ . '/../../bootstrap/init.php';


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
    $imagenPath = __DIR__ . '/../../imgs/' . $producto->getImagen();

  if($producto->getImagen() !== null && file_exists(imagesPath($producto->getImagen()))) {

    unlink(imagesPath($producto->getImagen()));
  }


    $_SESSION['feedback_exito'] = "✅ El producto <b>" . htmlspecialchars($producto->getTitulo()) . "</b> se eliminó con éxito.";
} catch (\Throwable $th) {
    // throw $th;
    $_SESSION['feedback_error'] = "❌ Error inesperado. Reintentá más tarde.";
}

header("Location: ../index.php?seccion=productos");