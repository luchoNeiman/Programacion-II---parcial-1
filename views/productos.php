<?php
require_once __DIR__ . '/../bibliotecas/productos.php';

$productos = obtenerproductos();
?>
<section class="news">
    <div>
        <h1>Últimas productos</h1>
        <p class="news-lead">Qué está pasando.</p>
    </div>
    <div class="news-list">
        <?php
        foreach ($productos as $producto):
        ?>
            <div class="card">
                <article class="news-item">
                    <div class="news-item_content card-body">
                        <a href="index.php?seccion=detalle-producto&id=<?= $producto->producto_id ?>">
                            <h2><?= $producto->titulo ?></h2>
                        </a>
                        <p><?= $producto->descripcion ?></p>
                    </div>
                </article>
            </div>
        <?php
        endforeach;
        ?>
    </div>
</section>