<?php
//require_once __DIR__ . '/DBConexion.php';

// const PRODUCTOS_JSON = 'productos.json';

class Producto
{
    private int $producto_id = 0;
    private int $usuario_fk = 0;
    private int $franquicia_fk = 0;
    private string $fecha_ingreso = "";
    private string $titulo = "";
    private string $descripcion = "";
    private float $precio = 0.0;
    private ?string $imagen = "";
    private ?string $imagen_descripcion = "";
    private string $nombre_franquicia = "";
    private string $categorias = "";
    private string $caracteristicas = "";


    /* public function cargarDatosArray(array $data): void
     {
         $this->producto_id = $data['producto_id'];
         $this->franquicia_fk = $data['franquicia_fk'];
         $this->titulo = $data['titulo'];
         $this->descripcion = $data['descripcion'];
         $this->precio = $data['precio'];
         $this->imagen = $data['imagen'];
         $this->imagen_descripcion = $data['imagen_descripcion'];
         $this->nombre_franquicia = $data['nombre_franquicia'];
         $this->categorias = $data['categorias'];
         $this->caracteristicas = $data['caracteristicas'];
     }*/

    public function todosProductos(): array
    {
        // Vamos a traer los productos de la base de datos.
        $db = (new DBConexion)->getConexion();

        $consulta = "SELECT p.producto_id,
                        p.fecha_ingreso,
                          p.titulo,
                          p.descripcion,
                          p.precio,
                          p.imagen,
                          p.imagen_descripcion,
                          p.caracteristicas,
                          f.nombre_franquicia,
                          GROUP_CONCAT(c.nombre_categoria SEPARATOR ', ') AS categorias
                    FROM productos p
                    JOIN franquicias f ON p.franquicia_fk = f.franquicia_id
                    JOIN productos_tienen_categorias ptc ON p.producto_id = ptc.producto_fk
                    JOIN categorias c ON ptc.categoria_fk = c.categoria_id
                    GROUP BY p.producto_id;";
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
        $consulta = "SELECT *, f.nombre_franquicia, GROUP_CONCAT(c.nombre_categoria SEPARATOR ', ') AS categorias
                        FROM productos p
                        JOIN franquicias f ON p.franquicia_fk = f.franquicia_id
                        JOIN productos_tienen_categorias ptc ON p.producto_id = ptc.producto_fk
                        JOIN categorias c ON ptc.categoria_fk = c.categoria_id
                        WHERE p.producto_id = ?
                        GROUP BY p.producto_id;
                        ";

        $stmt = $db->prepare($consulta);
        $stmt->execute([$id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, self::class);
        $producto = $stmt->fetch();
        if (!$producto) return null;
        return $producto;
    }

    public static function obtenerPorCategoria(string|array $categorias): array
    {
        if (is_string($categorias)) {
            $categorias = [$categorias]; // lo convertimos en array
        }

        $db = (new DBConexion)->getConexion();
        $placeholders = implode(',', array_fill(0, count($categorias), '?'));

        $consulta = "SELECT 
                    p.producto_id,
                    p.titulo,
                    p.precio,
                    p.imagen,
                    p.imagen_descripcion
                 FROM productos p
                 JOIN productos_tienen_categorias pc ON p.producto_id = pc.producto_fk
                 JOIN categorias c ON pc.categoria_fk = c.categoria_id
                 WHERE c.nombre_categoria IN ($placeholders)
                 GROUP BY p.producto_id
                 LIMIT 4";

        $stmt = $db->prepare($consulta);
        $stmt->execute($categorias);

        $stmt->setFetchMode(PDO::FETCH_CLASS, self::class);
        return $stmt->fetchAll();
    }

    public static function obtenerUltimosDelMes(): array
    {
        $db = (new DBConexion)->getConexion();

        $consulta = "SELECT 
                    p.producto_id,
                    p.titulo,
                    p.precio,
                    p.imagen,
                    p.imagen_descripcion
                 FROM productos p
                 WHERE p.fecha_ingreso >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)
                 ORDER BY p.fecha_ingreso DESC         
                                          LIMIT 4";

        $stmt = $db->prepare($consulta);
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_CLASS, self::class);
        return $stmt->fetchAll();
    }

    public function crear(array $data): void
    {
        $db = (new DBConexion)->getConexion();

        // 1. Insertar producto
        $consulta = "INSERT INTO productos 
        (usuario_fk, fecha_ingreso, titulo, franquicia_fk, descripcion, precio, imagen, imagen_descripcion, caracteristicas)
        VALUES (:usuario_fk, NOW(), :titulo, :franquicia_fk, :descripcion, :precio, :imagen, :imagen_descripcion, :caracteristicas)";

        $stmt = $db->prepare($consulta);
        $stmt->execute([
            'usuario_fk'           => $data['usuario_fk'],
            'titulo'               => $data['titulo'],
            'franquicia_fk'        => $data['franquicia_fk'],
            'descripcion'          => $data['descripcion'],
            'precio'               => $data['precio'],
            'imagen'               => $data['imagen'],
            'imagen_descripcion'   => $data['imagen_descripcion'],
            'caracteristicas'      => $data['caracteristicas'],
        ]);

        // 2. Obtener ID del producto recién insertado
        $producto_id = $db->lastInsertId();

        // 3. Insertar categorías relacionadas
        if (!empty($data['categorias']) && is_array($data['categorias'])) {
            $consultaCategorias = "INSERT INTO productos_tienen_categorias (producto_fk, categoria_fk) VALUES (:producto, :categoria)";
            $stmtCategoria = $db->prepare($consultaCategorias);

            foreach ($data['categorias'] as $categoria_id) {
                $stmtCategoria->execute([
                    'producto'  => $producto_id,
                    'categoria' => $categoria_id
                ]);
            }
        }
    }
    public function editar(int $id, array $data): void
    {
        $db = (new DBConexion)->getConexion();
        $consulta = "UPDATE productos
                    SET usuario_fk          = :usuario_fk,
                        titulo              = :titulo,
                        franquicia_fk       = :franquicia_fk,
                        descripcion         = :descripcion,
                        precio              = :precio,
                        imagen              = :imagen
                        imagen_descripcion  = :imagen_descripcion,
                        caracteristicas     = :caracteristicas
                    WHERE producto_id = :producto_id";
        $stmt = $db->prepare($consulta);
        $stmt->execute([
            'usuario_fk'            => $data['usuario_fk'],
            'titulo'                => $data['titulo'],
            'franquicia_fk'         => $data['franquicia_fk'],
            'descripcion'           => $data['descripcion'],
            'precio'                => $data['precio'],
            'imagen'                => $data['imagen'],
            'imagen_descripcion'    => $data['imagen_descripcion'],
            'caracteristicas'       => $data['caracteristicas'],
            'producto_id'           => $id,
        ]);
    }

    public function eliminar(int $id): void
    {
        $db = (new DBConexion)->getConexion();
        $consulta = "DELETE FROM productos
                    WHERE producto_id = ?";
        $stmt = $db->prepare($consulta);
        $stmt->execute([$id]);
    }

    public function getCategoriasIds(): array
    {
        $db = (new DBConexion)->getConexion();
        $stmt = $db->prepare("SELECT categoria_fk FROM productos_tienen_categorias WHERE producto_fk = ?");
        $stmt->execute([$this->producto_id]);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
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

    public function getFranquiciaFk(): int
    {
        return $this->franquicia_fk;
    }

    public function setFranquiciaFk(int $franquicia_fk): void
    {
        $this->franquicia_fk = $franquicia_fk;
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

    public function getNombreFranquicia(): string
    {
        return $this->nombre_franquicia;
    }

    public function setNombreFranquicia(string $nombre_franquicia): void
    {
        $this->nombre_franquicia = $nombre_franquicia;
    }

    public function getCategoria(): string
    {
        return $this->categorias;
    }

    public function setCategoria(string $categorias): void
    {
        $this->categorias = $categorias;
    }

    public function getCaracteristicas(): string
    {
        return $this->caracteristicas;
    }

    public function setCaracteristicas(string $caracteristicas): void
    {
        $this->caracteristicas = $caracteristicas;
    }
}
