<?php require_once __DIR__ . '/../bootstrap/init.php';


$usuarioId = $_SESSION['usuario_id'];
$carrito = new Carrito();

$accion = $_POST['accion'] ?? null;

if ($accion) {
  if ($accion === 'vaciar') {
    $carrito->vaciar($usuarioId);
  } elseif (str_contains($accion, '_')) {
    list($tipo, $id) = explode('_', $accion);
    $id = (int)$id;

    switch ($tipo) {
      case 'sumar':
        $carrito->sumar($usuarioId, $id);
        break;
      case 'restar':
        $carrito->restar($usuarioId, $id);
        break;
      case 'eliminar':
        $carrito->eliminarProducto($usuarioId, $id);
        break;
      case 'agregar':
        $cantidad = (int) ($_POST['cantidad'] ?? 1);
        $carrito->agregarProducto($usuarioId, $id, $cantidad);
        break;
    }
  }
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
exit;
