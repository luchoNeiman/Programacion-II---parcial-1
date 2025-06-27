<?php
$producto_id = $_GET['id'] ?? null;
$producto = (new Producto())->porId($producto_id);

?>
<section class="container mt-5">
    <h1 class="text-white m-0 mb-3 mx-3">
        <i class="bi bi-eye me-2"></i> Vista previa
    </h1>
    <div class="px-3">
        <div class="card mb-4 shadow-sm">
            <h3 class="card-header rounded-top-1 bg-dark text-white"><?= htmlspecialchars($producto->getTitulo()); ?></h3>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <p>
                            <strong class="text-violeta">Fecha de Ingreso:</strong> <?= $producto->getFechaIngreso(); ?>
                        </p>
                        <p>
                            <strong class="text-violeta">Precio:</strong>
                            $<?= number_format($producto->getPrecio(), 0, ',', '.'); ?>
                        </p>
                        <p>
                            <strong class="text-violeta">Franquicia:</strong> <?= htmlspecialchars($producto->getNombreFranquicia()); ?>
                        </p>
                        <p>
                            <strong class="text-violeta">Categoría:</strong> <?= htmlspecialchars($producto->getCategoria()); ?>
                        </p>
                        <p>
                            <strong class="text-violeta">Descripción:</strong><br><?= htmlspecialchars($producto->getDescripcion()); ?>
                        </p>
                        <p>
                            <strong class="text-violeta">Características:</strong><br><?= nl2br(htmlspecialchars($producto->getCaracteristicas())); ?>
                        </p>
                    </div>
                    <div class="col-md-4">
                        <img src="../assets/imgs/productos/<?= $producto->getImagen() ?? 'default.png'; ?>"
                             alt="<?= htmlspecialchars($producto->getImagenDescripcion()); ?>"
                             class="img-fluid  mt-2">
                        <p class="text-center text-muted small mt-1"><?= htmlspecialchars($producto->getImagenDescripcion()); ?></p>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-12 d-flex justify-content-end flex-wrap gap-2 ">
                        <a href="index.php?seccion=confirmarBajaProducto&id=<?= $producto->getProductoId(); ?>"
                           class="btn btn-danger">
                            <i class="bi bi-trash3-fill me-1"></i> Eliminar
                        </a>
                        <a href="index.php?seccion=edicionProducto&id=<?= $producto->getProductoId(); ?>"
                           class="btn btn-dark"
                           title="Editar">
                            <i class="bi bi-pencil-square me-1"></i> Editar
                        </a>

                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-5 ">
            <div class="col-12 d-flex justify-content-end flex-wrap gap-2 ">
                <a href="index.php?seccion=productos" class="btn btn-dark border-light">
                    <i class="bi bi-arrow-left me-1"></i> Volver al listado
                </a>
            </div>
        </div>
    </div>
</section>
