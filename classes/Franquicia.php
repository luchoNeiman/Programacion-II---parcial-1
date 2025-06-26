<?php
//require_once 'DBConexion.php';

class Franquicia
{
    private int $franquicia_id = 0;
    private string $nombre_franquicia = "";


    /**
     * Obtiene todas las franquicias almacenadas en la base de datos.
     *
     * Realiza una consulta para traer los IDs y nombres de todas las franquicias,
     * ordenadas alfabéticamente por su nombre.
     *
     * @return array Array asociativo con los datos de las franquicias.
     */

    public function todasFranquicias(): array
    {
        $db = (new DBConexion)->getConexion();
        $consulta = "SELECT franquicia_id, nombre_franquicia FROM franquicias ORDER BY nombre_franquicia ASC;";
        $stmt = $db->prepare($consulta);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Agrega una nueva franquicia si no existe y retorna su ID.
     *
     * Primero verifica si ya existe una franquicia con el nombre indicado.
     * - Si existe, retorna el ID de la franquicia ya registrada.
     * - Si no existe, la inserta en la base de datos y retorna el ID generado.
     *
     * @param string $nombre Nombre de la franquicia a agregar.
     * @return int ID de la franquicia existente o nueva.
     */
    public function agregar(string $nombre): int
    {
        $db = (new DBConexion)->getConexion();

        // Verifico si ya existe una franquicia con ese nombre
        $stmt = $db->prepare("SELECT franquicia_id FROM franquicias WHERE LOWER(nombre_franquicia) = LOWER(:nombre)");
        $stmt->execute(['nombre' => $nombre]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        // si existe, devulvo el ID
        if ($resultado) {
            return $resultado['franquicia_id'];
        }

        // Si no existe, la agrego
        $stmt = $db->prepare("INSERT INTO franquicias (nombre_franquicia) VALUES (:nombre)");
        $stmt->execute(['nombre' => $nombre]);

        return $db->lastInsertId();
    }

    public function getFranquiciaId(): int
    {
        return $this->franquicia_id;
    }

    public function setFranquiciaId(int $franquicia_id): void
    {
        $this->franquicia_id = $franquicia_id;
    }

    public function getNombreFranquicia(): string
    {
        return $this->nombre_franquicia;
    }

    public function setNombreFranquicia(string $nombre_franquicia): void
    {
        $this->nombre_franquicia = $nombre_franquicia;
    }


}
