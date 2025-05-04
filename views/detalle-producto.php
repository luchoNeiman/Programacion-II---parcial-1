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
                class="img-fluid rounded shadow-sm"
                style="max-height: 450px; object-fit: cover;">
        </div>

        <!-- Información del producto -->
        <div class="col-12 col-md-6">
            <h1 class="display-6 mb-3"><?= $producto->titulo; ?></h1>
            <p class="lead"><?= $producto->descripcion; ?></p>
            <h2 class="text-primary fw-bold mt-4 mb-3">
                $<?= number_format($producto->precio, 2, ',', '.'); ?>
            </h2>

            <a href="index.php?seccion=productos" class="btn btn-outline-secondary me-2">
                ← Volver a productos
            </a>
            <a href="#" class="btn btn-dark">
                Comprar ahora
            </a>
        </div>
    </div>
</section>