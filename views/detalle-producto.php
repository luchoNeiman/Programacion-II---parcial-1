<?php
$id = $_GET['id'];
$producto = (new Producto)->porId($id);

?>

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
                <div class="card-header bg-dark">
                    <h1 class="fs-2 text-white mb-0"><?= htmlspecialchars($producto->getTitulo()); ?></h1>
                </div>
                <div class="card-body">
                    <p class="lead"><?= htmlspecialchars($producto->getDescripcion()); ?></p>
                    <h2 class="mt-4 mb-3">
                        <strong>$<?= number_format($producto->getPrecio(), 2, ',', '.'); ?></strong>
                    </h2>
                    <p>Hasta 3 cuotas sin interés</p>
                     <p>Llega gratis el lunes</p>

                    <p class="fw-bold">Stock disponible</p>
                    <div class="d-flex align-items-center flex-wrap mb-3">
                        <label for="cantidadModal" class="me-2">Cantidad:</label>
                        <select id="cantidadModal" class="form-select me-2 texto-color w-auto">
                            <option value="1">1 unidad</option>
                            <option value="2">2 unidades</option>
                            <option value="3">3 unidades</option>
                            <option value="4">4 unidades</option>
                            <option value="5">5 unidades</option>
                            <option value="6">6 unidades</option>
                        </select>
                        <small class="mt-1">(+10 disponibles)</small>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex flex-wrap flex-column flex-sm-row gap-2">
                        <a href="index.php?seccion=productos" class="btn btn-outline-dark flex-fill">
                            <i class="bi bi-arrow-left bi-lg ms-2"></i> Volver a productos
                        </a>
                        <form action="acciones/carrito-procesar.php" method="post" class="d-inline">
                            <input type="hidden" name="accion" value="agregar">
                            <input type="hidden" name="id" value="<?= $producto->getProductoId(); ?>">
                            <input type="hidden" name="titulo" value="<?= htmlspecialchars($producto->getTitulo()); ?>">
                            <input type="hidden" name="precio" value="<?= $producto->getPrecio(); ?>">
                            <input type="hidden" name="cantidad" id="cantidadSeleccionada" value="1">
                            <input type="hidden" name="imagen" value="<?= $producto->getImagen(); ?>">

                            <button type="submit" class="btn btn-dark flex-fill">
                                <i class="bi bi-cart bi-lg"></i> Agregar al carrito
                            </button>
                        </form>
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
                        <a href="index.php?seccion=detalle-producto&id=<?= $productoCategoria->getProductoId(); ?>"
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