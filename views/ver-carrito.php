<?php
// Si no está autenticado, lo mando a login y guardo la URL actual para redireccionar después
if (!(new Autenticacion)->estaAutenticado()) {
  $actualUrl = $_SERVER['REQUEST_URI'];
  header('Location: index.php?seccion=iniciar-sesion&from=' . urlencode($actualUrl));
  exit;
}

$usuarioId = $_SESSION['usuario_id'] ?? null;

$carrito = new Carrito();
$productos = $carrito->getItems($usuarioId);
?>

<div class="container py-5">
    <h2 class="text-center text-white mb-5"><i class="bi bi-cart-fill me-2"></i>Carrito de Compras</h2>

    <!-- Si el carrito está vacío -->
  <?php if (empty($productos)): ?>
      <div class="container ">
          <div class="text-center bg-light p-5 rounded shadow-sm">
              <i class="bi bi-cart-x text-secondary display-1 mb-4"></i>
              <h3 class="mb-3">Tu carrito está vacío</h3>
              <p class="fs-5 text-muted">Parece que todavía no agregaste ningún producto.</p>
              <a href="index.php?seccion=productos" class="btn btn-dark mt-3">
                  <i class="bi bi-arrow-left me-1"></i> Seguir comprando
              </a>
          </div>
      </div>
  <?php else: ?>
      <!-- Si hay productos, armo la tabla -->
      <div class="my-5"></div>
      <div class="row justify-content-center">
          <div class="col-md-10">
              <!-- Card de la tabla -->
              <div class="mx-5 mb-5 card shadow-sm">
                  <div class="table-responsive">
                      <table class="table table-bordered table-striped table-hover mi-tabla-violeta mb-0">
                          <thead class="table-dark">
                          <tr>
                              <th class="min-th-accion"></th>
                              <th>Producto</th>
                              <th class="text-center">Cantidad</th>
                              <th class="text-end">Precio Unitario</th>
                              <th class="text-end">Subtotal</th>
                          </tr>
                          </thead>
                          <tbody>
                          <?php foreach ($productos as $producto): ?>
                              <tr>
                                  <!-- Botón para eliminar producto -->
                                  <td class="align-middle text-center">
                                      <form action="acciones/procesar-carrito.php" method="post" class="d-inline">
                                          <button type="submit" name="accion"
                                                  value="eliminar_<?= $producto->getProductoId() ?>"
                                                  class="btn btn-sm btn-outline-danger" title="Eliminar del carrito">
                                              <i class="bi bi-x-lg"></i>
                                          </button>
                                      </form>
                                  </td>
                                  <td>
                                      <div class="d-flex align-items-center">
                                          <!-- Imagen del producto -->
                                          <img src="assets/imgs/productos/<?= $producto->getImagen() ?? 'default.png' ?>"
                                               alt="Producto de <?= htmlspecialchars($producto->getTitulo()) ?>"
                                               width="60" class="img-fluid rounded me-3">
                                          <div>
                                              <h6 class="mb-0"><?= htmlspecialchars($producto->getTitulo()) ?></h6>
                                          </div>
                                      </div>
                                  </td>
                                  <!-- Acciones para sumar/restar cantidad -->
                                  <td class="align-middle text-center">
                                      <!-- Botón restar -->
                                      <form action="acciones/procesar-carrito.php" method="post" class="d-inline">
                                          <button type="submit" name="accion"
                                                  value="restar_<?= $producto->getProductoId() ?>
"
                                                  class="btn btn-sm btn-outline-secondary" title="Restar uno">
                                              <i class="bi bi-dash"></i>
                                          </button>
                                      </form>
                                      <span class="mx-2"><?= $producto->getCantidad()
                                        ?></span>
                                      <!-- Botón sumar -->
                                      <form action="acciones/procesar-carrito.php" method="post" class="d-inline">
                                          <button type="submit" name="accion"
                                                  value="sumar_<?= $producto->getProductoId() ?>
"
                                                  class="btn btn-sm btn-outline-success" title="Sumar uno">
                                              <i class="bi bi-plus"></i>
                                          </button>
                                      </form>
                                  </td>
                                  <!-- Precio unitario del producto -->
                                  <td class="align-middle text-end">$<?= $producto->getPrecioUnitario() ?>
                                  </td>
                                  <!-- Subtotal (precio x cantidad) -->
                                  <td class="align-middle text-end">
                                      $<?= $producto->getPrecioUnitario() * $producto->getCantidad() ?>
                                  </td>
                              </tr>
                          <?php endforeach; ?>
                          </tbody>
                          <!-- Footer con el total de la compra -->
                          <tfoot class="table-dark">
                          <tr class="fw-bold">
                              <td colspan="3" class="text-end">Total:</td>
                              <td class="text-end">$<?= $carrito->calcularTotal($usuarioId); ?></td>
                              <td></td>
                          </tr>
                          </tfoot>
                      </table>
                      <!-- Botones de acción del carrito -->
                      <div class="d-flex justify-content-between mt-2 mb-2">
                          <!-- Botón Vaciar Carrito a la izquierda -->
                          <form action="acciones/procesar-carrito.php" method="post" class="d-inline">
                              <button type="submit" name="accion" value="vaciar" class="btn btn-danger ms-1">
                                  <i class="bi bi-trash3 me-1"></i>Vaciar Carrito
                              </button>
                          </form>

                          <!-- Contenedor para los otros dos botones alineados a la derecha -->
                          <div class="d-flex">
                              <!-- Seguir comprando -->
                              <a href="index.php?seccion=productos" class="btn btn-outline-dark me-2">
                                  <i class="bi bi-arrow-left me-1"></i>Seguir comprando
                              </a>
                              <!-- Finalizar compra -->
                              <form action="acciones/procesar-compra.php" method="post" class="d-inline">
                                  <button type="submit" class="btn btn-success me-1">
                                      <i class="bi bi-check-circle me-1"></i> Finalizar compra
                                  </button>
                              </form>
                          </div>
                      </div>

                  </div>
              </div>
          </div>
      </div>
  <?php endif; ?>
</div>
