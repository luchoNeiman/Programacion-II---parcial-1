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
    public string $caracteristicas = "";

    /**
     * Carga los datos de un producto desde un array asociativo.
     *
     * @param array $data Array asociativo con los datos del producto.
     *
     * @return void no devuelve nada
     */
    public function cargarDatosArray(array $data): void
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
        $this->caracteristicas      = $data['caracteristicas'];
    }

    /**
     * Recupera y devuelve todos los productos desde un archivo JSON.
     *
     * @return Producto[] Lista de objetos Producto que representan todos los productos disponibles.
     */
    public function todosProductos(): array
    {
        $productoJson = json_decode(file_get_contents(__DIR__ . '/../data/' . PRODUCTOS_JSON), true);
        // Leer el archivo JSON que contiene todos los productos y convertir su contenido en un array asociativo.

        $productos = []; // array donde se almacena todos los objetos Producto.

        foreach ($productoJson as $unProductoJson) {
            $producto = new self; // Crear una nueva instancia de la clase Producto.
            $producto->cargarDatosArray($unProductoJson); // Cargar los datos del producto.

            $productos[] = $producto; // Añadir el objeto Producto al array.
        }

        return $productos;
    }

    /**
     * Busca y devuelve un producto específico por su ID.
     *
     * @param int $id El ID del producto a buscar.
     *
     * @return self|null Devuelve una instancia de Producto si el ID coincide, o null si no se encuentra.
     */
    public function porId(int $id): ?self
    {
        // Busca y devuelve un producto específico por su ID, o null si no existe.
        $productos = $this->todosProductos(); // Obtiene todos los productos.

        foreach ($productos as $unProducto) {
            if ($unProducto->producto_id == $id) {
                // Si el ID coincide con el buscado.
                return $unProducto;
            }
        }
        return null;
    }
}