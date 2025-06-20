<?php
//require_once 'DBConexion.php';

class Franquicia
{
    private PDO $db;

    public function __construct()
    {
        $this->db = (new DBConexion())->getConexion();
    }

    // Traer todas las franquicias
    public function todasFranquicias(): array
    {
        $consulta = "SELECT franquicia_id, nombre_franquicia FROM franquicias ORDER BY nombre_franquicia ASC;
";
        $stmt = $this->db->prepare($consulta);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Agregar nueva franquicia
    public function agregar(string $nombre): int
    {
        $stmt = $this->db->prepare("INSERT INTO franquicias (nombre_franquicia) VALUES (:nombre)");
        $stmt->execute(['nombre' => $nombre]);
        return $this->db->lastInsertId();
    }
}
