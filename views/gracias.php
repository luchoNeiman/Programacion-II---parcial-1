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
$carrito = new Carrito();

// Traigo el detalle de la compra, chequeando que pertenezca al usuario
$detalle = $carrito->getCompraDetalle($compraId, $_SESSION['usuario_id']);
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
          <?php if (!$detalle): ?>
              <!-- Si no hay datos de la compra (puede que no exista o no sea tuya) -->
              <div class="alert alert-warning">
                  No hay información de compra para mostrar.
              </div>
          <?php else: ?>
              <!-- Si hay detalle, muestro el resumen piola -->
              <div class="card shadow-sm mb-4">
                  <div class="card-header bg-dark text-white">
                      <h5 class="mb-0"><i class="bi bi-cart4 me-1"></i>Resumen de tu compra</h5>
                  </div>
                  <ul class="list-group list-group-flush">
                    <?php $total = 0; ?>
                    <?php foreach ($detalle['productos'] as $item): ?>
                      <?php
                      // Calculo subtotal y voy sumando al total general
                      $subtotal = $item['precio_unitario'] * $item['cantidad'];
                      $total += $subtotal;
                      ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center ">
                            <div>
                                <strong><?= htmlspecialchars($item['titulo']) ?></strong><br>
                                <small><?= $item['cantidad'] ?> x
                                    $<?= number_format($item['precio_unitario'], 2, ',', '.') ?></small>
                            </div>
                            <span class="fw-bold">$<?= number_format($subtotal, 2, ',', '.') ?></span>
                        </li>
                    <?php endforeach; ?>
                      <!-- Total final -->
                      <li class="list-group-item d-flex justify-content-between fw-bold bg-dark text-white">
                          Total:
                          <span>$<?= number_format($total, 2, ',', '.') ?></span>
                      </li>
                  </ul>
              </div>
              <!-- Botón para volver al catálogo de productos -->
              <div class="text-center mt-4">
                  <a href="index.php?seccion=productos" class="btn btn-dark border-light">
                      <i class="bi bi-arrow-left me-1"></i> Volver a productos
                  </a>
              </div>
          <?php endif; ?>
        </div>
    </div>
</div>
