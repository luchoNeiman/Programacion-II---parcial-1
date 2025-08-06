<?php
require_once __DIR__ . '/../bootstrap/init.php';

$carrito = new Carrito();

// Toma la acción que se mandó por POST, si no hay nada, queda como null
$accion = $_POST['accion'] ?? $_GET['accion'];


// Obtiene el ID del producto desde POST, lo castea a entero. Si no está, usa 0
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

switch ($accion) {
    case 'agregar':
        // Si se quiere agregar un producto, se obtienen los datos necesarios
        $cantidad = (int)($_POST['cantidad'] ?? 1);
        $titulo = $_POST['titulo'] ?? 'Producto';
        $precio = (float)($_POST['precio'] ?? 0);
        $imagen = $_POST['imagen'] ?? '';

        // Agrega el producto al carrito
        $carrito->agregarProducto($id, $titulo, $precio, $cantidad, $imagen);
        break;

    case 'sumar':
        // Busca el producto en el carrito y le suma uno más
        foreach ($carrito->getItems() as $item) {
            if ($item['producto_id'] === $id) {
                // Reutiliza el método agregarProducto para sumarle una unidad
                $carrito->agregarProducto($id, $item['titulo'], $item['precio_unitario'], 1);
                break;
            }
        }
        break;

    case 'restar':
        // Resta uno a la cantidad de un producto o lo elimina si ya hay solo uno
        $items = $carrito->getItems();
        foreach ($items as $index => $item) {
            if ($item['producto_id'] === $id) {
                if ($item['cantidad'] > 1) {
                    // Si hay más de uno, se resta uno
                    $items[$index]['cantidad']--;
                } else {
                    // Si hay uno solo, se saca del array
                    unset($items[$index]);
                }
                // Actualiza el carrito con los nuevos items
                $carrito->setItems(array_values($items)); // Reindexa el array para evitar saltos de índice
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
