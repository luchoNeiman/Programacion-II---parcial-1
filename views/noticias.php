<?php
require_once __DIR__ . '/../bibliotecas/noticias.php';
// Traemos las noticias.
$noticias = obtenerNoticias();
?>
<section class="news">
    <div>
        <h1>Últimas noticias</h1>
        <p class="news-lead">Qué está pasando.</p>
    </div>
    <div class="news-list">
    <?php
    foreach($noticias as $noticia):
    ?>
        <div class="card">
            <article class="news-item">
                <div class="news-item_content card-body">
                    <a href="index.php?seccion=noticias-leer&id=<?= $noticia->noticia_id;?>"><h2><?= $noticia->titulo;?></h2></a>
                    <p><?= $noticia->sinopsis;?></p>
                </div>
                <picture class="news-item_imagen">
                    <source srcset="imgs/big-<?= $noticia->imagen;?>" media="all and (min-width: 46.875em)">
                    <img src="imgs/<?= $noticia->imagen;?>" alt="<?= $noticia->imagen_descripcion;?>">
                </picture>
            </article>
        </div>
    <?php
    endforeach;
    ?>
    </div>
</section>