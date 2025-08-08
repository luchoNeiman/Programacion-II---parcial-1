<?php
require_once __DIR__ . '/../bootstrap/init.php';

// Tomo el usuario logueado desde la sesión
$usuarioId = $_SESSION['usuario_id'];

// Instancio el carrito para poder operar
$carrito = new Carrito();

// Chequeo qué acción vino por POST (puede ser vaciar, sumar, restar, eliminar, agregar, etc)
$accion = $_POST['accion'] ?? null;

if ($accion) {
  // Si la acción es "vaciar", vacío el carrito directamente
  if ($accion === 'vaciar') {
    $carrito->vaciar($usuarioId);

    // Si la acción viene tipo 'sumar_5', 'restar_3', 'eliminar_7', etc.
  } elseif (str_contains($accion, '_')) {
    // Separo el tipo y el id (ej: 'sumar_5' -> $tipo='sumar', $id=5)
    list($tipo, $id) = explode('_', $accion);
    $id = (int)$id;

    // Según el tipo, hago la acción correspondiente
    switch ($tipo) {
      case 'sumar':
        // Sumo uno al producto
        $carrito->sumar($usuarioId, $id);
        break;
      case 'restar':
        // Resto uno al producto (si queda 0 lo elimina)
        $carrito->restar($usuarioId, $id);
        break;
      case 'eliminar':
        // Borro el producto del carrito
        $carrito->eliminarProducto($usuarioId, $id);
        break;
      case 'agregar':
        // Agrego el producto, chequeando si vino cantidad (default 1)
        $cantidad = (int)($_POST['cantidad'] ?? 1);
        $carrito->agregarProducto($usuarioId, $id, $cantidad);
        break;
    }
  }
}

// Siempre redirijo a la página anterior para mantener la UX
header('Location: ' . $_SERVER['HTTP_REFERER']);
exit;
