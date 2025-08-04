<?php

class Carrito {
    public function agregarProducto($id, $titulo, $precio, $cantidad = 1, $imagen = '') {
        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = [];
        }

        foreach ($_SESSION['carrito'] as &$item) {
            if ($item['producto_id'] === $id) {
                $item['cantidad'] += $cantidad;
                return;
            }
        }

        $_SESSION['carrito'][] = [
            'producto_id' => $id,
            'titulo' => $titulo,
            'precio_unitario' => $precio,
            'cantidad' => $cantidad,
            'imagen' => $imagen,

        ];
    }

    public function getItems() {
        return $_SESSION['carrito'] ?? [];
    }

    public function setItems($items) {
        $_SESSION['carrito'] = $items;
    }

    public function quitarProducto($id) {
        if (isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = array_filter($_SESSION['carrito'], fn($item) => $item['producto_id'] !== $id);
        }
    }

    public function vaciar() {
        unset($_SESSION['carrito']);
    }

    public function calcularTotal() {
        $total = 0;
        foreach ($this->getItems() as $item) {
            $total += $item['precio_unitario'] * $item['cantidad'];
        }
        return $total;
    }
}

