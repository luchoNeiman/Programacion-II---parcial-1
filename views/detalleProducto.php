<?php
$id = $_GET['id'] ?? null;
$producto = (new Producto)->porId($id);
if (!$producto) {
  echo "<div class='alert alert-danger'>El producto no existe.</div>";
  exit;
} ?>

<section class="container my-5 ">
    <div class="row">
        <!-- Imagen  a futuro poner varias imagenes-->
        <div class="col-12 col-md-4">
            <img src="assets/imgs/productos/<?= $producto->getImagen() ?? 'default.png'; ?>"
                 alt="<?= htmlspecialchars($producto->getImagenDescripcion()); ?>"
                 class="mt-2 img-hover img-fluid rounded shadow-sm ">
        </div>
        <!-- Información del producto -->
        <div class="col-12 col-md-8">
            <div class="card mt-2">
                <div class="card-header bg-dark d-flex justify-content-between align-items-center"><h1
                            class="fs-2 text-white mb-0"><?= htmlspecialchars($producto->getTitulo()); ?></h1>
                    <!-- Botón para volver al listado, siempre visible -->
                    <a href="index.php?seccion=productos" class="btn btn-light">
                        <i class="bi bi-arrow-left bi-lg ms-2"></i> Volver a productos
                    </a>
                </div>
                <div class="card-body">
                    <p class="lead"><?= htmlspecialchars($producto->getDescripcion()); ?></p>
                    <h2 class="mt-4 mb-3">
                        <strong>$<?= number_format($producto->getPrecio(), 2, ',', '.'); ?></strong>
                    </h2>
                    <p>Hasta 3 cuotas sin interés</p>
                    <p>Llega gratis el lunes</p>

                    <p class="fw-bold text-violeta">Stock disponible</p>

                </div>
                <div class="card-footer">
                    <!-- Contenedor flex que se adapta de columna a fila según el tamaño de pantalla -->
                    <div class="d-flex flex-wrap align-items-center gap-2">


                      <?php if ((new Autenticacion)->estaAutenticado()): ?>
                          <!-- Si el usuario está logueado, muestro el form para agregar al carrito -->
                          <form action="acciones/procesar-carrito.php" method="post"
                                class="d-flex align-items-center p-0 m-0">
                              <!-- Controles para la cantidad -->
                              <div class="input-group" style="width: 110px;">
                                  <!-- Botón menos -->
                                  <button type="button" class="btn btn-dark "
                                          onclick="this.parentNode.querySelector('input').stepDown()">-
                                  </button>
                                  <!-- Input de cantidad (readonly, solo con los botones) -->
                                  <input type="number" name="cantidad" value="1" min="1" readonly
                                         class="form-control form-control-sm text-center" style="max-width: 60px;">
                                  <!-- Botón más -->
                                  <button type="button" class="btn btn-dark "
                                          onclick="this.parentNode.querySelector('input').stepUp()">+
                                  </button>
                              </div>
                              <!-- Botón para agregar el producto al carrito -->
                              <button type="submit" name="accion" value="agregar_<?= $producto->getProductoId() ?>"
                                      class="btn btn-dark ms-2">
                                  <i class="bi bi-cart-plus"></i> Agregar al carrito
                              </button>
                          </form>
                      <?php else: ?>
                          <!-- Si NO está logueado, muestro botón para iniciar sesión -->
                          <a href="index.php?seccion=iniciar-sesion&from=<?= urlencode($_SERVER['REQUEST_URI']) ?>"
                             class="btn btn-dark ms-2">
                              <i class="bi bi-person"></i> Iniciá sesión para comprar
                          </a>
                      <?php endif; ?>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-12 mb-4">
            <div class="card detalle-caracteristicas-producto">
                <h2 class="fs-4 card-header text-white bg-dark">Características principales</h2>
                <div class="card-body">
                    <ul class="list-unstyled text-color">
                        <li class="mb-2"><?= htmlspecialchars($producto->getCaracteristicas()) ?></li>
                        <li><strong>Franquicia:</strong> <?= htmlspecialchars($producto->getNombreFranquicia()) ?></li>
                        <li><strong>Categoria:</strong> <?= htmlspecialchars($producto->getCategoria()) ?></li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</section>

<section class="container mb-5">
    <div class="row">
        <div class="col-md-12">
            <h2 class="mb-4 text-white"> Más productos de <?= htmlspecialchars($producto->getCategoria()) ?></h2>
            <div class="row g-4">
              <?php
              // variable para poder filtrar por tipo de categoria
              $productosSimilares = (new Producto())->obtenerPorCategoria($producto->getCategoria());

              foreach ($productosSimilares as $productoCategoria): ?>
                  <div class="col-12 col-sm-6 col-lg-3 d-flex align-items-stretch mb-4">
                      <a href="index.php?seccion=detalleProducto&id=<?= $productoCategoria->getProductoId(); ?>"
                         class="btn p-0 w-100 h-100 tarjeta">
                          <article class="card shadow-sm h-100 ">
                              <img src="assets/imgs/productos/<?= $productoCategoria->getImagen(); ?>"
                                   class="card-img-top img-fluid "
                                   alt="<?= $productoCategoria->getImagenDescripcion(); ?>">
                              <div class="card-header bg-dark">
                                  <h2 class="text-white fs-5 rounded-2 m-0"><?= $productoCategoria->getTitulo(); ?></h2>
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
    </div>
</section>