<?php

?>

<div class="border-bottom border-light">
    <img src="assets/imgs/Banners/banner-principal.webp" alt="OTAKUMANIA - Merchandaising y Figuras" height="450" class="img-fluid">
</div>
<section class="">
    <div class="container">
        <div class="row py-5">
            <div class="col-md-12">
                <h1 class=" text-center mb-4 text-white">¡Bienvenido!</h1>
                <p class="fs-5 mb-5 text-white"><strong class="text-white">Somos tu tienda de confianza</strong> dedicada a todos los
                    fans del anime, manga
                    y la cultura japonesa. Aquí encontrarás todo lo que necesitas para disfrutar de tu pasión por el
                    mundo otaku.</p>
                <p class="fs-5 text-white">
                    Descubre <strong class="text-white">figuras coleccionables</strong>, <strong class="text-white">ropa
                        temática</strong>, <strong class="text-white">accesorios
                        exclusivos</strong> y mucho más.
                    Nuestro objetivo es ofrecer productos de calidad para que vivas al máximo tu afición con artículos
                    que realmente te encanten.
                </p>
            </div>
        </div>

    </div>

</section>

<section class="py-5 mb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mb-4 text-center text-white"> Imperdibles del mes</h2>
                <div class="row g-4">
                    <?php
                    // variable para poder filtrar por fecha
                    $productosDestacados = (new Producto)->obtenerUltimosDelMes();
                    foreach ($productosDestacados as $producto): ?>
                        <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                            <article class="card h-100 shadow">
                                <img src="assets/imgs/productos/<?= $producto->getImagen(); ?>"
                                     class="card-img-top img-fluid"
                                     alt="<?= $producto->getImagenDescripcion(); ?>">
                                <div class="card-body d-flex flex-column">
                                    <h3 class="card-title fs-5"><?= $producto->getTitulo(); ?></h3>
                                    <p class="card-text fw-bold text-primary mt-auto"><strong
                                                class="text-black">$<?= number_format($producto->getPrecio(), 2, ',', '.'); ?></strong>
                                    </p>
                                    <a href="index.php?seccion=detalle-producto&id=<?= $producto->getProductoId(); ?>"
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
<section class="py-5 fondo-promo">
    <div class="container ">
        <div class="row justify-content-center">
            <div class="col-md-3 col-lg-4 d-none d-md-flex justify-content-start align-items-center">
                <img src="assets/imgs/fondos/fondo-ace.webp"
                     alt="Personaje Ace de One Piece"
                     class="img-fluid w-100">
            </div>
            <div class="col-md-6 col-lg-4 ">
                <div class="card text-center border-5">
                    <div class="card-body bg-morado">
                        <img class="w-75 img-fluid" src="assets/imgs/Banners/banner-descuento.webp"
                             alt="Descuento especial 35% off">
                    </div>
                    <div class="card-text justify-content-center bg-morado">
                        <h2 class="mb-4 text-center text-white">¡Promo Especial!</h2>
                        <p class="fs-4 text-center px-2 mb-4 text-white">No te pierdas esta increíble oportunidad. <strong
                                    class="text-white">¡Obtené un cupón del
                                35% de descuento!</strong></p>
                    </div>
                    <div class="bg-morado pt-3 pb-5">
                        <a href="index.php?seccion=contacto" class="btn-azul mb-3 text-decoration-none">¡Obtené tu cúpon!</a>
                    </div>

                </div>
            </div>
            <div class="col-md-3 col-lg-4 d-none d-md-flex justify-content-center align-items-center">
                <img src="assets/imgs/fondos/fondo-riuk.webp"
                     alt="Personaje ryuk de Death Note"
                     class="img-fluid w-75">
            </div>
        </div>
    </div>
</section>