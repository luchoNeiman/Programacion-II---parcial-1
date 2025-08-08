<?php

class Carrito
{
  // === Propiedades privadas ===
  // Datos de un ítem del carrito
  private int $producto_id = 0;
  private string $titulo = '';
  private string $imagen = '';
  private float $precio_unitario = 0.0;
  private int $cantidad = 0;

  // ID de la compra (solo si se usa en el detalle de una compra finalizada)
  private int $compra_id = 0;

  /**
   * Constructor opcionalmente recibe un array con datos para hidratar el objeto.
   */
  public function __construct(?array $data = null)
  {
    if ($data) {
      $this->cargarDatosDeArray($data);
    }
  }

  /**
   * Carga datos del carrito desde un array asociativo.
   */
  public function cargarDatosDeArray(array $data): void
  {
    $this->setProductoId((int)($data['producto_id'] ?? 0));
    $this->setTitulo((string)($data['titulo'] ?? ''));
    $this->setImagen((string)($data['imagen'] ?? ''));
    $this->setPrecioUnitario((float)($data['precio_unitario'] ?? $data['precio'] ?? 0));
    $this->setCantidad((int)($data['cantidad'] ?? 0));
    $this->setCompraId((int)($data['compra_id'] ?? 0));
  }

  // ==========================
  // Métodos de lectura (consultas a DB)
  // ==========================

  /**
   * Obtiene todos los productos del carrito para un usuario.
   * @return Carrito[]
   */
  public function getItems(int $usuarioId): array
  {
    $db = DBConexionStatic::getConexion();

    $sql = "
      SELECT 
          p.producto_id,
          p.titulo,
          p.imagen,
          p.precio AS precio_unitario,
          c.cantidad
      FROM carrito c
      INNER JOIN productos p ON p.producto_id = c.producto_fk
      WHERE c.usuario_fk = :usuarioId
      ORDER BY p.titulo ASC
    ";
    $st = $db->prepare($sql);
    $st->execute([':usuarioId' => $usuarioId]);
    $rows = $st->fetchAll(PDO::FETCH_ASSOC);

    // Convierte cada fila en un objeto Carrito
    return array_map(fn($r) => new self($r), $rows);
  }

  /**
   * Calcula el total del carrito para un usuario.
   */
  public function calcularTotalCarrito(int $usuarioId): float
  {
    $db = DBConexionStatic::getConexion();

    $st = $db->prepare("
      SELECT SUM(p.precio * c.cantidad) AS total
      FROM carrito c
      INNER JOIN productos p ON p.producto_id = c.producto_fk
      WHERE c.usuario_fk = :usuarioId
    ");
    $st->execute([':usuarioId' => $usuarioId]);
    return (float)($st->fetchColumn() ?: 0);
  }

  /**
   * Devuelve el total de unidades en el carrito (suma de cantidades).
   */
  public function getTotalItems(int $usuarioId): int
  {
    $db = DBConexionStatic::getConexion();

    $st = $db->prepare("
      SELECT COALESCE(SUM(cantidad),0) 
      FROM carrito
      WHERE usuario_fk = :usuarioId
    ");
    $st->execute([':usuarioId' => $usuarioId]);
    return (int)($st->fetchColumn() ?: 0);
  }

  /**
   * Devuelve el detalle de una compra finalizada.
   * Valida que la compra pertenezca al usuario.
   * @return Carrito[]
   */
  public function getCompraDetalle(int $compraId, int $usuarioId): array
  {
    $db = DBConexionStatic::getConexion();

    // Verifica que la compra sea del usuario
    $check = $db->prepare("
      SELECT 1 FROM compras 
      WHERE compra_id = :cid AND usuario_fk = :uid LIMIT 1
    ");
    $check->execute([':cid' => $compraId, ':uid' => $usuarioId]);
    if (!$check->fetchColumn()) return [];

    // Si la compra es válida, trae el detalle
    $st = $db->prepare("
      SELECT 
          ct.compra_fk AS compra_id,
          p.producto_id,
          p.titulo,
          p.imagen,
          p.precio AS precio_unitario,
          ct.cantidad
      FROM compras_tienen_productos ct
      INNER JOIN productos p ON p.producto_id = ct.producto_fk
      WHERE ct.compra_fk = :cid
      ORDER BY p.titulo ASC
    ");
    $st->execute([':cid' => $compraId]);
    $rows = $st->fetchAll(PDO::FETCH_ASSOC);

    return array_map(fn($r) => new self($r), $rows);
  }

  // ==========================
  // Métodos de mutación (modifican DB)
  // ==========================

  /**
   * Agrega un producto al carrito, o aumenta cantidad si ya existe.
   */
  public function agregarProducto(int $usuarioId, int $productoId, int $cantidad = 1): bool
  {
    if ($cantidad < 1) $cantidad = 1;
    $db = DBConexionStatic::getConexion();

    // Intenta actualizar si ya existe
    $upd = $db->prepare("
      UPDATE carrito
         SET cantidad = cantidad + :cantidad
       WHERE usuario_fk = :uid AND producto_fk = :pid
    ");
    $upd->execute([':cantidad' => $cantidad, ':uid' => $usuarioId, ':pid' => $productoId]);

    if ($upd->rowCount() > 0) return true;

    // Si no existe, lo inserta
    $ins = $db->prepare("
      INSERT INTO carrito (usuario_fk, producto_fk, cantidad)
      VALUES (:uid, :pid, :cantidad)
    ");
    return $ins->execute([':uid' => $usuarioId, ':pid' => $productoId, ':cantidad' => $cantidad]);
  }

  /**
   * Suma una unidad al producto del carrito.
   */
  public function sumar(int $usuarioId, int $productoId): bool
  {
    $db = DBConexionStatic::getConexion();

    $st = $db->prepare("
      UPDATE carrito SET cantidad = cantidad + 1
      WHERE usuario_fk = :uid AND producto_fk = :pid
    ");
    $st->execute([':uid' => $usuarioId, ':pid' => $productoId]);
    return $st->rowCount() > 0;
  }

  /**
   * Resta una unidad al producto, o lo elimina si queda en 0.
   */
  public function restar(int $usuarioId, int $productoId): bool
  {
    $db = DBConexionStatic::getConexion();

    $db->beginTransaction();
    try {
      // Bloquea la fila para evitar problemas de concurrencia
      $q = $db->prepare("
        SELECT cantidad FROM carrito
        WHERE usuario_fk = :uid AND producto_fk = :pid
        FOR UPDATE
      ");
      $q->execute([':uid' => $usuarioId, ':pid' => $productoId]);
      $cant = $q->fetchColumn();
      if ($cant === false) {
        $db->rollBack();
        return false;
      }

      $cant = (int)$cant - 1;
      if ($cant <= 0) {
        // Elimina si no quedan unidades
        $del = $db->prepare("
          DELETE FROM carrito WHERE usuario_fk = :uid AND producto_fk = :pid
        ");
        $del->execute([':uid' => $usuarioId, ':pid' => $productoId]);
      } else {
        // Actualiza la cantidad
        $upd = $db->prepare("
          UPDATE carrito SET cantidad = :c
          WHERE usuario_fk = :uid AND producto_fk = :pid
        ");
        $upd->execute([':c' => $cant, ':uid' => $usuarioId, ':pid' => $productoId]);
      }
      $db->commit();
      return true;
    } catch (Throwable $e) {
      if ($db->inTransaction()) $db->rollBack();
      return false;
    }
  }

  /**
   * Elimina un producto del carrito.
   */
  public function eliminarProducto(int $usuarioId, int $productoId): bool
  {
    $db = DBConexionStatic::getConexion();

    $st = $db->prepare("
      DELETE FROM carrito
      WHERE usuario_fk = :uid AND producto_fk = :pid
    ");
    $st->execute([':uid' => $usuarioId, ':pid' => $productoId]);
    return $st->rowCount() > 0;
  }

  /**
   * Vacía todo el carrito del usuario.
   */
  public function vaciar(int $usuarioId): bool
  {
    $db = DBConexionStatic::getConexion();

    $st = $db->prepare("DELETE FROM carrito WHERE usuario_fk = :uid");
    $st->execute([':uid' => $usuarioId]);
    return true;
  }

  /**
   * Calcula el subtotal de un ítem (precio * cantidad).
   */
  public function calcularSubtotal(): float
  {
    return $this->precio_unitario * $this->cantidad;
  }

  /**
   * Calcula el total de todos los ítems del carrito para un usuario.
   */
  public function calcularTotal($usuarioId): float
  {
    $subtotal = 0;
    foreach ($this->getItems($usuarioId) as $item) {
      $subtotal += $item->calcularSubtotal();
    }
    return $subtotal;
  }

  // ===== Getters =====
  public function getProductoId(): int
  {
    return $this->producto_id;
  }

  public function getTitulo(): string
  {
    return $this->titulo;
  }

  public function getImagen(): string
  {
    return $this->imagen;
  }

  public function getPrecioUnitario(): float
  {
    return $this->precio_unitario;
  }

  public function getCantidad(): int
  {
    return $this->cantidad;
  }

  public function getCompraId(): int
  {
    return $this->compra_id;
  }

  // ===== Setters =====
  public function setProductoId(int $id): void
  {
    $this->producto_id = $id;
  }

  public function setTitulo(string $t): void
  {
    $this->titulo = $t;
  }

  public function setImagen(string $i): void
  {
    $this->imagen = $i;
  }

  public function setPrecioUnitario(float $p): void
  {
    $this->precio_unitario = $p;
  }

  public function setCantidad(int $c): void
  {
    $this->cantidad = $c;
  }

  public function setCompraId(int $c): void
  {
    $this->compra_id = $c;
  }
}
