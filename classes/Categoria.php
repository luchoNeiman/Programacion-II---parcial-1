<?php
//require_once 'DBConexion.php';

class Categoria
{
    private int $producto_id = 0;
    private int $categoria_fk = 0;
    private string $nombre_categoria = '';
    private PDO $db;

    public function __construct()
    {
        $this->db = (new DBConexion())->getConexion(); // ⬅️ ESTA LÍNEA ES CLAVE
    }

    // Traer todas las categorías
    public function todasCategorias(): array
    {
        $consulta = "SELECT categoria_id, nombre_categoria FROM categorias ORDER BY nombre_categoria ASC";
        $stmt = $this->db->prepare($consulta);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Agregar nueva categoría
    public function agregar(string $nombre): int
    {
        $stmt = $this->db->prepare("INSERT INTO categorias (nombre_categoria) VALUES (:nombre)");
        $stmt->execute(['nombre' => $nombre]);
        return $this->db->lastInsertId();
    }
    public function getCategoriasProductosIds(int $producto_id): array
    {
        $db = (new DBConexion)->getConexion();
        $stmt = $db->prepare("SELECT categoria_fk FROM productos_tienen_categorias WHERE producto_fk = ?");
        $stmt->execute([$producto_id]);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
    public function setCategoriasProducto(int $producto_id, array $categorias_ids): void
    {
        $db = (new DBConexion)->getConexion();

        // Primero eliminamos las categorías actuales del producto
        $stmt = $db->prepare("DELETE FROM productos_tienen_categorias WHERE producto_fk = ?");
        $stmt->execute([$producto_id]);

        // Ahora insertamos las nuevas
        $stmt = $db->prepare("INSERT INTO productos_tienen_categorias (producto_fk, categoria_fk) VALUES (?, ?)");

        foreach ($categorias_ids as $categoria_id) {
            $stmt->execute([$producto_id, $categoria_id]);
        }
    }


}
