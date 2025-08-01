<?php
$producto = (new Producto)->porId($_GET['id']);
?>
<section class="baja-section container mt-5">
    <h1 class="baja-header">¿Estás seguro que deseas eliminar este producto?</h1>

    <hr class="mb-1">

    <article class="baja-article">
        <figure>
            <img class="baja-img" src="../assets/imgs/productos/<?= $producto->getImagen() ?? 'default.png'; ?>"
                 alt="<?= htmlspecialchars($producto->getImagenDescripcion()); ?>">
        </figure>

        <div class="baja-details">
            <h2 class="baja-product-title"><?= htmlspecialchars($producto->getTitulo()) ?></h2>
            <p class="baja-product-desc"><?= htmlspecialchars($producto->getDescripcion()) ?></p>
            <span class="baja-product-price">$<?= number_format($producto->getPrecio(), 2) ?></span>
        </div>
    </article>

    <hr class="mb-1">

    <form action="acciones/eliminarProducto.php?id=<?= $producto->getProductoId(); ?>" method="post" class="baja-form">
        <input type="hidden" name="producto_id" value="<?= $producto->getProductoId() ?>">
        <a href="index.php?seccion=productos" class="baja-btn-cancelar">Cancelar</a>
        <button type="submit" name="confirmar" class="baja-btn-confirmar">Sí, eliminar</button>
    </form>
</section>