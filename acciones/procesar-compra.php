<?php
// Requiere el archivo de inicialización, así conecta a la base y carga clases
require_once __DIR__ . '/../bootstrap/init.php';

// Si el usuario no está logueado, lo mando a iniciar sesión y corto todo
if (!isset($_SESSION['usuario_id'])) {
  header('Location: index.php?seccion=iniciar-sesion');
  exit;
}

// Guardo el ID del usuario logueado
$usuarioId = $_SESSION['usuario_id'];

// Creo la instancia del carrito para laburar
$carrito = new Carrito();
// Traigo todos los items del carrito para este usuario
$items = $carrito->getItems($usuarioId);

// Si el carrito está vacío, lo mando de nuevo a la pantalla del carrito y corto todo
if (empty($items)) {
  header('Location: index.php?seccion=ver-carrito');
  exit;
}

// Calculá el total de la compra sumando precio * cantidad de cada producto
$totalCompra = 0;
foreach ($items as $item) {
  $totalCompra += $item['precio_unitario'] * $item['cantidad'];
}

// 1. Insertar la compra en la tabla 'compras' (guardo usuario, fecha y total)
// Preparo la conexión y la consulta
$db = DBConexionStatic::getConexion();
$sql = "INSERT INTO compras (usuario_fk, fecha, total_compra) VALUES (:usuario_id, NOW(), :total)";
$stmt = $db->prepare($sql);
$stmt->execute([
  ':usuario_id' => $usuarioId,
  ':total' => $totalCompra
]);
// Obtengo el ID de la compra que acabo de insertar (autoincremental)
$compraId = $db->lastInsertId();

// 2. Por cada producto, lo guardo en 'compras_tienen_productos' con los datos que corresponden
$sqlProd = "INSERT INTO compras_tienen_productos 
                (producto_fk, compra_fk, cantidad, precio_unitario, total)
            VALUES 
                (:producto_fk, :compra_fk, :cantidad, :precio_unitario, :total)";
$stmtProd = $db->prepare($sqlProd);

foreach ($items as $item) {
  // Inserto cada producto de la compra con su cantidad y precio
  $stmtProd->execute([
    ':producto_fk' => $item['producto_id'],
    ':compra_fk' => $compraId,
    ':cantidad' => $item['cantidad'],
    ':precio_unitario' => $item['precio_unitario'],
    ':total' => $item['precio_unitario'] * $item['cantidad']
  ]);
}

// 3. Borro todos los productos del carrito de ese usuario (lo vacío)
$carrito->vaciar($usuarioId);

// 4. Redirijo a la pantalla de agradecimiento, pasando el ID de la compra para mostrar el resumen
header('Location: ../index.php?seccion=Gracias&id=' . $compraId);
exit;
