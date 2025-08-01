<?php

class Usuario
{
    private int $usuario_id = 0;
    private int $rol_fk = 0;
    private string $email = "";
    private string $password = "";
    private ?string $nombre = null;
    private ?string $apellido = null;
    private ?string $avatar = null;

    public const ROL_ADMIN = 1;
    public const ROL_USUARIO = 2;

    // public function __construct(?array $data = null)
    // {
    //     if($data) {
    //         $this->cargarDatosDeArray($data);
    //     }
    // }

    // public function cargarDatosDeArray(array $data) 
    // {
    //     $this->setUsuarioId($data['estado_publicacion_id'] ?? 0);
    //     $this->setRolFk($data['rol_fk'] ?? 0);
    //     $this->setEmail($data['email'] ?? '');
    //     $this->setPassword($data['password'] ?? '');
    //     $this->setNombre($data['nombre'] ?? null);
    //     $this->setApellido($data['apellido'] ?? null);
    //     $this->setImagen($data['imagen'] ?? null);
    // }

    /**
     * Busca un usuario por su dirección de email en la base de datos
     *
     * @param string $email El email del usuario a buscar
     * @return Usuario|null El usuario encontrado o null si no existe
     */
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

    /**
     * Busca un usuario por su ID en la base de datos
     *
     * @param int $id El ID del usuario a buscar
     * @return Usuario|null El usuario encontrado o null si no existe
     */
    public function porId(int $id): ?self
    {
        $db = (new DBConexion)->getConexion();
        $consulta = "SELECT * FROM usuarios WHERE usuario_id = ?";
        $stmt = $db->prepare($consulta);
        $stmt->execute([$id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, self::class);
        $usuario = $stmt->fetch();

        return $usuario ?: null;
    }

    public function crear(array $data): void
    {
        $db = DBConexionStatic::getConexion();
        $consulta = "INSERT INTO usuarios (email, password, rol_fk)
                    VALUES (:email, :password, :rol_fk)";
        $stmt = $db->prepare($consulta);
        $stmt->execute([
            'email'     => $data['email'],
            'password'  => $data['password'],
            'rol_fk'    => $data['rol_fk'],
        ]);
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

    public function setEmail(string $email): void
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

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    public function getApellido(): ?string
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
