<?php
/* require_once __DIR__ . '/../bibliotecas/productos.php'; */
 require_once __DIR__ . '/../classes/Producto.php';

/* $productos = obtenerproductos(); */
// Esta línea crea una nueva instancia de la clase Producto y llama al método todosProductos() para obtener la lista de todos los productos.
$productos = (new Producto)->todosProductos();
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
                        <a href="index.php?seccion=detalle-producto&id=<?= $producto->producto_id;?>">
                            <h2><?= $producto->titulo;?></h2>
                        </a>
                        <p><?= $producto->descripcion;?></p>
                    </div>
                </article>
            </div>
        <?php
        endforeach;
        ?>
    </div>
</section>