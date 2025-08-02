<?php
require_once __DIR__ . '/../bootstrap/init.php';
session_start();

$carrito = new Carrito();

$accion = $_POST['accion'] ?? null;
$id = isset($_POST['id']) ? (int)$_POST['id'] : 0;

switch ($accion) {
    case 'agregar':
        $cantidad = (int)($_POST['cantidad'] ?? 1);
        $titulo = $_POST['titulo'] ?? 'Producto';
        $precio = (float)($_POST['precio'] ?? 0);

        $carrito->agregarProducto($id, $titulo, $precio, $cantidad);
        break;

    case 'sumar':
        foreach ($carrito->getItems() as $item) {
            if ($item['producto_id'] === $id) {
                $carrito->agregarProducto($id, $item['titulo'], $item['precio_unitario'], 1);
                break;
            }
        }
        break;

    case 'restar':
        $items = $carrito->getItems();
        foreach ($items as $index => $item) {
            if ($item['producto_id'] === $id) {
                if ($item['cantidad'] > 1) {
                    $items[$index]['cantidad']--;
                } else {
                    unset($items[$index]);
                }
                $carrito->setItems(array_values($items));
                break;
            }
        }
        break;

    case 'eliminar':
        $carrito->quitarProducto($id);
        break;

    case 'vaciar':
        $carrito->vaciar();
        break;
}

header('Location: ' . $_SERVER['HTTP_REFERER']);

exit;
