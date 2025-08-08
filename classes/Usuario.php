<?php

class Usuario
{
  // ==== Propiedades privadas ====
  private int $usuario_id = 0;
  private int $rol_fk = 0;
  private string $email = "";
  private string $password = "";
  private ?string $nombre = null;
  private ?string $apellido = null;
  private ?string $avatar = null;

  // ==== Constantes de roles ====
  public const ROL_ADMIN = 1;      // Rol administrador
  public const ROL_USUARIO = 2;    // Rol usuario normal

  /**
   * Constructor: permite inicializar el objeto con datos opcionales.
   */
  public function __construct(?array $data = null)
  {
    if ($data) {
      $this->cargarDatosDeArray($data);
    }
  }

  /**
   * Carga datos desde un array asociativo a las propiedades del objeto.
   */
  public function cargarDatosDeArray(array $data)
  {
    $this->setUsuarioId($data['usuario_id'] ?? 0);
    $this->setRolFk($data['rol_fk'] ?? 0);
    $this->setEmail($data['email'] ?? '');
    $this->setPassword($data['password'] ?? '');
    $this->setNombre($data['nombre'] ?? null);
    $this->setApellido($data['apellido'] ?? null);
    $this->setAvatar($data['avatar'] ?? null);
  }

  /**
   * Busca un usuario por su ID en la base de datos.
   * @return Usuario|null Devuelve el objeto usuario o null si no existe.
   */
  public function porId(int $id): ?self
  {
    $db = (new DBConexionStatic)->getConexion();
    $consulta = "SELECT * FROM usuarios WHERE usuario_id = ?";
    $stmt = $db->prepare($consulta);
    $stmt->execute([$id]);
    $stmt->setFetchMode(PDO::FETCH_CLASS, self::class);
    $usuario = $stmt->fetch();

    return $usuario ?: null;
  }

  /**
   * Busca un usuario por su email.
   * @return Usuario|null Devuelve el objeto usuario o null si no existe.
   */
  public function porEmail(string $email): ?self
  {
    $db = DBConexionStatic::getConexion();
    $consulta = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $db->prepare($consulta);
    $stmt->execute([$email]);
    $stmt->setFetchMode(PDO::FETCH_CLASS, self::class);
    $usuario = $stmt->fetch();

    return $usuario ?: null;
  }

  /**
   * Crea un nuevo usuario en la base de datos.
   */
  public function crear(array $data): void
  {
    $db = DBConexionStatic::getConexion();
    $consulta = "INSERT INTO usuarios (nombre, apellido, email, password, rol_fk)
                    VALUES (:nombre, :apellido, :email, :password, :rol_fk)";
    $stmt = $db->prepare($consulta);
    $stmt->execute([
      'nombre' => $data['nombre'],
      'apellido' => $data['apellido'],
      'email' => $data['email'],
      'password' => $data['password'], // Se asume que viene ya encriptada
      'rol_fk' => $data['rol_fk'],
    ]);
  }

  /**
   * Verifica si un email ya está registrado.
   */
  public function existeEmail(string $email): bool
  {
    $db = DBConexionStatic::getConexion();
    $consulta = "SELECT COUNT(*) FROM usuarios WHERE email = ?";
    $stmt = $db->prepare($consulta);
    $stmt->execute([$email]);
    return $stmt->fetchColumn() > 0;
  }

  /**
   * Trae todas las compras realizadas por este usuario.
   */
  public function traerCompras(): ?array
  {
    $db = DBConexionStatic::getConexion();
    $consulta = "SELECT * FROM compras WHERE usuario_fk = ?";
    $stmt = $db->prepare($consulta);
    $stmt->execute([$this->getUsuarioId()]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: null;
  }

  /**
   * Trae el detalle de una compra específica de este usuario.
   */
  public function traerDetalleCompras(int $compra_id): ?array
  {
    $db = DBConexionStatic::getConexion();
    $consulta = "SELECT 
                cp.*,
                p.nombre AS producto_nombre
             FROM compras_tienen_productos cp
             JOIN productos p ON cp.producto_fk = p.producto_id
             WHERE cp.compra_fk = :compra_id";

    $stmt = $db->prepare($consulta);
    $stmt->execute([':compra_id' => $compra_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: null;
  }

  /**
   * Actualiza el avatar del usuario en la base de datos y en el objeto.
   */
  public function actualizarAvatar(string $nombreArchivo): void
  {
    $db = (new DBConexionStatic)->getConexion();
    $consulta = "UPDATE usuarios SET avatar = ? WHERE usuario_id = ?";
    $stmt = $db->prepare($consulta);
    $stmt->execute([$nombreArchivo, $this->getUsuarioId()]);
    $this->setAvatar($nombreArchivo);
  }

  /**
   * Devuelve todos los usuarios de la base de datos.
   */
  public function traerUsuarios(): array
  {
    $db = DBConexionStatic::getConexion();
    $consulta = "SELECT * FROM usuarios ORDER BY usuario_id DESC";
    $stmt = $db->query($consulta);
    $stmt->setFetchMode(PDO::FETCH_CLASS, self::class);
    return $stmt->fetchAll();
  }

  /**
   * Verifica si el usuario tiene rol de administrador.
   */
  public function esAdmin(): bool
  {
    return $this->getRolFk() === self::ROL_ADMIN;
  }

  // ==== Getters y Setters ====
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
