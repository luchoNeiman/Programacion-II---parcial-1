<?php

// Incluimos la clase Producto
require_once __DIR__ . '/../classes/Producto.php';
const PRODUCTOS_JSON = 'productos.json';

function obtenerProductos(): array
{
    $productoJson = json_decode(file_get_contents(__DIR__ . '/../data/' . PRODUCTOS_JSON), true);

    $productos = [];

    foreach ($productoJson as $unProductoJson) {
        $producto = new Producto;
        $producto->producto_id          = $unProductoJson['producto_id'];
        $producto->titulo               = $unProductoJson['titulo'];
        $producto->descripcion          = $unProductoJson['descripcion'];
        $producto->precio               = $unProductoJson['precio'];
        $producto->imagen               = $unProductoJson['imagen'];
        $producto->imagen_descripcion   = $unProductoJson['imagen_descripcion'];
        $producto->franquicia           = $unProductoJson['franquicia'];
        $producto->tipo_producto        = $unProductoJson['tipo_producto'];
        $producto->edicion              = $unProductoJson['edicion'];

        $productos[] = $producto;
    }

    return $productos;
}

function buscarProductoPorId(int $id): ?Producto
{
    $productos = obtenerProductos();

    foreach ($productos as $unProducto) {
        if ($unProducto->producto_id == $id) {
            return $unProducto;
        }
    }
    return null;
}
