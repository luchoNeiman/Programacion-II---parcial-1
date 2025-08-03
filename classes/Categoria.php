<?php
//require_once 'DBConexionStatic.php';

class Categoria
{
    private int $categoria_id = 0;
    private string $nombre_categoria = "";


    // Traer todas las categorías

    /**
     * Obtiene todas las categorías de la base de datos
     *
     * @return array Array asociativo con los datos de las categorías
     */
    public function todasCategorias(): array
    {
        $db = (new DBConexionStatic)->getConexion();
        $consulta = "SELECT categoria_id, nombre_categoria FROM categorias ORDER BY nombre_categoria ASC";
        $stmt = $db->prepare($consulta); // <--- CORREGIDO ACÁ
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt->fetchAll();
    }

    /**
     * Agrega una nueva categoría a la base de datos.
     *
     * Inserta el nombre de la categoría recibido como parámetro en la tabla 'categorias'
     * y retorna el ID generado para la nueva categoría.
     *
     * @param string $nombre Nombre de la categoría a agregar.
     * @return int ID de la nueva categoría insertada.
     */

    public function agregar(string $nombre): int
    {
        $db = (new DBConexionStatic)->getConexion();

        // Verificar si ya existe una categoría con ese nombre
        $stmt = $db->prepare("SELECT categoria_id FROM categorias WHERE LOWER(nombre_categoria) = LOWER(:nombre) LIMIT 1;");
        $stmt->execute(['nombre' => $nombre]);
        $consulta = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($consulta) {
            // Ya existe, devolver el ID existente
            return $consulta['categoria_id'];
        }

        // No existe, la insertamos
        $stmt = $db->prepare("INSERT INTO categorias (nombre_categoria) VALUES (:nombre)");
        $stmt->execute(['nombre' => $nombre]);

        return $db->lastInsertId();
    }

    /**
     * Obtiene los IDs de las categorías asociadas a un producto.
     *
     * Consulta la tabla 'productos_tienen_categorias' para obtener los IDs de las categorías
     * vinculadas al producto especificado por su ID.
     *
     * @param int $producto_id ID del producto.
     * @return array Lista de IDs de categorías asociadas al producto.
     */
    public function getCategoriasProductosIds(int $producto_id): array
    {
        $db = (new DBConexionStatic)->getConexion();
        $stmt = $db->prepare("SELECT categoria_fk FROM productos_tienen_categorias WHERE producto_fk = ?");
        $stmt->execute([$producto_id]);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    /**
     * Actualiza las categorías asociadas a un producto.
     *
     * Elimina todas las categorías actuales relacionadas con el producto y asigna
     * las nuevas categorías proporcionadas en el array.
     *
     * @param int $producto_id ID del producto a actualizar.
     * @param array $categorias_ids IDs de las categorías que se asociarán al producto.
     * @return void
     */
    public function setCategoriasProducto(int $producto_id, array $categorias_ids): void
    {
        $db = (new DBConexionStatic)->getConexion();

        // Primero eliminamos las categorías actuales del producto
        $stmt = $db->prepare("DELETE FROM productos_tienen_categorias WHERE producto_fk = ?");
        $stmt->execute([$producto_id]);

        // Ahora insertamos las nuevas
        $stmt = $db->prepare("INSERT INTO productos_tienen_categorias (producto_fk, categoria_fk) VALUES (?, ?)");

        foreach ($categorias_ids as $categoria_id) {
            $stmt->execute([$producto_id, $categoria_id]);
        }
    }

    public function getCategoriaId(): int
    {
        return $this->categoria_id;
    }

    public function setCategoriaId(int $categoria_id): void
    {
        $this->categoria_id = $categoria_id;
    }

    public function getNombreCategoria(): string
    {
        return $this->nombre_categoria;
    }

    public function setNombreCategoria(string $nombre_categoria): void
    {
        $this->nombre_categoria = $nombre_categoria;
    }


}
