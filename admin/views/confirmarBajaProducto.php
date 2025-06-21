<?php
$producto = (new Producto)->porId($_GET['id']);
?>
<section>
    <h1>Confirmación necesaria para eliminar producto</h1>

    <p>Estás por eliminar el producto <b><?= htmlspecialchars($producto->getTitulo());?></b> del sistema. A continuación se muestran los detalles del producto.</p>
    <p>¿Estás seguro que querés continuar? Esta acción es <b>irreversible</b>.</p>

    <hr class="mb-1">

    <article class="news-item">
        <div class="news-item_content">
            <h2><?= htmlspecialchars($producto->getTitulo());?></h2>
            <p><?= htmlspecialchars($producto->getCaracteristicas());?></p>
        </div>
        <picture class="news-item_imagen">
            <source srcset="imgs/big-<?= $producto->getImagen();?>" media="all and (min-width: 46.875em)">
            <img src="imgs/<?= $producto->getImagen();?>" alt="<?= htmlspecialchars($producto->getImagenDescripcion());?>">
        </picture>

        <div><?= htmlspecialchars($producto->getDescripcion());?></div>
    </article>

    <hr class="mb-1">

    <form action="../acciones/eliminarProducto.php?id=<?= $producto->getProductoId();?>" method="post">
        <button type="submit" class="button">Sí, confirmar la eliminación de `<?= htmlspecialchars($producto->getTitulo());?>`</button>
    </form>
</section>