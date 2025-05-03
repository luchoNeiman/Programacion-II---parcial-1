<?php
require_once __DIR__ . '/../classes/Producto.php';
$id = $_GET['id'];
$producto = (new Producto)->porId($id);
?>

<article class="news-item">
    <div class="news-item_content">
        <h1><?= $producto->titulo;?></h1>
        <p><?= $producto->descripcion;?></p>
    </div>
    <picture class="news-item_imagen">
        <img src="assets/imgs/<?= $producto->imagen;?>" alt="<?= $producto->imagen_descripcion;?>">
    </picture>

    <div><?= $producto->precio;?></div>
</article>