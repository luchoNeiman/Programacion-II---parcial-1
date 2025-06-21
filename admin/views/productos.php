<?php
$productos = (new Producto)->todosProductos();
?>

<section class="container-fluid mt-5">
    <h1 class="mx-5 mb-4 mt-4 text-white">
        <i class="bi bi-box-seam-fill me-2"></i> Administracion de productos
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
                    <th class="min-th">Fecha de Ingreso</th>
                    <th class="min-th">Título</th>
                    <th class="min-th">Franquicia</th>
                    <th class="min-th">Categoria</th>
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
                        <td><?= htmlspecialchars($producto->getTitulo()); ?></td>
                        <td><?= htmlspecialchars($producto->getNombreFranquicia()); ?></td>
                        <td><?= htmlspecialchars($producto->getCategoria()); ?></td>
                        <td><?= htmlspecialchars($producto->getDescripcion()); ?></td>
                        <td><?= htmlspecialchars($producto->getCaracteristicas()); ?></td>
                        <td><img src="../assets/imgs/productos/<?= $producto->getImagen(); ?>"
                                     alt="<?= htmlspecialchars($producto->getImagenDescripcion()); ?>"
                                     width="150" class="img-thumbnail">
                        </td>
                        <td><?= htmlspecialchars($producto->getImagenDescripcion()); ?></td>
                        <td>$<?= number_format($producto->getPrecio(), 0, ',', '.'); ?></td>
                        <td class=" align-middle">
                            <div class="d-flex justify-content-center gap-2">
                                <!-- Botón Editar -->
                                <a href="index.php?seccion=edicionProducto&id=<?= $producto->getProductoId(); ?>"
                                   class="btn btn-xl btn-dark rounded-circle" title="Editar">
                                    <i class="bi bi-pencil-square fs-5"></i>
                                </a>
                                <!-- Botón Eliminar -->
                                <a href="index.php?seccion=confirmarBajaProducto&id=<?= $producto->getProductoId(); ?>"
                                   class="btn btn-danger rounded-circle d-flex align-items-center justify-content-center shadow-sm"
                                   style="width: 44px; height: 44px;"
                                   data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar producto">
                                    <i class="bi bi-trash3-fill fs-5"></i>
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
                    <h5 class="card-title"><?= htmlspecialchars($producto->getTitulo()); ?></h5>
                    <p><strong>Fecha de Ingreso:</strong> <?= $producto->getFechaIngreso(); ?></p>
                    <p><strong>Precio:</strong> $<?= number_format($producto->getPrecio(), 0, ',', '.'); ?></p>
                    <p><strong>Franquicia:</strong> <?= htmlspecialchars($producto->getNombreFranquicia()); ?></p>
                    <p><strong>Categoria:</strong> <?= htmlspecialchars($producto->getCategoria()); ?></p>
                    <p><strong>Descripción:</strong> <?= nl2br(htmlspecialchars($producto->getDescripcion())); ?></p>
                    <p><strong>Características:</strong> <?= nl2br(htmlspecialchars($producto->getCaracteristicas()));?></p>
                    <img src="../assets/imgs/productos/<?= $producto->getImagen(); ?>"
                         alt="Imagen del producto"
                         class="img-fluid mt-2" style="max-width: 150px;">
                    <p class="text-muted small mt-1"><?= htmlspecialchars($producto->getImagenDescripcion()); ?></p>

                    <div class="mt-3 row gx-2">
                        <div class="col-12 col-sm-6 mb-2 mb-sm-0">
                            <a href="index.php?seccion=edicionProducto&id=<?= $producto->getProductoId(); ?>"
                               class="btn btn-dark w-100 d-flex justify-content-center align-items-center"
                               title="Editar">
                                <i class="bi bi-pencil-square me-1"></i> Editar
                            </a>
                        </div>
                        <div class="col-12 col-sm-6">
                            <a href="index.php?seccion=confirmarBajaProducto&id=<?= $producto->getProductoId(); ?>"
                               class="btn btn-danger w-100 d-flex justify-content-center align-items-center"
                               onclick="return confirm('¿Eliminar este producto?')" title="Eliminar">
                                <i class="bi bi-trash3-fill me-1"></i> Eliminar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>
