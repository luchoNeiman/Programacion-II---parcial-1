<?php
require __DIR__ . '/../../bootstrap/init.php';

$autenticacion = new Autenticacion;
if (!$autenticacion->estaAutenticado()) {
    $_SESSION['feedback_error'] = "Para realizar esta acción es necesario primero iniciar sesión.";
    header("Location: ../index.php");
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
$producto_id = $_GET['id'];

$titulo = trim($_POST['titulo']);
$descripcion = trim($_POST['descripcion']);
$precio = $_POST['precio'];

$imagen = $_FILES['imagen'];
$imagen_descripcion = trim($_POST['imagen_descripcion']);
$caracteristicas = trim($_POST['caracteristicas']);

$categorias = $_POST['categoria_fk'] ?? [];
$nueva_categoria = $_POST['nueva_categoria'];

$franquicia_fk = intval($_POST['franquicia_fk'] ?? 0);
$nueva_franquicia = $_POST['nueva_franquicia'];

/** validaciones */
$errores = [];

/** Manejo de archivo imagen */
// Si se sube una imagen nueva, se guarda en la carpeta assets/imgs/productos/
// Si no se sube ninguna imagen, se mantiene la imagen actual
//proximamente agregar compatibilidad de rutas y demas

if (!empty($imagen['tmp_name'])) {
  $nombreImagen = basename($_FILES['imagen']['name']);
  $nombreImagen = date('YmdHis') . "_" . $imagen['name'];
  // Ruta temporal y final
  $rutaTemporal = $_FILES['imagen']['tmp_name'];
  $rutaDestino =__DIR__ . '/../../assets/imgs/productos/' . $nombreImagen;
  // Movemos el archivo
  $subido = move_uploaded_file($rutaTemporal, $rutaDestino);
  if (!$subido) {
    $_SESSION['feedback_error'] = "Ocurrió un error al tratar de subir el archivo.";
    $_SESSION['data_vieja'] = $_POST;
    header("Location: ../index.php?seccion=nuevoProducto");
    exit;
  }
}

if (empty($titulo)) {
    $errores['titulo'] = 'El título debe tener un valor.';
} else {
    if (strlen($titulo) < 6 || strlen($titulo) > 26) {
        $errores['titulo'] = 'El título debe tener entre 6 y 26 caracteres.';
    }
}

if (!is_numeric($precio) || $precio <= 0) {
    $errores['precio'] = 'El precio debe ser un número válido mayor a cero.';
}

if ((empty($categorias) || !is_array($categorias)) && empty($nueva_categoria)) {
    $errores['categorias'] = 'Debe seleccionar al menos una categoría o crear una nueva.';
}

if ($franquicia_fk === 0 && empty($nueva_franquicia)) {
  // No eligió nada, ni escribió nada
  $errores['franquicia'] = 'Tenés que seleccionar o ingresar una franquicia';
} elseif ($franquicia_fk !== 0 && !empty($nueva_franquicia)) {
  // Eligió franquicia y escribió nueva al mismo tiempó
  $errores['franquicia'] = 'No podés seleccionar una franquicia y escribir una nueva al mismo tiempo.';
}

if (count($errores) > 0) {
    $_SESSION['errores'] = $errores;
    $_SESSION['data_vieja'] = $_POST;
    header('Location: ../index.php?seccion=edicionProducto&id=' . $producto_id);
    exit;
}


// Procesa la creación de una nueva categoría si se proporcionó
// Si se crea exitosamente, agrega el ID de la nueva categoría al array de categorías
try {
    if (!empty($nueva_categoria)) {
        $categoria = new Categoria();
        $nuevoId = $categoria->agregar($nueva_categoria);
        $categorias[] = $nuevoId;
    }
} catch (PDOException $th) {
    echo "Error al agregar categorias: " . $th->getMessage();
    exit;
}

// Procesa la creación de una nueva franquicia si se proporcionó
// Si no se crea una nueva, mantiene la franquicia seleccionada del formulario
try {
    if (!empty($nueva_franquicia)) {
        $franquicia = new Franquicia();
        $franquicia_fk = $franquicia->agregar($nueva_franquicia);
    } else {
      $franquicia_fk = intval($_POST['franquicia_fk']);
    }
} catch (PDOException $th) {
    echo "Error al agregar franquicia: " . $th->getMessage();
    exit;
}
$producto = (new Producto)->porId($producto_id);
try {
    (new Producto())->editar($producto_id, [
        'franquicia_fk' => $franquicia_fk,
        'titulo' => $titulo,
        'descripcion' => $descripcion,
        'caracteristicas' => $caracteristicas,
        'precio' => $precio,
        'imagen' => $nombreImagen ?? $producto->getImagen(),
        'imagen_descripcion' => $imagen_descripcion,
    ]);
    (new Categoria()) -> setCategoriasProducto($producto_id, $categorias);

    $_SESSION['feedback_exito'] = "✅ Producto actualizado correctamente.";
    header('Location: ../index.php?seccion=productos');
    exit;
} catch (Throwable $th) {
//    $_SESSION['feedback_error'] = "Ocurrió un error: " . $th->getMessage();
    $_SESSION['feedback_error'] = "❌ Ocurrió un error inesperado. Intentá de nuevo.";
    header('Location: ../index.php?seccion=edicionProducto&id=' . $producto_id);
    exit;
}
