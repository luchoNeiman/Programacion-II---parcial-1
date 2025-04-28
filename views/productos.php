<?php
// Ruta al archivo JSON
$jsonFile = __DIR__ . '/../data/productos.json';

// Leer y decodificar el archivo JSON
$productos = [];
if (file_exists($jsonFile)) {
    $productos = json_decode(file_get_contents($jsonFile), true);
}
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-12 text-center">
            <h1>Productos</h1>
            <p class="lead">Encuentra aquí nuestra colección destacada.</p>
        </div>
    </div>
    <div class="row mt-4">
        <?php foreach ($productos as $producto): ?>
            <div class="col-md-4">
                <div class="card h-100">
                    <img src="<?= htmlspecialchars($producto['imagen']) ?>" class="card-img-top" >
                    <div class="card-body">

                        <p class="card-text"><strong>Precio: $<?= number_format($producto['precio'], 2) ?></strong></p>
                        <a href="#" class="btn btn-primary">Comprar</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>