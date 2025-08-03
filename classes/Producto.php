<?php

class Producto
{
    private int $producto_id = 0;
    private int $usuario_fk = 0;
    private int $franquicia_fk = 0;
    private string $fecha_ingreso = "";
    private string $titulo = "";
    private string $descripcion = "";
    private float $precio = 0.0;
    private ?string $imagen = null;
    private ?string $imagen_descripcion = null;
    private string $nombre_franquicia = "";
    private string $categorias = "";
    private string $caracteristicas = "";


//    public function cargarDatosArray(array $data): void
//    {
//        $this->producto_id = $data['producto_id'];
//        $this->franquicia_fk = $data['franquicia_fk'];
//        $this->titulo = $data['titulo'];
//        $this->descripcion = $data['descripcion'];
//        $this->precio = $data['precio'];
//        $this->imagen = $data['imagen'];
//        $this->imagen_descripcion = $data['imagen_descripcion'];
//        $this->nombre_franquicia = $data['nombre_franquicia'];
//        $this->categorias = $data['categorias'];
//        $this->caracteristicas = $data['caracteristicas'];
//    }

    /**
     * Busca y devuelve todos los productos de la base de datos.
     *
     * @return array Devuelve una lista de Producto.
     */
    public function todosProductos(): array
    {
        $db = (new DBConexionStatic)->getConexion();
        /* La siguiente consulta hace lo siguiente:
         * 1. Se seleccionan todos los productos de la tabla productos.
         * 2. Se seleccionan las franquicias de la tabla franquicias.
         * 3. se selecciona las categorias de la tabla categorias.
         */
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
                    GROUP BY p.producto_id
                    ORDER BY p.fecha_ingreso DESC;";
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
        $db = (new DBConexionStatic)->getConexion();
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

    /**
     * Obtiene los productos que pertenezcan a las categorías indicadas.
     *
     * @param string|array $categorias
     * @return array
     *
     */
    public static function obtenerPorCategoria( $categorias): array
    //public static function obtenerPorCategoria(string|array $categorias): array
    {   /* si es un string, lo convertimos en array

        */
        if (is_string($categorias)) {
            $categorias = [$categorias];
        }

        $db = (new DBConexionStatic)->getConexion();
        /* La siguiente consulta hace lo siguiente:
         * 1. Se seleccionan todos los productos de la tabla productos.
         * 2. Se seleccionan las franquicias de la tabla franquicias.
         * 3. se selecciona las categorias de la tabla categorias.
         */
        /* el placeholders siguierte es para rellenar los valores de las categorias que se van a buscar */
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

    /**
     * Obtiene los últimos 4 productos que se hayan ingresado en el último mes.
     *
     * @return array Devuelve un array de objetos Producto.
     */
    public static function obtenerUltimosDelMes(): array
    {
        $db = (new DBConexionStatic)->getConexion();
        /* La siguiente consulta hace lo siguiente:
        * 1. Se seleccionan los productos de la tabla productos.
         * 4. Se ordenan por fecha de ingreso.
         * 5. Se limitan a 4 resultados.
         * 6. Se ordenan por fecha de ingreso descendente.
         * */
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

    /**
     * Crea un nuevo producto en la base de datos.
     *
     * @param array $data Los datos del producto.
     *
     * @return void
     *
     * @throws PDOException Si se produce un error al insertar el producto.
     */

    public function crear(array $data): void
    {
        $db = (new DBConexionStatic)->getConexion();

        /* La siguiente consulta hace lo siguiente:
         * 1. Insertar producto en la tabla productos.
         * */
        $consulta = "INSERT INTO productos 
        (usuario_fk, fecha_ingreso, titulo, franquicia_fk, descripcion, precio, imagen, imagen_descripcion, caracteristicas)
        VALUES (:usuario_fk, NOW(), :titulo, :franquicia_fk, :descripcion, :precio, :imagen, :imagen_descripcion, :caracteristicas)";

        $stmt = $db->prepare($consulta);
        $stmt->execute([
            'usuario_fk' => $data['usuario_fk'],
            'titulo' => $data['titulo'],
            'franquicia_fk' => $data['franquicia_fk'],
            'descripcion' => $data['descripcion'],
            'precio' => $data['precio'],
            'imagen' => $data['imagen'],
            'imagen_descripcion' => $data['imagen_descripcion'],
            'caracteristicas' => $data['caracteristicas'],
        ]);
        $producto_id = $db->lastInsertId();

        /*Se valida que la categoria no este vacia, si esta vacia no se hace nada
         * */
        if (!empty($data['categorias']) && is_array($data['categorias'])) {
            /* La siguiente consulta hace lo siguiente:
             * 1. Insertar producto en la tabla productos_tienen_categorias.
             * 2. Seleccionar el ID del producto insertado.
             */
            $consultaCategorias = "INSERT INTO productos_tienen_categorias (producto_fk, categoria_fk) 
                                   VALUES (:producto, :categoria)";
            $stmtCategoria = $db->prepare($consultaCategorias);
            /* Recorre el array de categorías enviado por POST e inserta 
             * las relaciones entre el producto y las categorías en la tabla productos_tienen_categorias
             */
            foreach ($data['categorias'] as $categoria_id) {
                $stmtCategoria->execute([
                    'producto' => $producto_id,
                    'categoria' => $categoria_id
                ]);
            }
        }
    }

    /** Actualiza los datos de un producto en la base de datos.
     *
     * @param int $id El ID del producto a actualizar.
     * @param array $data Los datos del producto.
     *
     * @return void
     *
     * @throws PDOException Si se produce un error al actualizar el producto.*
     */
    public function editar(int $id, array $data): void
    {
        $db = (new DBConexionStatic)->getConexion();
        /* La siguiente consulta hace lo siguiente:
         * 1. Actualizar producto en la tabla productos.
         */
        $consulta = "UPDATE productos
                    SET usuario_fk          = :usuario_fk,
                        titulo              = :titulo,
                        franquicia_fk       = :franquicia_fk,
                        descripcion         = :descripcion,
                        precio              = :precio,
                        imagen              = :imagen,
                        imagen_descripcion  = :imagen_descripcion,
                        caracteristicas     = :caracteristicas
                    WHERE producto_id = :producto_id";
        $stmt = $db->prepare($consulta);
        $stmt->execute([
            'usuario_fk' => $data['usuario_fk'],
            'titulo' => $data['titulo'],
            'franquicia_fk' => $data['franquicia_fk'],
            'descripcion' => $data['descripcion'],
            'precio' => $data['precio'],
            'imagen' => $data['imagen'],
            'imagen_descripcion' => $data['imagen_descripcion'],
            'caracteristicas' => $data['caracteristicas'],
            'producto_id' => $id,
        ]);
    }

    /**
     * Elimina un producto de la base de datos.
     *
     * @param int $id El ID del producto a eliminar.
     *
     * @return void
     *
     * @throws PDOException Si se produce un error al eliminar el producto.
     *
     */
    public function eliminar(int $id): void
    {
        $db = (new DBConexionStatic)->getConexion();
        $consulta = "DELETE FROM productos_tienen_categorias 
                     WHERE producto_fk = ?";
        $stmt = $db->prepare($consulta);
        $stmt->execute([$id]);

        $consulta = "DELETE FROM productos
                    WHERE producto_id = ?";
        $stmt = $db->prepare($consulta);
        $stmt->execute([$id]);
    }

    /**
     * Funcion que devuelve las categorias de un producto
     *
     * @return array Devuelve un array con los IDs de las categorias del producto
     *
     */

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
