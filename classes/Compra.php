<?php

class Compra
{
  private int $compra_id = 0;
  private int $usuario_fk = 0;
  private string $titulo = "";
  private string $fecha = "";
  private float $total_compra = 0;
  private float $precio_unitario = 0;
  private int $cantidad = 0;
  private float $subtotal = 0;

  public function __construct(?array $data = null)
  {
    if ($data) {
      $this->cargarDatosDeArray($data);
    }
  }

  public function cargarDatosDeArray(array $data)
  {
    $this->setCompraId($data['compra_id'] ?? 0);
    $this->setUsuarioFk($data['usuario_fk'] ?? 0);
    $this->setFecha($data['fecha'] ?? '');
    $this->setTotalCompra($data['total_compra'] ?? 0);
    $this->setPrecioUnitario($data['precio_unitario'] ?? 0);
    $this->setCantidad($data['cantidad'] ?? 0);
    $this->setSubtotal($data['subtotal'] ?? 0);
    $this->setTitulo($data['titulo'] ?? '');
  }

  public function registrarCompra(int $usuarioId, float $totalCompra): int
  {
    $db = DBConexionStatic::getConexion();
    $sql = "INSERT INTO compras (usuario_fk, fecha, total_compra) 
            VALUES (:usuario_id, NOW(), :total)";
    $stmt = $db->prepare($sql);
    $stmt->execute([
      ':usuario_id' => $usuarioId,
      ':total' => $totalCompra
    ]);
    return (int)$db->lastInsertId();
  }

  public function registrarProductosCompra(int $compraId, array $items): void
  {
    $db = DBConexionStatic::getConexion();
    $sql = "INSERT INTO compras_tienen_productos 
                (producto_fk, compra_fk, cantidad, precio_unitario, subtotal)
            VALUES 
                (:producto_fk, :compra_fk, :cantidad, :precio_unitario, :subtotal)";
    $stmt = $db->prepare($sql);

    foreach ($items as $item) {
      $stmt->execute([
        ':producto_fk'     => $item['producto_id'],
        ':compra_fk'       => $compraId,
        ':cantidad'        => $item['cantidad'],
        ':precio_unitario' => $item['precio_unitario'],
        ':subtotal'        => $item['precio_unitario'] * $item['cantidad']
      ]);
    }
  }


  public function traerCompras(int $usuarioId): ?array
  {
    $db = DBConexionStatic::getConexion();
    $consulta = "SELECT * FROM compras WHERE usuario_fk = :usuario_id";
    $stmt = $db->prepare($consulta);
    $stmt->execute([':usuario_id' => $usuarioId]);
    return $stmt->fetchAll(PDO::FETCH_CLASS, self::class);
  }

  public function traerDetalleCompras(int $compra_id): ?array
  {
    $db = DBConexionStatic::getConexion();
    $consulta = "SELECT 
                cp.*,
                p.titulo
             FROM compras_tienen_productos cp
             JOIN productos p ON cp.producto_fk = p.producto_id
             WHERE cp.compra_fk = :compra_id";

    $stmt = $db->prepare($consulta);
    $stmt->execute([':compra_id' => $compra_id]);
    return $stmt->fetchAll(PDO::FETCH_CLASS, self::class) ?: null;
  }

  public function getCompraId(): int
  {
    return $this->compra_id;
  }

  public function setCompraId(int $compra_id): void
  {
    $this->compra_id = $compra_id;
  }


  public function getUsuarioFk(): int
  {
    return $this->usuario_fk;
  }

  public function setUsuarioFk(int $usuario_fk): void
  {
    $this->usuario_fk = $usuario_fk;
  }

  public function getTitulo(): string
  {
    return $this->titulo;
  }

  public function setTitulo(string $titulo): void
  {
    $this->titulo = $titulo;
  }

  public function getFecha(): string
  {
    return $this->fecha;
  }

  public function setFecha(string $fecha): void
  {
    $this->fecha = $fecha;
  }

  public function getTotalCompra(): float
  {
    return $this->total_compra;
  }

  public function setTotalCompra(float $total_compra): void
  {
    $this->total_compra = $total_compra;
  }

  public function getPrecioUnitario(): float
  {
    return $this->precio_unitario;
  }

  public function setPrecioUnitario(float $precio_unitario): void
  {
    $this->precio_unitario = $precio_unitario;
  }

  public function getCantidad(): int
  {
    return $this->cantidad;
  }

  public function setCantidad(int $cantidad): void
  {
    $this->cantidad = $cantidad;
  }

  public function getSubtotal(): float
  {
    return $this->subtotal;
  }

  public function setSubtotal(float $subtotal): void
  {
    $this->subtotal = $subtotal;
  }
}
