<?php
require_once __DIR__ . '/DBConexion.php';

class Usuario
{
    private int $usuario_id = 0;
    private int $rol_fk = 0;
    private string $email = "";
    private string $contrasena = "";
    private string $nombre = "";
    private string $apellido = "";
    private ?string $avatar = "";

    /**
     * Carga los datos de un usuario desde un array asociativo.
     *
     * @param array $data Array asociativo con los datos del usuario.
     *
     * @return void no devuelve nada
     */
    public function cargarDatosArray(array $data): void
    {
        $this->usuario_id           = $data['usuario_id'];
        $this->email                = $data['email'];
        $this->contrasena           = $data['contrasena'];
        $this->nombre               = $data['nombre'];
        $this->apellido             = $data['apellido'];
        $this->avatar               = $data['avatar'];
    }

    /**
     * Recupera y devuelve todos los usuarios desde un archivo JSON.
     * @return self[] Lista de objetos Usuario que representan todos los usuarios disponibles.
     */
    public function todosUsuarios(): array
    {
        // Vamos a traer los usuarios de la base de datos.
        $db = (new DBConexion)->getConexion();

        $consulta = "SELECT * FROM usuarios";
        $stmt = $db->prepare($consulta);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, self::class);

        return $stmt->fetchAll();
    }

    /**
     * Busca y devuelve un usuario específico por su ID.
     *
     * @param int $id El ID del usuario a buscar.
     *
     * @return self|null Devuelve una instancia de Usuario si el ID coincide, o null si no se encuentra.
     */

    public function porId(int $id): ?self
    {
        // Traemos el usuario desde la base de datos.
        $db = (new DBConexion)->getConexion();
        $consulta = "SELECT * FROM usuarios
                    WHERE usuario_id = ?";

        $stmt = $db->prepare($consulta);
        $stmt->execute([$id]);

        $stmt->setFetchMode(PDO::FETCH_CLASS, self::class);

        $usuario = $stmt->fetch();

        if (!$usuario) return null;

        return $usuario;
    }


    public function getUsuarioId(): int
    {
        return $this->usuario_id;
    }

    public function setUsuarioId(int $usuario_id): void
    {
        $this->usuario_id = $usuario_id;
    }

    public function getRolFk(): int
    {
        return $this->rol_fk;
    }

    public function setRolFk(int $rol_fk): void
    {
        $this->rol_fk = $rol_fk;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setFechaIngreso(string $email): void
    {
        $this->email = $email;
    }

    public function getContrasena(): string
    {
        return $this->contrasena;
    }

    public function setContrasena(string $contrasena): void
    {
        $this->contrasena = $contrasena;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    public function getApellido(): string
    {
        return $this->apellido;
    }

    public function setApellido(string $apellido): void
    {
        $this->apellido = $apellido;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(?string $avatar): void
    {
        $this->avatar = $avatar;
    }
}
