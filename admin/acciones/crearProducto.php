<?php
require __DIR__ . '/../../bootstrap/autoload.php';

session_start();

$usuario_id = $_SESSION['usuario_id'];
$titulo = trim($_POST['titulo']);
$descripcion = $_POST['descripcion'];
$precio = $_POST['precio'];
$imagen_descripcion = $_POST['imagen_descripcion'];
$caracteristicas = $_POST['caracteristicas'];
$categorias = $_POST['categorias'] ?? [];
$nueva_categoria = $_POST['nueva_categoria'];
$nueva_franquicia = $_POST['nueva_franquicia'];

/** validaciones */
$errores = [];

/** Manejo de archivo imagen */
// Si se sube una imagen nueva, se guarda en la carpeta assets/imgs/productos/
// Si no se sube ninguna imagen, se mantiene la imagen actual
$nombreImagen = 'default.png'; // Imagen por defecto

if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
    // Tomamos el nombre original del archivo
    $nombreImagen = basename($_FILES['imagen']['name']);

    // Ruta temporal y final
    $rutaTemporal = $_FILES['imagen']['tmp_name'];
    $rutaDestino = __DIR__ . '/../../assets/imgs/productos/' . $nombreImagen;

    // Verificamos que exista la carpeta destino, si no la creamos
    if (!is_dir(dirname($rutaDestino))) {
        mkdir(dirname($rutaDestino), 0775, true);
    }
    // Movemos el archivo
    move_uploaded_file($rutaTemporal, $rutaDestino);
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

    $_SESSION['feedback_exito'] = "✅ Producto creado correctamente.";
    header('Location: ../index.php?seccion=productos');
    exit;

} catch (Throwable $th) {
    $_SESSION['feedback_error'] = "❌ Ocurrió un error inesperado. Intentá de nuevo.";
    header('Location: ../index.php?seccion=nuevoProducto');
    exit;
}