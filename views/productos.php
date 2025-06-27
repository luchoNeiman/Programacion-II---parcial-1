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
                  <a href="index.php?seccion=detalle-producto&id=<?= $producto->getProductoId(); ?>"
                     class="btn p-0 w-100 h-100 tarjeta">
                      <article class="card shadow-sm h-100 d-flex flex-column">
                          <img src="assets/imgs/productos/<?= $producto->getImagen() ?? 'default.png'; ?>"
                               class="card-img-top img-fluid"
                               alt="<?= htmlspecialchars($producto->getImagenDescripcion()); ?>">
                          <div class="card-header bg-dark">
                              <h2 class="text-white fs-5 rounded-2 m-0"><?= htmlspecialchars($producto->getTitulo()); ?></h2>
                          </div>
                          <div class="card-body flex-grow-1 mb-0">
                              <p class="card-text text-black"><?= htmlspecialchars($producto->getDescripcion()); ?></p>
                          </div>
                          <div class="card-footer mt-auto">
                              <p class="fs-4 mb-0">
                                  <strong class="text-black">$<?= number_format($producto->getPrecio(), 2, ',', '.'); ?></strong>
                              </p>
                          </div>
                      </article>
                  </a>
              </div>
          <?php endforeach; ?>
        </div>

    </div>
</section>