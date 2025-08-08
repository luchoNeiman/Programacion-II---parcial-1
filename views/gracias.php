<?php
// Incluyo el archivo de inicialización, para la conexión y sesiones
require_once __DIR__ . '/../bootstrap/init.php';

// Si el usuario no está logueado, lo rajo a iniciar sesión
if (!isset($_SESSION['usuario_id'])) {
  header('Location: index.php?seccion=iniciar-sesion');
  exit;
}

// Tomo el ID de la compra de la query string (por GET), si no viene pongo 0 por las dudas
$compraId = (int)($_GET['id'] ?? 0);

// Instancio el carrito para usar sus métodos
$compra = new Compra();

// Traigo el detalle de la compra, chequeando que pertenezca al usuario
$detalles = $compra->traerDetalleCompras($compraId);
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Mensaje principal de éxito -->
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
          <?php if (!$detalles): ?>
              <div class="alert alert-warning mb-0">
                  No hay información de compra para mostrar.
              </div>
          <?php else: ?>
              <div class="card shadow-sm mb-4">
                  <div class="card-header bg-dark text-white">
                      <h5 class="mb-0"><i class="bi bi-cart4 me-1"></i>Resumen de tu compra</h5>
                  </div>
                  <ul class="list-group list-group-flush">
                    <?php foreach ($detalles as $detalle): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong><?= htmlspecialchars($detalle->getTitulo()) ?></strong><br>
                                <small><?= (int)$detalle->getCantidad() ?> x
                                    $<?= number_format($detalle->getPrecioUnitario(), 2, ',', '.') ?></small>
                            </div>
                            <span class="fw-bold">$<?= number_format($detalle->getSubtotal(), 2, ',', '.') ?></span>
                        </li>
                    <?php endforeach; ?>
                      <!-- Total final -->
                    <?php $total = array_sum(array_map(fn($detalle) => $detalle->getSubtotal(), $detalles)); ?>
                      <li class="list-group-item d-flex justify-content-between fw-bold bg-dark text-white">
                          Total:
                          <span>$<?= number_format($total, 2, ',', '.') ?></span>
                      </li>
                  </ul>
              </div>
              <!-- Botón para volver al catálogo de productos -->
              <div class=" mt-4">
                  <a href="index.php?seccion=productos" class="btn btn-dark border-light">
                      <i class="bi bi-arrow-left me-1"></i> Volver a productos
                  </a>
              </div>
          <?php endif; ?>
        </div>
    </div>
</div>
