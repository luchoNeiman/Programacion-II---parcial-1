<?php
$productos = (new Producto)->todosProductos();
?>
<!--Idea a furuto poner un filtro collapsible para buscar por categoria o por franquicia y poner un paginador-->
<section class="container-fluid mt-5">
    <div class="mx-5 mb-4 pt-5 d-flex flex-wrap align-items-center justify-content-between">
        <h1 class="text-white m-0 d-flex align-items-center mb-1">
            <i class="bi bi-box-seam-fill me-2"></i> Administración de productos
        </h1>
        <a href="index.php?seccion=nuevoProducto" class="btn btn-dark border-light me-1">
            <i class="bi bi-plus-circle me-2"></i> Nuevo producto
        </a>
    </div>

    <!-- Tabla para escritorio -->
    <div class="mx-5 mb-5 card border-5 shadow-sm d-none d-md-block">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover mi-tabla-violeta mb-0">
                <thead class="table-dark">
                <tr>
                    <th class="min-th">Fecha de Ingreso</th>
                    <th class="min-th">Título</th>
                    <th class="min-th">Franquicia</th>
                    <th class="min-th">Categoria</th>
                    <th>Imagen</th>
                    <th class="text-center">Precio</th>
                    <th class="min-th text-center">Acciones</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($productos as $producto): ?>
                    <tr>
                        <td class="align-middle"><?= $producto->getFechaIngreso(); ?></td>
                        <td class="align-middle"><?= htmlspecialchars($producto->getTitulo()); ?></td>
                        <td class="align-middle"><?= htmlspecialchars($producto->getNombreFranquicia()); ?></td>
                        <td class="align-middle"><?= htmlspecialchars($producto->getCategoria()); ?></td>
                        <td class="align-middle"><img
                            src="../assets/imgs/productos/<?= $producto->getImagen() ?? 'default.png'; ?>"
                            alt="<?= htmlspecialchars($producto->getImagenDescripcion()); ?>"
                            width="50" class="img-thumbnail">
                        </td>
                        <td class="align-middle text-end">
                            $<?= number_format($producto->getPrecio(), 2, ',', '.'); ?></td>
                        <td class=" align-middle">
                            <div class="d-flex justify-content-center gap-2">
                                <!-- Botón ver -->
                                <a href="index.php?seccion=verProducto&id=<?= $producto->getProductoId(); ?>"
                                   class="btn btn-xl btn-dark rounded-circle" title="Ver">
                                    <i class="bi bi-eye "></i>
                                </a>
                                <!-- Botón Editar -->
                                <a href="index.php?seccion=edicionProducto&id=<?= $producto->getProductoId(); ?>"
                                   class="btn btn-xl btn-dark rounded-circle" title="Editar">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <!-- Botón Eliminar -->
                                <a href="index.php?seccion=confirmarBajaProducto&id=<?= $producto->getProductoId(); ?>"
                                   class="btn btn-danger rounded-circle d-flex align-items-center justify-content-center shadow-sm"

                                   data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar producto">
                                    <i class="bi bi-trash3-fill "></i>
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
    <div class="d-block d-md-none mx-3 mt-4">
        <?php foreach ($productos as $producto): ?>
            <div class="card mb-4 shadow-sm p-2">
                <div class="card-body">
                    <h5 class="card-title fw-bold"><?= htmlspecialchars($producto->getTitulo()); ?></h5>
                    <p><strong class="text-violeta">Fecha de Ingreso:</strong> <?= $producto->getFechaIngreso(); ?></p>
                    <p><strong class="text-violeta">Precio:</strong>
                        $<?= number_format($producto->getPrecio(), 0, ',', '.'); ?></p>
                    <p>
                        <strong class="text-violeta">Franquicia:</strong> <?= htmlspecialchars($producto->getNombreFranquicia()); ?>
                    </p>
                    <p>
                        <strong class="text-violeta">Categoria:</strong> <?= htmlspecialchars($producto->getCategoria()); ?>
                    </p>

                    <img src="../assets/imgs/productos/<?= $producto->getImagen() ?? 'default.png'; ?>"
                         alt="Imagen del producto"
                         class="img-fluid mt-2">

                    <div class="mt-3 row gx-2">
                        <div class="col-12 col-sm-4 mb-2">
                            <a href="index.php?seccion=verProducto&id=<?= $producto->getProductoId(); ?>"
                               class="btn btn-dark w-100 d-flex justify-content-center align-items-center"
                               title="Editar">
                                <i class="bi bi-eye me-2 "></i> Ver
                            </a>
                        </div>
                        <div class="col-12 col-sm-4 mb-2">
                            <a href="index.php?seccion=edicionProducto&id=<?= $producto->getProductoId(); ?>"
                               class="btn btn-dark w-100 d-flex justify-content-center align-items-center"
                               title="Editar">
                                <i class="bi bi-pencil-square me-2 "></i> Editar
                            </a>
                        </div>
                        <div class="col-12 col-sm-4">
                            <a href="index.php?seccion=confirmarBajaProducto&id=<?= $producto->getProductoId(); ?>"
                               class="btn btn-danger w-100 d-flex justify-content-center align-items-center"

                               data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar producto">
                                <i class="bi bi-trash3-fill me-2"></i> Eliminar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>
