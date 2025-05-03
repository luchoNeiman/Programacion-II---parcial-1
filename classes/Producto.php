<?php
const PRODUCTOS_JSON = 'productos.json';

class Producto
{
    public int $producto_id = 0;
    public string $titulo = "";
    public string $descripcion = "";
    public float $precio = 0.0;
    public string $imagen = "";
    public string $imagen_descripcion = "";
    public string $franquicia = "";
    public string $tipo_producto = "";
    public string $edicion = "";

    public function cargarDatosArrray(array $data):void
    {
        $this->producto_id          = $data['producto_id'];
        $this->titulo               = $data['titulo'];
        $this->descripcion          = $data['descripcion'];
        $this->precio               = $data['precio'];
        $this->imagen               = $data['imagen'];
        $this->imagen_descripcion   = $data['imagen_descripcion'];
        $this->franquicia           = $data['franquicia'];
        $this->tipo_producto        = $data['tipo_producto'];
        $this->edicion              = $data['edicion'];
    }

public function todosProductos(): array
{
    $productoJson = json_decode(file_get_contents(__DIR__ . '/../data/' . PRODUCTOS_JSON), true);

    $productos = [];

    foreach ($productoJson as $unProductoJson) {
        $producto = new Producto;
        $producto->cargarDatosArrray($unProductoJson);

        $productos[] = $producto;
    }

    return $productos;
}

public function porId(int $id): ?Producto
{
    $productos = $this->todosProductos();

    foreach ($productos as $unProducto) {
        if ($unProducto->producto_id == $id) {
            return $unProducto;
        }
    }
    return null;
}
}

