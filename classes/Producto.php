<?php
require_once __DIR__ . '/DBConexion.php';
// const PRODUCTOS_JSON = 'productos.json';

class Producto
{
    private int $producto_id = 0;
    private int $usuario_fk = 0;
    private string $fecha_ingreso = "";
    private string $titulo = "";
    private string $descripcion = "";
    private float $precio = 0.0;
    private ?string $imagen = "";
    private ?string $imagen_descripcion = "";
    private string $franquicia = "";
    private string $categoria = "";
    private string $caracteristicas = "";

    /**
     * Carga los datos de un producto desde un array asociativo.
     *
     * @param array $data Array asociativo con los datos del producto.
     *
     * @return void no devuelve nada
     */
    public function cargarDatosArray(array $data): void
    {
        $this->producto_id              = $data['producto_id'];
        $this->titulo                   = $data['titulo'];
        $this->descripcion              = $data['descripcion'];
        $this->precio                   = $data['precio'];
        $this->imagen                   = $data['imagen'];
        $this->imagen_descripcion       = $data['imagen_descripcion'];
        $this->franquicia               = $data['franquicia'];
        $this->categoria                = $data['categoria'];
        $this->caracteristicas          = $data['caracteristicas'];
    }

    /**
     * Recupera y devuelve todos los productos desde un archivo JSON.
     * @return self[] Lista de objetos Producto que representan todos los productos disponibles.
     */
    public function todosProductos(): array
    {
        // Vamos a traer los productos de la base de datos.
        $db = (new DBConexion)->getConexion();

        $consulta = "SELECT * FROM productos";
        $stmt = $db->prepare($consulta);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, self::class);

        return $stmt->fetchAll();
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
        // Traemos el producto desde la base de datos.
        $db = (new DBConexion)->getConexion();
        $consulta = "SELECT * FROM productos
                    WHERE producto_id = ?";

        $stmt = $db->prepare($consulta);
        $stmt->execute([$id]);

        $stmt->setFetchMode(PDO::FETCH_CLASS, self::class);

        $noticia = $stmt->fetch();

        if (!$noticia) return null;

        return $noticia;
    }


    public function getProductoId(): int
    {
        return $this->producto_id;
    }

    public function setProductoId(int $producto_id): void
    {
        $this->producto_id = $producto_id;
    }

    public function getUsuarioFk(): int
    {
        return $this->usuario_fk;
    }

    public function setUsuarioFk(int $usuario_fk): void
    {
        $this->usuario_fk = $usuario_fk;
    }

    public function getFechaIngreso(): string
    {
        return $this->fecha_ingreso;
    }

    public function setFechaIngreso(string $fecha_ingreso): void
    {
        $this->fecha_ingreso = $fecha_ingreso;
    }

    public function getTitulo(): string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): void
    {
        $this->titulo = $titulo;
    }

    public function getDescripcion(): string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): void
    {
        $this->descripcion = $descripcion;
    }

    public function getPrecio(): int
    {
        return $this->precio;
    }

    public function setPrecio(string $precio): void
    {
        $this->precio = $precio;
    }

    public function getImagen(): ?string
    {
        return $this->imagen;
    }

    public function setImagen(?string $imagen): void
    {
        $this->imagen = $imagen;
    }

    public function getImagenDescripcion(): ?string
    {
        return $this->imagen_descripcion;
    }

    public function setImagenDescripcion(?string $imagen_descripcion): void
    {
        $this->imagen_descripcion = $imagen_descripcion;
    }

    public function getFranquicia(): string
    {
        return $this->franquicia;
    }

    public function setFranquicia(string $franquicia): void
    {
        $this->franquicia = $franquicia;
    }

    public function getCategoria(): string
    {
        return $this->categoria;
    }

    public function setCategoria(string $categoria): void
    {
        $this->categoria = $categoria;
    }

    public function getCaracteristicas(): string
    {
        return $this->caracteristicas;
    }

    public function setCaracteristicas(string $caracteristicas): void
    {
        $this->caracteristicas = $caracteristicas;
    }
    
    /**
     * Recupera productos filtrados por tipo de edición (máximo 4 productos).
     *
     * @param string|null $categoria1 Primera edición a filtrar (opcional)
     * @param string|null $categoria2 Segunda edición a filtrar (opcional)
     * @return Producto[] Lista de productos filtrados (máximo 4)
     */
    public function obtenerPorCategoria(?string $categoria1 = null, ?string $categoria2 = null): array
    {
        $productos = $this->todosProductos();

        // si no se pasa ningun parametro, devvuelve edición estándar
        if ($categoria1 === null && $categoria2 === null) {
            $filtrados = array_filter($productos, function ($producto) {
                return $producto->categoria === "Estándar";
            });
        } // Si solo se especifica una edición
        else if ($categoria2 === null) {
            $filtrados = array_filter($productos, function ($producto) use ($categoria1) {
                return $producto->categoria === $categoria1;
            });
        } // Si se especifican dos categoriaes
        else {
            $filtrados = array_filter($productos, function ($producto) use ($categoria1, $categoria2) {
                return $producto->categoria === $categoria1 || $producto->categoria === $categoria2;
            });
        }

        // Convertir a array indexado y obtener solo los primeros 4 elementos
        return array_slice(array_values($filtrados), 0, 4);
    }
}
