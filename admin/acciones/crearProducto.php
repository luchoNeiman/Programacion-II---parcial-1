<?php
require __DIR__ . '/../../bootstrap/autoload.php';

session_start();

$usuarios_fk = $_POST['usuarios_fk'];
$titulo = $_POST['titulo'];
$descripcion = $_POST['descripcion'];
$precio = $_POST['precio'];
$imagen_descripcion = $_POST['imagen_descripcion'];
$caracteristicas = $_POST['caracteristicas'];
$categorias = $_POST['categorias'] ?? [];
$nueva_categoria = $_POST['nueva_categoria'];
$nueva_franquicia = $_POST['nueva_franquicia'];

//Se ejecuta si se agrega una nueva categoria
if ($nueva_categoria !== '') {
    $categoria = new Categoria();
    // Insertamos la nueva categoría y obtenemos el ID
    $categoria->agregar($nueva_categoria);
    $nuevoId = (new DBConexion)->getConexion()->lastInsertId();
    $categorias[] = $nuevoId;
}

//Se ejecuta si se agrega una nueva categoria

if ($nueva_franquicia !== '') {
    $franquicia = new Franquicia();
    $franquicia->agregar($nueva_franquicia);
    $franquicia_fk = (new DBConexion)->getConexion()->lastInsertId();
} else {
    $franquicia_fk = intval($_POST['franquicia_fk'] ?? 0);

}

// Manejo de archivo imagen

$nombreImagen = null;
if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
    $nombreImagen = basename($_FILES['imagen']['name']);
    $rutaTemporal = $_FILES['imagen']['tmp_name'];
    $rutaDestino = __DIR__ . '/../../assets/imgs/productos/' . $nombreImagen;

    if (!is_dir(dirname($rutaDestino))) {
        mkdir(dirname($rutaDestino), 0775, true);
    }
    move_uploaded_file($rutaTemporal, $rutaDestino);
}
/** validaciones */
$errores = [];

$descripcion = $_POST['descripcion'];
$precio = $_POST['precio'];
$imagen_descripcion = $_POST['imagen_descripcion'];
$caracteristicas = $_POST['caracteristicas'];
$categorias = $_POST['categorias'] ?? [];
$nueva_categoria = $_POST['nueva_categoria'];
$nueva_franquicia = $_POST['nueva_franquicia'];

if(empty($titulo)) {
    $errores['titulo'] = 'El título debe tener un valor.';
} else if(strlen($titulo) < 2) {
    $errores['titulo'] = 'El título debe tener al menos 2 caracteres.';
}

if(empty($sinopsis)) {
    $errores['sinopsis'] = 'La sinopsis debe tener un valor.';
}

if(empty($cuerpo)) {
    $errores['cuerpo'] = 'El cuerpo debe tener un valor.';
}

// Preguntamos si hubo errores.
if(count($errores) > 0) {
    // ¿Cómo pasamos los errores, o cualquier otro valor, de una ejecución de php a otra?
    // La forma más común de resolver este problema es usando "sesiones" (ver arriba).
    $_SESSION['errores'] = $errores;
    // Además, también sumamos otra variable de sesión que contenga los datos recibidos del formulario.
    $_SESSION['data_vieja'] = $_POST;
    header("Location: ../index.php?seccion=noticias-publicar");
    exit;
}

try {
    (new Producto())->crear([
        'usuario_fk' => 1,
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
    $_SESSION['feedback_error'] = "Ocurrió un error: " . $th->getMessage();
    header('Location: ../index.php?seccion=nuevoProducto');
    exit;
}