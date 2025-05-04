<?php
/* require_once __DIR__ . '/../bibliotecas/productos.php'; */
require_once __DIR__ . '/../classes/Producto.php';

/* $productos = obtenerproductos(); */
// Esta línea crea una nueva instancia de la clase Producto y llama al método todosProductos() para obtener la lista de todos los productos.
$productos = (new Producto)->todosProductos();
?>
<section class="productos">
    <div class="container">
        <h1>Nuestros Productos</h1>
        <p class="lead">Los mejores artículos de tus series favoritas</p>
        <div class="row">
            <?php
            // Este foreach simula productos, reemplazalo con tu lógica real más adelante
            foreach ($productos as $producto):
            ?>
                <div class="col-12 col-sm-6 col-md-3 mb-4">
                    <article class="card h-100">
                        <img src="assets/imgs/products/<?=$producto->imagen;?>" class="card-img-top" alt="<?=$producto->imagen_descripcion; ?>">
                        <div class="card-body d-flex flex-column">
                            <h2 class="card-title fs-5"><?= $producto->titulo; ?></h2>
                            <p class="card-text"><?= $producto->descripcion; ?></p>
                            <p class="card-text fw-bold text-primary mt-auto">$<?= number_format($producto->precio, 2, ',', '.'); ?></p>
                            <a href="index.php?seccion=detalle-producto&id=<?= $producto->producto_id; ?>" class="btn btn-outline-dark mt-2">Ver más</a>
                        </div>
                    </article>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
