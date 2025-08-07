<?php
$productos = (new Producto)->todosProductos();
?>
<section class="productos py-5">
    <div class="container">
        <h1 class="mb-3 text-center text-white">Nuestros Productos</h1>
        <p class="lead text-center mb-5 text-white">Los mejores artículos de tus series favoritas</p>
        <div class="row g-4">
          <?php foreach ($productos as $producto): ?>
              <div class="col-12 col-sm-6 col-lg-3 d-flex align-items-stretch mb-4">

                  <article class="card shadow-sm h-100 d-flex flex-column">
                      <a href="index.php?seccion=detalle-producto&id=<?= $producto->getProductoId(); ?>"
                         class="btn p-0 w-100 h-100 tarjeta">
                          <img src="assets/imgs/productos/<?= $producto->getImagen() ?? 'default.png'; ?>"
                               class="card-img-top img-fluid"
                               alt="<?= htmlspecialchars($producto->getImagenDescripcion()); ?>">
                          <div class="card-header bg-dark">
                              <h2 class="text-white fs-5 rounded-2 m-0"><?= htmlspecialchars($producto->getTitulo()); ?></h2>
                          </div>
                          <div class="card-body flex-grow-1 mb-0">
                              <p class="card-text text-black"><?= htmlspecialchars($producto->getDescripcion()); ?></p>
                          </div>
                      </a>
                      <div class="card-footer mt-auto d-flex justify-content-between align-items-center">
                        <?php if ((new Autenticacion)->estaAutenticado()): ?>
                            <form action="acciones/procesar-carrito.php" method="post"
                                  class="d-flex align-items-center ms-2">
                                <div class="input-group me-2">
                                    <button type="button" class="btn btn-dark btn-sm"
                                            onclick="this.parentNode.querySelector('input').stepDown()">-
                                    </button>
                                    <input type="number" name="cantidad" value="1" min="1" readonly
                                           class="form-control form-control-sm text-center">
                                    <button type="button" class="btn btn-dark btn-sm"
                                            onclick="this.parentNode.querySelector('input').stepUp()">+
                                    </button>
                                </div>
                                <button type="submit" name="accion" value="agregar_<?= $producto->getProductoId() ?>"
                                        class="btn btn-dark btn-sm">
                                    <i class="bi bi-cart-plus"></i>
                                </button>
                            </form>
                        <?php endif; ?>
                          <p class="fs-4 mb-0">
                              <strong class="text-black">$<?= number_format($producto->getPrecio(), 2, ',', '.'); ?></strong>
                          </p>
                      </div>

                  </article>
              </div>
          <?php endforeach; ?>
        </div>

    </div>
</section>