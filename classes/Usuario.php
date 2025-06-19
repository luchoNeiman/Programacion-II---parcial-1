<?php
//require_once __DIR__ . '/DBConexion.php';

class Usuario
{
    private int $usuario_id = 0;
    private int $rol_fk = 0;
    private string $email = "";
    private string $password = "";
    private ?string $nombre = null;
    private ?string $apellido = null;
    private ?string $avatar = null;


    public function porEmail(string $email): ?self
    {
        $db = (new DBConexion)->getConexion();
        $consulta = "SELECT * FROM usuarios
                    WHERE email = ?";

        $stmt = $db->prepare($consulta);
        $stmt->execute([$email]);
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

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
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
