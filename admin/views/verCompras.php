<?php
$usuarioId = $_GET['id'] ?? null;
$usuario = (new Usuario())->porId($usuarioId);
$compras = (new Compra)->traerCompras($usuario->getUsuarioId());

?>

<div class="container  py-5">
    <h1 class="text-center text-white mb-5">
        <i class="bi bi-receipt me-2"></i>
        Detalles de compras de <?= htmlspecialchars($usuario->getNombre()); ?>
    </h1>
    <!-- Botón volver -->
    <div class="row justify-content-center">
      <?php if (empty($compras)): ?>
          <div class="col-md-8">
              <div class="text-center bg-light p-5 rounded shadow-sm">
                  <i class="bi bi-cart-x text-secondary display-1 mb-4"></i>
                  <h3 class="mb-3  text-muted">No hay compras registradas</h3>
                  <p class="fs-5 text-muted">
                      Este usuario aún no tiene compras realizadas.
                  </p>
                  <a href="index.php?seccion=registroUsuarios" class="btn btn-dark mt-3">
                      <i class="bi bi-arrow-left me-1"></i> Volver al registro de usuarios
                  </a>
              </div>
          </div>
      <?php else: ?>
        <?php foreach ($compras as $compra): ?>
          <?php $collapseId = 'collapseCompra_' . $compra->getCompraId(); ?>
              <div class="col-md-8 mb-4">
                  <a href="index.php?seccion=registroUsuarios" class="btn btn-dark border-light">
                      <i class="bi bi-arrow-left me-2"></i> Volver al registro de usuarios
                  </a>
              </div>
              <div class="col-md-8">
                  <div class="card border-0 shadow-sm my-3">
                      <div class="card-header p-0 border-0">
                          <a class="d-block text-decoration-none text-white"
                             data-bs-toggle="collapse"
                             href="#<?= $collapseId ?>"
                             role="button"
                             aria-expanded="false"
                             aria-controls="<?= $collapseId ?>">
                              <div class="p-3 bg-dark d-flex justify-content-between align-items-center rounded compra-header">
                                  <div class="d-flex align-items-center">
                                      <i class="bi bi-table me-2 text-white"></i>
                                      <strong class="text-white">Orden de Compra
                                          #<?= $compra->getCompraId(); ?></strong>
                                  </div>
                                  <div class="text-end">
                                      <span class="small text-white me-3">
                                        <i class="bi bi-calendar-event me-1"></i><?= htmlspecialchars($compra->getFecha()); ?>
                                      </span>
                                      <span class="small text-white">
                                        <i class="bi bi-currency-dollar me-1"></i> <?= number_format($compra->getTotalCompra(), 2, ',', '.') ?>
                                      </span>
                                  </div>
                              </div>
                          </a>
                      </div>

                      <div id="<?= $collapseId ?>" class="collapse">
                        <?php $detalles = $compra->traerDetalleCompras($compra->getCompraId()); ?>
                          <div class="card-body">
                              <div class="row justify-content-center">
                                  <div class="col-md-12">
                                    <?php if (!$detalles): ?>
                                        <div class="alert alert-warning mb-0">
                                            No hay información de compra para mostrar.
                                        </div>
                                    <?php else: ?>
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
                                        </ul>
                                    <?php endif; ?>
                                  </div>
                              </div>
                          </div>
                      </div>

                  </div>
              </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>


</div>