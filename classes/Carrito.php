<?php

class Carrito {
  private $db;

  public function __construct() {
    $this->db = DBConexionStatic::getConexion();
  }

  // Trae todos los productos del carrito de un usuario
  public function getItems($usuarioId) {
    $sql = "SELECT 
                    p.producto_id,
                    p.titulo,
                    p.imagen,
                    p.precio AS precio_unitario,
                    c.cantidad
                FROM carrito c
                JOIN productos p ON c.producto_fk = p.producto_id
                WHERE c.usuario_fk = :usuario_id";
    $stmt = $this->db->prepare($sql);
    $stmt->execute([':usuario_id' => $usuarioId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Calcula el total del carrito de un usuario
  public function calcularTotal($usuarioId) {
    $items = $this->getItems($usuarioId);
    $total = 0;
    foreach ($items as $item) {
      $total += $item['precio_unitario'] * $item['cantidad'];
    }
    return $total;
  }

  // Agrega producto al carrito (si ya está, suma cantidad)
  public function agregarProducto($usuarioId, $productoId, $cantidad = 1) {
    // Chequear si ya existe
    $sql = "SELECT cantidad FROM carrito WHERE usuario_fk = :usuario_id AND producto_fk = :producto_id";
    $stmt = $this->db->prepare($sql);
    $stmt->execute([':usuario_id' => $usuarioId, ':producto_id' => $productoId]);
    $actual = $stmt->fetchColumn();

    if ($actual !== false) {
      // Ya existe, actualizá la cantidad
      $sql = "UPDATE carrito SET cantidad = cantidad + :cantidad WHERE usuario_fk = :usuario_id AND producto_fk = :producto_id";
      $stmt = $this->db->prepare($sql);
      $stmt->execute([
        ':cantidad' => $cantidad,
        ':usuario_id' => $usuarioId,
        ':producto_id' => $productoId
      ]);
    } else {
      // No existe, insertá
      $sql = "INSERT INTO carrito (usuario_fk, producto_fk, cantidad) VALUES (:usuario_id, :producto_id, :cantidad)";
      $stmt = $this->db->prepare($sql);
      $stmt->execute([
        ':usuario_id' => $usuarioId,
        ':producto_id' => $productoId,
        ':cantidad' => $cantidad
      ]);
    }
  }

  // Suma uno a un producto (igual que agregarProducto con cantidad 1)
  public function sumar($usuarioId, $productoId) {
    $this->agregarProducto($usuarioId, $productoId, 1);
  }

  // Resta uno, si queda 0 elimina
  public function restar($usuarioId, $productoId) {
    $sql = "SELECT cantidad FROM carrito WHERE usuario_fk = :usuario_id AND producto_fk = :producto_id";
    $stmt = $this->db->prepare($sql);
    $stmt->execute([':usuario_id' => $usuarioId, ':producto_id' => $productoId]);
    $actual = $stmt->fetchColumn();

    if ($actual !== false) {
      if ($actual > 1) {
        $sql = "UPDATE carrito SET cantidad = cantidad - 1 WHERE usuario_fk = :usuario_id AND producto_fk = :producto_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
          ':usuario_id' => $usuarioId,
          ':producto_id' => $productoId
        ]);
      } else {
        // Si queda 0, eliminar
        $this->eliminarProducto($usuarioId, $productoId);
      }
    }
  }

  // Elimina un producto del carrito
  public function eliminarProducto($usuarioId, $productoId) {
    $sql = "DELETE FROM carrito WHERE usuario_fk = :usuario_id AND producto_fk = :producto_id";
    $stmt = $this->db->prepare($sql);
    $stmt->execute([
      ':usuario_id' => $usuarioId,
      ':producto_id' => $productoId
    ]);
  }

  // Vacía el carrito del usuario
  public function vaciar($usuarioId) {
    $sql = "DELETE FROM carrito WHERE usuario_fk = :usuario_id";
    $stmt = $this->db->prepare($sql);
    $stmt->execute([':usuario_id' => $usuarioId]);
  }
  public function getTotalItems($usuarioId) {
    $sql = "SELECT SUM(cantidad) FROM carrito WHERE usuario_fk = :usuario_id";
    $stmt = $this->db->prepare($sql);
    $stmt->execute([':usuario_id' => $usuarioId]);
    return (int) $stmt->fetchColumn();
  }
  public function getCompraDetalle($compraId, $usuarioId) {
    $db = DBConexionStatic::getConexion();

    // Trae la compra (verifica que sea del usuario)
    $sql = "SELECT * FROM compras WHERE compra_id = :id AND usuario_fk = :usuario_id";
    $stmt = $db->prepare($sql);
    $stmt->execute([':id' => $compraId, ':usuario_id' => $usuarioId]);
    $compraRaw = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$compraRaw) {
      return null;
    }

    // Trae los productos de esa compra
    $sqlProd = "SELECT p.titulo, p.imagen, ctp.cantidad, ctp.precio_unitario
                FROM compras_tienen_productos ctp
                JOIN productos p ON ctp.producto_fk = p.producto_id
                WHERE ctp.compra_fk = :id";
    $stmtProd = $db->prepare($sqlProd);
    $stmtProd->execute([':id' => $compraId]);
    $productos = $stmtProd->fetchAll(PDO::FETCH_ASSOC);

    // Devuelve en formato consistente
    return [
      'compra' => $compraRaw,
      'productos' => $productos
    ];
  }


}
