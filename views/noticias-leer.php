<?php
require_once __DIR__ . '/../bibliotecas/noticias.php';
$id = $_GET['id']; // Recibimos el id de la noticia que nos piden mostrar.
$noticia = obtenerNoticiaPorId($id);
?>
<article class="news-item">
    <div class="news-item_content">
        <h1><?= $noticia->titulo;?></h1>
        <p><?= $noticia->sinopsis;?></p>
    </div>
    <picture class="news-item_imagen">
        <source srcset="imgs/big-<?= $noticia->imagen;?>" media="all and (min-width: 46.875em)">
        <img src="imgs/<?= $noticia->imagen;?>" alt="<?= $noticia->imagen_descripcion;?>">
    </picture>

    <div><?= $noticia->cuerpo;?></div>
</article>