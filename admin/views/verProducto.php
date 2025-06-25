<?php
$producto_id = $_GET['id'] ?? null;

$producto = (new Producto())->porId($producto_id);
?>
<div class="container mt-5">

    <div class="px-3">
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <h3 class="card-title"><?= htmlspecialchars($producto->getTitulo()); ?></h3>
                <p><strong>Fecha de Ingreso:</strong> <?= $producto->getFechaIngreso(); ?></p>
                <p><strong>Precio:</strong> $<?= number_format($producto->getPrecio(), 0, ',', '.'); ?></p>
                <p><strong>Franquicia:</strong> <?= htmlspecialchars($producto->getNombreFranquicia()); ?></p>
                <p><strong>Categoría:</strong> <?= htmlspecialchars($producto->getCategoria()); ?></p>
                <p><strong>Descripción:</strong><br><?= nl2br(htmlspecialchars($producto->getDescripcion())); ?></p>
                <p><strong>Características:</strong><br><?= nl2br(htmlspecialchars($producto->getCaracteristicas())); ?>
                </p>

                <img src="../assets/imgs/productos/<?= $producto->getImagen(); ?>"
                     alt="Imagen del producto"
                     class="img-fluid mt-2" style="max-width: 150px;">
                <p class="text-muted small mt-1"><?= htmlspecialchars($producto->getImagenDescripcion()); ?></p>
                <div class="row me-3">
                    <div class="col-12 d-flex justify-content-end flex-wrap gap-2 ">
                        <a href="index.php?seccion=edicionProducto&id=<?= $producto->getProductoId(); ?>"
                           class="btn btn-dark"
                           title="Editar">
                            <i class="bi bi-pencil-square me-1"></i> Editar
                        </a>
                        <a href="index.php?seccion=confirmarBajaProducto&id=<?= $producto->getProductoId(); ?>"
                           class="btn btn-danger"
                           onclick="return confirm('¿Eliminar este producto?')" title="Eliminar">
                            <i class="bi bi-trash3-fill me-1"></i> Eliminar
                        </a>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <div class="row me-3">
        <div class="col-12 d-flex justify-content-end flex-wrap gap-2 ">
            <a href="index.php?seccion=productos" class="btn btn-dark">
                <i class="bi bi-arrow-left me-1"></i> Volver al listado
            </a>
        </div>
    </div>


</div>
