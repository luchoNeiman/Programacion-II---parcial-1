<?php
require_once __DIR__ . '/../../classes/Producto.php';

$productos = (new Producto)->todosProductos();
?>
<section class="container-fluid mt-5">
    <h1 class="mx-5 mb-4 mt-4">
        🛠️ Administrar productos
        <a href="index.php?seccion=nuevoProducto" class="btn btn-dark border-light">
            <i class="bi bi-plus-circle me-1"></i> Nuevo producto
        </a>
    </h1>


    <!-- Tabla para escritorio -->
    <div class="mx-5 mb-5 card border-5 shadow-sm d-none d-md-block">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover mb-0">
                <thead class="table-dark">
                <tr>
                    <th  class="min-th">Fecha de Ingreso</th>
                    <th class="min-th">Título</th>
                    <th class="min-th">Franquicia</th>
                    <!--<th class="min-th">Categoria</th>-->
                    <th class="min-th">Descripción</th>
                    <th class="min-th">Características</th>
                    <th class="min-th">Imagen</th>
                    <th class="min-th">Alt imagen</th>
                    <th class="min-th">Precio</th>
                    <th class="min-th text-center ">Acciones</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($productos as $producto): ?>
                    <tr>
                        <td><?= $producto->getFechaIngreso(); ?></td>
                        <td><?= $producto->getTitulo(); ?></td>
                        <td><?= $producto->getNombreFranquicia(); ?></td>
                        <td><?= $producto->getDescripcion(); ?></td>
                        <td><?= $producto->getCaracteristicas(); ?></td>
                        <td>
                            <?php if ($producto->getImagen()): ?>
                                <img src="../assets/imgs/productos/<?= $producto->getImagen(); ?>"
                                     alt="<?= $producto->getImagenDescripcion(); ?>" width="150" class="img-thumbnail">
                            <?php else: ?>
                                <span class="text-muted">Sin imagen</span>
                            <?php endif; ?>
                        </td>
                        <td><?= $producto->getImagenDescripcion(); ?></td>
                        <td>$<?= number_format($producto->getPrecio(), 0, ',', '.'); ?></td>
                        <td class=" align-middle">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="index.php?seccion=edicionProducto&id=<?= $producto->getProductoId(); ?>"
                                   class="btn btn-xl btn-dark rounded-circle" title="Editar">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>

                                <a href="index.php?seccion=eliminarProduct&?id=<?= $producto->getProductoId(); ?>"
                                   class="btn btn-xl btn-danger rounded-circle"
                                   onclick="return confirm('¿Seguro que querés eliminar este producto?')"
                                   title="Eliminar">
                                    <i class="bi bi-trash-fill"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Cards para móviles -->
    <div class="d-block d-md-none px-3 mt-4">
        <?php foreach ($productos as $producto): ?>
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><?= $producto->getTitulo(); ?></h5>
                    <p class="text-secondary-emphasis mb-1"><strong>Fecha de
                            Ingreso:</strong> <?= $producto->getFechaIngreso(); ?></p>
                    <p class="text-secondary-emphasis mb-1"><strong>Precio:</strong>
                        $<?= number_format($producto->getPrecio(), 0, ',', '.'); ?></p>
                    <p class="text-secondary-emphasis mb-1">
                        <strong>Franquicia:</strong> <?= $producto->getNombreFranquicia(); ?></p>
                    <p class="text-secondary-emphasis mb-1">
                        <strong>Descripción:</strong> <?= $producto->getDescripcion(); ?></p>
                    <p class="text-secondary-emphasis mb-1">
                        <strong>Características:</strong> <?= $producto->getCaracteristicas(); ?></p>
                    <?php if ($producto->getImagen()): ?>
                        <img src="../assets/imgs/productos/<?= $producto->getImagen(); ?>"
                             alt="<?= $producto->getImagenDescripcion(); ?>"
                             class="img-fluid rounded mt-2" style="max-width: 150px;">
                        <p class="text-muted small mt-1"><?= $producto->getImagenDescripcion(); ?></p>
                    <?php endif; ?>
                    <div class="mt-3 row gx-2">
                        <div class="col-12 col-sm-6 mb-2 mb-sm-0">
                            <a href="index.php?seccion=edicionProducto&id=<?= $producto->getProductoId(); ?>"
                               class="btn btn-dark w-100 d-flex justify-content-center align-items-center"
                               title="Editar">
                                <i class="bi bi-pencil-fill me-1"></i> Editar
                            </a>
                        </div>
                        <div class="col-12 col-sm-6">
                            <a href="index.php?seccion=eliminarProducto&id=<?= $producto->getProductoId(); ?>"
                               class="btn btn-danger w-100 d-flex justify-content-center align-items-center"
                               onclick="return confirm('¿Eliminar este producto?')" title="Eliminar">
                                <i class="bi bi-trash me-1"></i> Eliminar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>
