<?php
require_once __DIR__ . '/../classes/Producto.php';
$productos = (new Producto)->todosProductos();
?>

<section>
    <img src="assets/imgs/Banners/banner-principal.webp" alt="Banner principal" height="450" class="img-fluid">
</section>
<section class="container text-center">
    <div class="row my-5">
        <div class="col-md-12">
            <h1 class=" mb-4">¡Bienvenido a Otaku Mania!</h1>
            <p class="fs-5"><strong>Somos tu tienda de confianza</strong> dedicada a todos los fans del anime, manga
                y la cultura japonesa. Aquí encontrarás todo lo que necesitas para disfrutar de tu pasión por el
                mundo otaku.</p>
            <p class="fs-5">
                Descubre <strong>figuras coleccionables</strong>, <strong>ropa temática</strong>, <strong>accesorios
                    exclusivos</strong> y mucho más.
                Nuestro objetivo es ofrecer productos de calidad para que vivas al máximo tu afición con artículos
                que realmente te encanten.
            </p>
        </div>
    </div>

</section>
<section class="bg-dark py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mb-4 text-white"> Imperdibles del mes</h2>
                <div class="row g-4">
                    <?php foreach (array_slice($productos, 0, 4) as $producto): ?>
                        <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                            <article class="card h-100 shadow-sm">
                                <img src="assets/imgs/products/<?= $producto->imagen; ?>"
                                     class="card-img-top img-fluid"
                                     alt="<?= $producto->imagen_descripcion; ?>">
                                <div class="card-body d-flex flex-column">
                                    <h2 class="card-title fs-5"><?= $producto->titulo; ?></h2>
                                    <p class="card-text"><?= $producto->descripcion; ?></p>
                                    <p class="card-text fw-bold text-primary mt-auto">
                                        $<?= number_format($producto->precio, 2, ',', '.'); ?></p>
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
<section class="py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card text-center">
                    <div class="card-body d-flex flex-column align-items-center">
                        <h2 class="mb-4">¡Oferta Especial!</h2>
                        <img class="w-50" src="assets/imgs/Banners/descuento.png" alt="Descuento especial 20% off">
                        <p class="fs-4 mb-4">No te pierdas esta increíble oportunidad. ¡Obtené un cupón del 20% de
                            descuento!</p>
                        <a href="index.php?seccion=contacto" class="btn btn-dark  btn-lg">¡Obtené tu cúpon!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section>

</section>