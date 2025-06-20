<?php

$id = $_GET['id'];
$producto = (new Producto)->porId($id);

?>

<section class="container my-5 " >
    <div class="row align-items-center">
        <!-- Imagen -->
        <div class="col-12 col-md-6 mb-4 mb-md-0">
            <img src="assets/imgs/productos/<?= $producto->getImagen(); ?>"
                alt="<?= $producto->getImagenDescripcion(); ?>"
                class="imagen-producto img-hover img-fluid rounded shadow-sm">
        </div>
        <!-- Información del producto -->
        <div class="col-12 col-md-6">
            <h1 class="display-6 mb-3 text-white"><?= $producto->getTitulo(); ?></h1>
            <p class="lead text-white"><?= $producto->getDescripcion(); ?></p>
            <h2 class="mt-4 mb-3 text-white">
                <strong class="text-white">$<?= number_format($producto->getPrecio(), 2, ',', '.'); ?></strong>
            </h2>
            <p class="text-white">Hasta 3 cuotas sin interés</p>
            <p class="text-white">Llega gratis el lunes</p>

            <p class="fw-bold text-white">Stock disponible</p>
            <div class="d-flex align-items-center flex-wrap mb-3">
                <label for="cantidadModal" class="me-2 text-white">Cantidad:</label>
                <select id="cantidadModal" class="form-select me-2 texto-color w-auto">
                    <option value="1">1 unidad</option>
                    <option value="2">2 unidades</option>
                    <option value="3">3 unidades</option>
                    <option value="4">4 unidades</option>
                    <option value="5">5 unidades</option>
                    <option value="6">6 unidades</option>
                </select>
                <small class="text-white mt-1">(+10 disponibles)</small>
            </div>
            <a href="index.php?seccion=productos" class="btn btn-light me-2 ">
                <i class="bi bi-arrow-left bi-lg text-dark ms-2"></i> Volver a productos
            </a>
            <a href="#" class="btn btn-dark border-light">
                Comprar ahora
            </a>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-12 mb-4">
            <div class="card p-3 -sm detalle-caracteristicas-producto">
                <div class="container">
                    <h2 class="fs-4 text-black">Características principales</h2>
                    <ul class="list-unstyled text-color">
                        <li><?= $producto->getCaracteristicas() ?></li>
                        <li><strong>Franquicia:</strong> <?= $producto->getNombreFranquicia() ?></li>
                        <li><strong>Categoria:</strong> <?= $producto->getCategoria() ?></li>

                    </ul>
                </div>
            </div>
        </div>

    </div>
</section>

<section class="container mb-5">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mb-4 text-white"> Productos Similares</h2>
                <div class="row g-4">
                    <?php
                    // variable para poder filtrar por tipo de categoria
                    $productosSimilares = (new Producto())->obtenerPorCategoria($producto->getCategoria());

                    foreach ($productosSimilares as $productoCategoria): ?>
                        <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                            <article class="card shadow-sm h-100">
                                <img src="assets/imgs/productos/<?= $productoCategoria->getImagen(); ?>"
                                    class="card-img-top img-fluid"
                                    alt="<?= $productoCategoria->getImagenDescripcion(); ?>">
                                <div class="card-body d-flex flex-column">
                                    <h2 class="card-title fs-5"><?= $productoCategoria->getTitulo(); ?></h2>
                                    <p class="card-text fw-bold text-primary mt-auto">
                                        <strong class="text-black">$<?= number_format($productoCategoria->getPrecio(), 2, ',', '.'); ?></strong></p>
                                    <a href="index.php?seccion=detalle-producto&id=<?= $productoCategoria->getProductoId(); ?>"
                                        class="btn btn-outline-dark mt-2 w-100">Ver más</a>
                                </div>
                            </article>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
</section>