<?php
require_once __DIR__ . '/../classes/Producto.php';

$productos = (new Producto)->todosProductos();
?>
<section class="productos py-5">
    <div class="container">
        <h1 class="mb-3 text-center">Nuestros Productos</h1>
        <p class="lead text-center mb-5">Los mejores artículos de tus series favoritas</p>
        <div class="row g-4">
            <?php foreach ($productos as $producto): ?>
                <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                    <article class="card h-100 shadow-sm">
                        <img src="assets/imgs/products/<?= $producto->imagen; ?>"
                            class="card-img-top img-fluid"
                            alt="<?= $producto->imagen_descripcion; ?>">
                        <div class="card-body d-flex flex-column">
                            <h2 class="card-title fs-5"><?= $producto->titulo; ?></h2>
                            <p class="card-text text-black"><?= $producto->descripcion; ?></p>
                            <p class="card-text fw-bold text-primary mt-auto"><strong class="text-black">$<?= number_format($producto->precio, 2, ',', '.'); ?></strong></p>
                            <a href="index.php?seccion=detalle-producto&id=<?= $producto->producto_id; ?>"
                                class="btn btn-outline-dark mt-2 w-100">Ver más</a>
                        </div>
                    </article>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>