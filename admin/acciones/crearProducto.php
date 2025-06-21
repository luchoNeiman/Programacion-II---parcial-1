<?php
require __DIR__ . '/../../bootstrap/autoload.php';

session_start();

$usuario_id = $_SESSION['usuario_id'];
$titulo = $_POST['titulo'];
$descripcion = $_POST['descripcion'];
$precio = $_POST['precio'];
$imagen_descripcion = $_POST['imagen_descripcion'];
$caracteristicas = $_POST['caracteristicas'];
$categorias = $_POST['categorias'] ?? [];
$nueva_categoria = $_POST['nueva_categoria'];
$nueva_franquicia = $_POST['nueva_franquicia'];

/** validaciones */
$errores = [];

// Manejo de archivo imagen
$nombreImagen = 'default.png'; // Valor por defecto, en caso de que no se suba ninguna imagen válida

if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
    $nombreOriginal = basename($_FILES['imagen']['name']);
    $extension = strtolower(pathinfo($nombreOriginal, PATHINFO_EXTENSION));
    $permitidas = ['jpg', 'jpeg', 'png', 'webp'];

    if (in_array($extension, $permitidas)) {
        $nombreImagen = uniqid('img_') . '.' . $extension;
        $rutaTemporal = $_FILES['imagen']['tmp_name'];
        $rutaDestino = __DIR__ . '/../../assets/imgs/productos/' . $nombreImagen;

        if (!is_dir(dirname($rutaDestino))) {
            mkdir(dirname($rutaDestino), 0775, true);
        }

        move_uploaded_file($rutaTemporal, $rutaDestino);
    } else {
        // Si el formato no es válido, conservamos default.png pero además avisamos
        $errores['imagen'] = 'Formato de imagen no válido. Solo se permiten: jpg, jpeg, png y webp.';
    }
}


if (empty($titulo)) {
    $errores['titulo'] = 'El título debe tener un valor.';
}
if (!is_numeric($precio) || $precio <= 0) {
    $errores['precio'] = 'El precio debe ser un número válido mayor a cero.';
}

if ((empty($categorias) || !is_array($categorias)) && empty($nueva_categoria)) {
    $errores['categorias'] = 'Debe seleccionar al menos una categoría o crear una nueva.';
}

$franquicia_fk = intval($_POST['franquicia_fk'] ?? 0);
if ($franquicia_fk === 0 && empty($nueva_franquicia)) {
    $errores['franquicia'] = 'Debe seleccionar una franquicia válida o crear una nueva.';
}


if (count($errores) > 0) {

    $_SESSION['errores'] = $errores;
    $_SESSION['data_vieja'] = $_POST;
    header("Location: ../index.php?seccion=nuevoProducto");
    exit;
}

//Se ejecuta si se agrega una nueva categoria
if (!empty($nueva_categoria)) {
    $categoria = new Categoria();
    $nuevoId = $categoria->agregar($nueva_categoria);
    $categorias[] = $nuevoId;
}
//Se ejecuta si se agrega una nueva franquicia
if (!empty($nueva_franquicia)) {
    $franquicia = new Franquicia();
    $franquicia_fk = $franquicia->agregar($nueva_franquicia);
} else {
    $franquicia_fk = intval($_POST['franquicia_fk'] ?? 0);
}

try {
    (new Producto())->crear([
        'usuario_fk' => $usuario_id,
        'franquicia_fk' => $franquicia_fk,
        'titulo' => $titulo,
        'descripcion' => $descripcion,
        'caracteristicas' => $caracteristicas,
        'precio' => $precio,
        'imagen' => $nombreImagen,
        'imagen_descripcion' => $imagen_descripcion,
        'categorias' => $categorias,
    ]);

    $_SESSION['feedback_exito'] = "Producto creado correctamente.";
    header('Location: ../index.php?seccion=productos');
    exit;

} catch (Throwable $th) {
    $_SESSION['feedback_error'] = "Ocurrió un error: " . $th->getMessage();
    header('Location: ../index.php?seccion=nuevoProducto');
    exit;
}