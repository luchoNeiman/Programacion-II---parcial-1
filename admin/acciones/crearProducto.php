<?php
require __DIR__ . '/../../bootstrap/autoload.php';

session_start();
// Preguntamos si el usuario está autenticado. De lo contrario, no permitimos la acción.
/*$autenticacion = new Autenticacion;
if(!$autenticacion->estaAutenticado()) {
    $_SESSION['feedback_error'] = "Para realizar esta acción es necesario primero iniciar sesión.";
    header("Location: ../index.php");
    exit;
}*/

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
    $franqModel = new Franquicia();
    $franqModel->agregar($nueva_franquicia); // asumimos que tenés este método
    $franquicia_fk = (new DBConexion)->getConexion()->lastInsertId();
} else {
    $franquicia_fk = intval($_POST['franquicia_fk'] ?? 0);
}
// Manejo de archivo imagen
$nombreImagen = null;
if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
    $nombreImagen = basename($_FILES['imagen']['name']);         // nombre único
    $rutaTemporal = $_FILES['imagen']['tmp_name'];
    $rutaDestino = __DIR__ . '/../../assets/imgs/productos/' . $nombreImagen; // ajustá la ruta si cambia

    // Creamos la carpeta si no existe
    if (!is_dir(dirname($rutaDestino))) {
        mkdir(dirname($rutaDestino), 0775, true);
    }
    move_uploaded_file($rutaTemporal, $rutaDestino);
}
try {
    (new Producto())->crear([
        'usuario_fk' => 1,                 // hardcode hasta que tengas login
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
    // 5. Redireccionamos. Como salió mal, lo volvemos a enviar al form.
    $_SESSION['feedback_error'] = "Ocurrió un error: " . $th->getMessage();
    header('Location: ../index.php?seccion=nuevoProducto');
    exit;
}