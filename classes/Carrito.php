<?php

class Carrito {
    /**
     * Agrega un producto al carrito.
     * Si el producto ya existe, suma la cantidad.
     */
    public function agregarProducto($id, $titulo, $precio, $cantidad = 1, $imagen = '') {
        // Si el carrito no existe en la sesión, lo inicializa como un array vacío
        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = [];
        }

        // Recorre los productos del carrito para ver si ya está el producto
        foreach ($_SESSION['carrito'] as &$item) {
            if ($item['producto_id'] === $id) {
                // Si ya está, le suma la cantidad y sale
                $item['cantidad'] += $cantidad;
                return;
            }
        }

        // Si no estaba, lo agrega como nuevo item al carrito
        $_SESSION['carrito'][] = [
            'producto_id' => $id,
            'titulo' => $titulo,
            'precio_unitario' => $precio,
            'cantidad' => $cantidad,
            'imagen' => $imagen,
        ];
    }

    /**
     * Devuelve todos los productos del carrito.
     */
    public function getItems() {
        // Si el carrito no existe, devuelve array vacío
        return $_SESSION['carrito'] ?? [];
    }

    /**
     * Reemplaza los productos actuales del carrito por otro array.
     */
    public function setItems($items) {
        $_SESSION['carrito'] = $items;
    }

    /**
     * Elimina un producto del carrito según su ID.
     */
    public function quitarProducto($id) {
        if (isset($_SESSION['carrito'])) {
            // Filtra todos los productos excepto el que se quiere quitar
            $_SESSION['carrito'] = array_filter($_SESSION['carrito'], fn($item) => $item['producto_id'] !== $id);
        }
    }

    /**
     * Vacía completamente el carrito.
     */
    public function vaciar() {
        unset($_SESSION['carrito']);
    }

    /**
     * Calcula el total a pagar sumando (precio unitario x cantidad) de cada producto
     */
    public function calcularTotal() {
        $total = 0;
        foreach ($this->getItems() as $item) {
            $total += $item['precio_unitario'] * $item['cantidad'];
        }
        return $total;
    }

    /**
     * Cuenta la cantidad total de ítems en el carrito
     */
    public function getTotalItems(): int {
        $total = 0;
        foreach ($this->getItems() as $item) {
            $total += $item['cantidad'];
        }
        return $total;
    }
}
