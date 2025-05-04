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
            <h2 class="text-primary fw-bold mt-4 mb-3">
                $<?= number_format($producto->precio, 2, ',', '.'); ?>
            </h2>
            <p class="text-naranja-tostado">Hasta 3 cuotas sin interés</p>
            <p class="text-naranja-tostado">Llega gratis el lunes</p>

            <p class="fw-bold">Stock disponible</p>
            <div class="d-flex align-items-center flex-wrap mb-3">
                <label for="cantidadModal" class="me-2">Cantidad:</label>
                <select id="cantidadModal" class="form-select me-2" style="width: auto;">
                    <option value="1">1 unidad</option>
                    <option value="2">2 unidades</option>
                    <option value="3">3 unidades</option>
                    <option value="4">4 unidades</option>
                    <option value="5">5 unidades</option>
                    <option value="6">6 unidades</option>
                </select>
                <small class="text-muted mt-1">(+10 disponibles)</small>
            </div>
            <a href="index.php?seccion=productos" class="btn btn-outline-secondary me-2">
                ← Volver a productos
            </a>
            <a href="#" class="btn btn-dark">
                Comprar ahora
            </a>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-12 mb-4">
            <div class="card p-3 -sm">
                <div class="container">
                    <h2 class="fs-4">Características principales</h2>
                    <ul class="list-unstyled">
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