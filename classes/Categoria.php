<?php
require_once 'DBConexion.php';

class Categoria
{
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
    public function agregar(string $nombre): void
    {
        $stmt = $this->db->prepare("INSERT INTO categorias (nombre_categoria) VALUES (:nombre)");
        $stmt->execute(['nombre' => $nombre]);
    }
}
