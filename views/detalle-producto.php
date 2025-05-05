<?php
require_once __DIR__ . '/../classes/Producto.php';

// Obtiene el ID enviado como parámetro en la URL (método GET)
$id = $_GET['id'];

// Crea una nueva instancia de la clase Producto y busca un producto por su ID
$producto = (new Producto)->porId($id);
?>

<section class="container my-5">
    <div class="row align-items-center">
        <!-- Imagen -->
        <div class="col-12 col-md-6 mb-4 mb-md-0">
            <img src="assets/imgs/products/<?= $producto->imagen; ?>"
                alt="<?= $producto->imagen_descripcion; ?>"
                class="img-hover img-fluid rounded shadow-sm"
                style="max-height: 450px; object-fit: cover;">
        </div>

        <!-- Información del producto -->
        <div class="col-12 col-md-6">
            <h1 class="display-6 mb-3"><?= $producto->titulo; ?></h1>
            <p class="lead"><?= $producto->descripcion; ?></p>
            <h2 class="text-success fw-bold mt-4 mb-3">
                $<?= number_format($producto->precio, 2, ',', '.'); ?>
            </h2>
            <p class="text-naranja-tostado">Hasta 3 cuotas sin interés</p>
            <p class="text-naranja-tostado">Llega gratis el lunes</p>

            <p class="fw-bold">Stock disponible</p>
            <div class="d-flex align-items-center flex-wrap mb-3">
                <label for="cantidadModal text-white" class="me-2">Cantidad:</label>
                <select id="cantidadModal" class="form-select me-2 texto-color" style="width: auto;">
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
                ← Volver a productos
            </a>
            <a href="#" class="btn btn-dark border-light">
                Comprar ahora
            </a>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-12 mb-4">
            <div class="card p-3 -sm">
                <div class="container">
                    <h2 class="fs-4 text-black">Características principales</h2>
                    <ul class="list-unstyled text-color">
                        <li><?= $producto->caracteristicas ?></li>
                        <li><strong>Franquicia:</strong> <?= $producto->franquicia ?></li>
                        <li><strong>Tipo de producto:</strong> <?= $producto->tipo_producto ?></li>
                        <li><strong>Edición:</strong> <?= $producto->edicion ?></li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</section>
<section>
    <div class="container mb-5">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mb-4"> Productos Similares</h2>
                <div class="row g-4">
                    <?php
                    // variable para poder filtrar por tipo de edicion
                    $productosSimilares = (new Producto())->obtenerPorEdicion($producto->edicion);

                    foreach ($productosSimilares as $productoEdicion): ?>
                        <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                            <article class="card h-100 shadow-sm">
                                <img src="assets/imgs/products/<?= $productoEdicion->imagen; ?>"
                                    class="card-img-top img-fluid"
                                    alt="<?= $productoEdicion->imagen_descripcion; ?>">
                                <div class="card-body d-flex flex-column">
                                    <h2 class="card-title fs-5"><?= $productoEdicion->titulo; ?></h2>
                                    <p class="card-text fw-bold text-primary mt-auto">
                                        $<?= number_format($productoEdicion->precio, 2, ',', '.'); ?></p>
                                    <a href="index.php?seccion=detalle-producto&id=<?= $productoEdicion->producto_id; ?>"
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