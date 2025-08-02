<?php

class Carrito
{
    private array $items = [];

    public function __construct()
    {
        session_start();
        $this->items = $_SESSION['carrito'] ?? [];
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function setItems(array $items): void
    {
        $this->items = $items;
        $_SESSION['carrito'] = $this->items;
    }

    public function agregarProducto(int $producto_id, string $titulo, float $precio_unitario, int $cantidad = 1): void
    {
        foreach ($this->items as &$item) {
            if ($item['producto_id'] === $producto_id) {
                $item['cantidad'] += $cantidad;
                $_SESSION['carrito'] = $this->items;
                return;
            }
        }

        $this->items[] = [
            'producto_id' => $producto_id,
            'titulo' => $titulo,
            'precio_unitario' => $precio_unitario,
            'cantidad' => $cantidad
        ];

        $_SESSION['carrito'] = $this->items;
    }

    public function quitarProducto(int $producto_id): void
    {
        $this->items = array_filter($this->items, function ($item) use ($producto_id) {
            return $item['producto_id'] !== $producto_id;
        });
        $this->items = array_values($this->items);
        $_SESSION['carrito'] = $this->items;
    }

    public function vaciar(): void
    {
        $this->items = [];
        unset($_SESSION['carrito']);
    }

    public function calcularTotal(): float
    {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item['precio_unitario'] * $item['cantidad'];
        }
        return $total;
    }

    public function cantidadTotal(): int
    {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item['cantidad'];
        }
        return $total;
    }
}
