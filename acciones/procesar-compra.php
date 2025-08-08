<?php
require_once __DIR__ . '/../bootstrap/init.php';

if (!isset($_SESSION['usuario_id'])) {
  header('Location: index.php?seccion=iniciar-sesion');
  exit;
}

$usuarioId = $_SESSION['usuario_id'];
$carrito = new Carrito();
$items = $carrito->getItems($usuarioId);

if (empty($items)) {
  header('Location: index.php?seccion=ver-carrito');
  exit;
}

// Calcular total
$totalCompra = array_sum(array_map(fn($item) => $item['precio_unitario'] * $item['cantidad'], $items));

// Guardar compra y sus productos
$compra = new Compra();
$compraId = $compra->registrarCompra($usuarioId, $totalCompra);
$compra->registrarProductosCompra($compraId, $items);

// Vaciar carrito y redirigir
$carrito->vaciar($usuarioId);
header('Location: ../index.php?seccion=Gracias&id=' . $compraId);
exit;

