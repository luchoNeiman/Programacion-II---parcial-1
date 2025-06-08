<!----------------------------------------------DESTACADOS------------------------->
<section class="py-5 mb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mb-4 text-center"> Imperdibles del mes</h2>
                <div class="row g-4">
                    <?php
                    // variable para poder filtrar por tipo de edicion
                    $productosDestacados = (new Producto)->obtenerPorEdicion("Edición limitada", "Edición coleccionista"
                    );
                    foreach ($productosDestacados as $producto): ?>
                        <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                            <article class="card h-100 shadow">
                                <img src="assets/imgs/productos/<?= $producto->imagen; ?>"
                                     class="card-img-top img-fluid"
                                     alt="<?= $producto->imagen_descripcion; ?>">
                                <div class="card-body d-flex flex-column">
                                    <h3 class="card-title fs-5"><?= $producto->titulo; ?></h3>
                                    <p class="card-text fw-bold text-primary mt-auto"><strong
                                            class="text-black">$<?= number_format($producto->precio, 2, ',', '.'); ?></strong>
                                    </p>
                                    <a href="index.php?seccion=detalle-producto&id=<?= $producto->producto_id; ?>"
                                       class="btn btn-outline-dark mt-2 w-100">Ver más</a>
                                </div>
                            </article>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!----------------------------------------------productos similares------------------------->

