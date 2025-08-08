<?php
require_once __DIR__ . '/../bootstrap/init.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  header('Location: index.php?seccion=ver-carrito');
  exit;
}

if (!(new Autenticacion)->estaAutenticado()) {
  header('Location: index.php?seccion=iniciar-sesion');
  exit;
}

$usuarioId = (int)($_SESSION['usuario_id'] ?? 0);
if ($usuarioId <= 0) {
  header('Location: index.php?seccion=iniciar-sesion');
  exit;
}

// --- Opcional: CSRF ---
// if (!isset($_POST['csrf']) || !hash_equals($_SESSION['csrf'] ?? '', $_POST['csrf'])) {
//   http_response_code(403);
//   exit('CSRF token inválido.');
// }

$carrito = new Carrito();
$compra  = new Compra();

// Traigo ítems del carrito como OBJETOS Carrito
$itemsObj = $carrito->getItems($usuarioId);

// Si no hay nada, vuelvo al carrito
if (empty($itemsObj)) {
  header('Location: index.php?seccion=ver-carrito');
  exit;
}

// Total calculado por la clase
$total = (float)$carrito->calcularTotal($usuarioId);

// MAPEO a ARRAYS como espera Compra::registrarProductosCompra()
$items = array_map(function (Carrito $it) {
  return [
    'producto_id'     => $it->getProductoId(),
    'cantidad'        => $it->getCantidad(),
    'precio_unitario' => $it->getPrecioUnitario(),
  ];
}, $itemsObj);

// Transacción para asegurar atomicidad
$db = DBConexionStatic::getConexion();
try {
  $db->beginTransaction();

  // 1) Registrar compra y obtener ID
  $compraId = $compra->registrarCompra($usuarioId, $total);

  // 2) Registrar detalle de productos (recibe ARRAYS)
  $compra->registrarProductosCompra($compraId, $items);

  // 3) Vaciar carrito
  $carrito->vaciar($usuarioId);

  $db->commit();

  // Redirigir a gracias con el id de compra
  header('Location: ../index.php?seccion=Gracias&id=' . $compraId);
  exit;

} catch (Throwable $e) {
  if ($db->inTransaction()) {
    $db->rollBack();
  }
  // Podés loguear $e->getMessage() si tenés logger
  header('Location: ../index.php?seccion=ver-carrito');
  exit;
}
