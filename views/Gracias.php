<?php
require_once __DIR__ . '/../bootstrap/init.php';

if (!isset($_SESSION['usuario_id'])) {
  header('Location: index.php?seccion=iniciar-sesion');
  exit;
}

$compraId = (int)($_GET['id'] ?? 0);
$carrito = new Carrito();
$detalle = $carrito->getCompraDetalle($compraId, $_SESSION['usuario_id']);
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm mb-4">
                <div class="card-body text-center">
                    <h2 class="text-success mb-1">
                        <i class="bi bi-check-circle-fill"></i> ¡Gracias por tu compra!
                    </h2>
                    <p class="lead mb-0">Tu pedido fue registrado correctamente.</p>
                </div>
            </div>
        </div>

        <div class="col-md-8">
          <?php if (!$detalle): ?>
              <div class="alert alert-warning">
                  No hay información de compra para mostrar.
              </div>
          <?php else: ?>
              <div class="card shadow-sm mb-4">
                  <div class="card-header bg-dark text-white">
                      <h5 class="mb-0"><i class="bi bi-cart4 me-1"></i>Resumen de tu compra</h5>
                  </div>
                  <ul class="list-group list-group-flush">
                    <?php $total = 0; ?>
                    <?php foreach ($detalle['productos'] as $item): ?>
                      <?php $subtotal = $item['precio_unitario'] * $item['cantidad']; ?>
                      <?php $total += $subtotal; ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center ">
                            <div>
                                <strong><?= htmlspecialchars($item['titulo']) ?></strong><br>
                                <small><?= $item['cantidad'] ?> x
                                    $<?= number_format($item['precio_unitario'], 2, ',', '.') ?></small>
                            </div>
                            <span class="fw-bold">$<?= number_format($subtotal, 2, ',', '.') ?></span>
                        </li>
                    <?php endforeach; ?>
                      <li class="list-group-item d-flex justify-content-between fw-bold bg-dark text-white">
                          Total:
                          <span>$<?= number_format($total, 2, ',', '.') ?></span>
                      </li>
                  </ul>
              </div>
              <div class="text-center mt-4">
                  <a href="index.php?seccion=productos" class="btn btn-dark">
                      <i class="bi bi-arrow-left me-1"></i> Volver a productos
                  </a>
              </div>
          <?php endif; ?>
        </div>
    </div>
</div>
