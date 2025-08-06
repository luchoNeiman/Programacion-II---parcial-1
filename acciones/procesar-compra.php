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

// Calculá el total de la compra
$totalCompra = 0;
foreach ($items as $item) {
  $totalCompra += $item['precio_unitario'] * $item['cantidad'];
}

// 1. Insertar compra (ajustado a tus campos)
$db = DBConexionStatic::getConexion();
$sql = "INSERT INTO compras (usuario_fk, fecha, total_compra) VALUES (:usuario_id, NOW(), :total)";
$stmt = $db->prepare($sql);
$stmt->execute([
  ':usuario_id' => $usuarioId,
  ':total'      => $totalCompra
]);
$compraId = $db->lastInsertId();

// 2. Insertar productos de la compra (ajustado a tus campos)
$sqlProd = "INSERT INTO compras_tienen_productos 
                (producto_fk, compra_fk, cantidad, precio_unitario, total)
            VALUES 
                (:producto_fk, :compra_fk, :cantidad, :precio_unitario, :total)";
$stmtProd = $db->prepare($sqlProd);

foreach ($items as $item) {
  $stmtProd->execute([
    ':producto_fk'     => $item['producto_id'],
    ':compra_fk'       => $compraId,
    ':cantidad'        => $item['cantidad'],
    ':precio_unitario' => $item['precio_unitario'],
    ':total'           => $item['precio_unitario'] * $item['cantidad']
  ]);
}

// 3. Vaciar carrito en base
$carrito->vaciar($usuarioId);

// 4. Redirigir a Gracias.php y pasar el ID de la compra
header('Location: ../index.php?seccion=Gracias&id=' . $compraId);
exit;
