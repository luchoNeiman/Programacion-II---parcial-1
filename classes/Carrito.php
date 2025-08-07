<?php

class Carrito
{

  // Trae todos los productos del carrito de un usuario
  public function getItems($usuarioId)
  {
    // Conecto a la base
    $db = DBConexionStatic::getConexion();

    // Armo la query para traer los productos del carrito con toda la info piola
    $sql = "SELECT 
                    p.producto_id,
                    p.titulo,
                    p.imagen,
                    p.precio AS precio_unitario,
                    c.cantidad
                FROM carrito c
                JOIN productos p ON c.producto_fk = p.producto_id
                WHERE c.usuario_fk = :usuario_id";
    // Preparo la consulta
    $stmt = $db->prepare($sql);
    // Ejecuto con el usuario actual
    $stmt->execute([':usuario_id' => $usuarioId]);
    // Devuelvo todo en un array
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Calcula el total del carrito de un usuario
  public function calcularTotal($usuarioId)
  {
    // Traigo todos los items primero
    $items = $this->getItems($usuarioId);
    $total = 0;
    // Sumo precio x cantidad de cada item
    foreach ($items as $item) {
      $total += $item['precio_unitario'] * $item['cantidad'];
    }
    // Devuelvo el total final
    return $total;
  }

  // Agrega producto al carrito (si ya está, suma cantidad)
  public function agregarProducto($usuarioId, $productoId, $cantidad = 1)
  {
    // Conecto a la base
    $db = DBConexionStatic::getConexion();
    // Veo si el producto ya existe en el carrito del usuario
    $sql = "SELECT cantidad FROM carrito WHERE usuario_fk = :usuario_id AND producto_fk = :producto_id";
    $stmt = $db->prepare($sql);
    $stmt->execute([':usuario_id' => $usuarioId, ':producto_id' => $productoId]);
    $actual = $stmt->fetchColumn();

    if ($actual !== false) {
      // Si ya existe, le sumo la cantidad nueva
      $sql = "UPDATE carrito SET cantidad = cantidad + :cantidad WHERE usuario_fk = :usuario_id AND producto_fk = :producto_id";
      $stmt = $db->prepare($sql);
      $stmt->execute([
        ':cantidad' => $cantidad,
        ':usuario_id' => $usuarioId,
        ':producto_id' => $productoId
      ]);
    } else {
      // Si no está, lo inserto como nuevo
      $sql = "INSERT INTO carrito (usuario_fk, producto_fk, cantidad) VALUES (:usuario_id, :producto_id, :cantidad)";
      $stmt = $db->prepare($sql);
      $stmt->execute([
        ':usuario_id' => $usuarioId,
        ':producto_id' => $productoId,
        ':cantidad' => $cantidad
      ]);
    }
  }

  // Suma uno a un producto (igual que agregarProducto con cantidad 1)
  public function sumar($usuarioId, $productoId)
  {
    // Llamo directo a agregarProducto con cantidad 1, pa' no repetir código
    $this->agregarProducto($usuarioId, $productoId, 1);
  }

  // Resta uno, si queda 0 elimina
  public function restar($usuarioId, $productoId)
  {
    $db = DBConexionStatic::getConexion();
    // Veo cuántos hay de ese producto en el carrito
    $sql = "SELECT cantidad FROM carrito WHERE usuario_fk = :usuario_id AND producto_fk = :producto_id";
    $stmt = $db->prepare($sql);
    $stmt->execute([':usuario_id' => $usuarioId, ':producto_id' => $productoId]);
    $actual = $stmt->fetchColumn();

    if ($actual !== false) {
      if ($actual > 1) {
        // Si hay más de uno, le resto uno
        $sql = "UPDATE carrito SET cantidad = cantidad - 1 WHERE usuario_fk = :usuario_id AND producto_fk = :producto_id";
        $stmt = $db->prepare($sql);
        $stmt->execute([
          ':usuario_id' => $usuarioId,
          ':producto_id' => $productoId
        ]);
      } else {
        // Si queda en cero, chau producto
        $this->eliminarProducto($usuarioId, $productoId);
      }
    }
  }

  // Elimina un producto del carrito
  public function eliminarProducto($usuarioId, $productoId)
  {
    $db = DBConexionStatic::getConexion();
    // Delete del producto ese, chau chau
    $sql = "DELETE FROM carrito WHERE usuario_fk = :usuario_id AND producto_fk = :producto_id";
    $stmt = $db->prepare($sql);
    $stmt->execute([
      ':usuario_id' => $usuarioId,
      ':producto_id' => $productoId
    ]);
  }

  // Vacía el carrito del usuario
  public function vaciar($usuarioId)
  {
    $db = DBConexionStatic::getConexion();
    // Borro todo el carrito para ese usuario, vacío total
    $sql = "DELETE FROM carrito WHERE usuario_fk = :usuario_id";
    $stmt = $db->prepare($sql);
    $stmt->execute([':usuario_id' => $usuarioId]);
  }

  // Devuelve la suma de todos los items (cantidad total de productos)
  public function getTotalItems($usuarioId)
  {
    $db = DBConexionStatic::getConexion();
    $sql = "SELECT SUM(cantidad) as total FROM carrito WHERE usuario_fk = :usuario_id";
    $stmt = $db->prepare($sql);
    $stmt->execute([':usuario_id' => $usuarioId]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    // Si no hay nada, devuelvo 0
    return (int)($row['total'] ?? 0);
  }

  // Trae detalle de una compra ya realizada (con chequeo de usuario)
  public function getCompraDetalle($compraId, $usuarioId)
  {
    $db = DBConexionStatic::getConexion();

    // Primero chequeo que la compra exista y sea del usuario
    $sql = "SELECT * FROM compras WHERE compra_id = :id AND usuario_fk = :usuario_id";
    $stmt = $db->prepare($sql);
    $stmt->execute([':id' => $compraId, ':usuario_id' => $usuarioId]);
    $compraRaw = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$compraRaw) {
      // Si no existe o no es del usuario, devuelvo null
      return null;
    }

    // Ahora traigo los productos de esa compra
    $sqlProd = "SELECT p.titulo, p.imagen, ctp.cantidad, ctp.precio_unitario
                FROM compras_tienen_productos ctp
                JOIN productos p ON ctp.producto_fk = p.producto_id
                WHERE ctp.compra_fk = :id";
    $stmtProd = $db->prepare($sqlProd);
    $stmtProd->execute([':id' => $compraId]);
    $productos = $stmtProd->fetchAll(PDO::FETCH_ASSOC);

    // Devuelvo toda la data armada piola
    return [
      'compra' => $compraRaw,
      'productos' => $productos
    ];
  }

}
