<?php
require_once __DIR__ . '/../../classes/Producto.php';

$productos = (new Producto)->todosProductos();
?>
<section class="container-fluid mt-5">
    <h1 class="mx-5">Administrar productos</h1>

    <div class="mx-5 card border-5">
        <table class="table table-bordered table-striped table-hover mb-0">
            <thead class="table-dark">
            <tr>
                <th>Fecha</th>
                <th>Título</th>
                <th>Descripción</th>
                <th>Características</th>
                <th>Precio</th>
                <th>Franquicia</th>
                <th>Imagen</th>
                <th>Alt imagen</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($productos as $producto): ?>
                <tr>
                    <td><?= $producto->getFechaIngreso(); ?></td>
                    <td><?= $producto->getTitulo(); ?></td>
                    <td><?= $producto->getDescripcion(); ?></td>
                    <td><?= $producto->getCaracteristicas(); ?></td>
                    <td>$<?= number_format($producto->getPrecio(), 2, ',', '.'); ?></td>
                    <td><?= $producto->getNombreFranquicia(); ?></td>
                    <td>
                        <?php if ($producto->getImagen()): ?>
                            <img src="../assets/imgs/productos/<?= $producto->getImagen(); ?>"
                                 alt="<?= $producto->getImagenDescripcion(); ?>" width="60">
                        <?php else: ?>
                            <span>Sin imagen</span>
                        <?php endif; ?>
                    </td>
                    <td><?= $producto->getImagenDescripcion(); ?></td>
                    <td>
                        <!-- Botones de acción -->
                        <a href="editarProducto.php?id=<?= $producto->getProductoId(); ?>"
                           class="btn btn-sm btn-warning">Editar</a>
                        <a href="producto-eliminar.php?id=<?= $producto->getProductoId(); ?>"
                           class="btn btn-sm btn-danger"
                           onclick="return confirm('¿Seguro que querés eliminar este producto?')">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

    </div>
</section>