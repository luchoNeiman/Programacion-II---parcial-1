<?php
$categorias = (new Categoria)->todasCategorias();
$franquicias = (new Franquicia)->todasFranquicias();
$producto = (new Producto())->porId($_GET['id']);
$categoriasSeleccionadas = $producto->getCategoriasIds();

// Recibimos los mensajes de error, si es que los hay.
if (isset($_SESSION['errores'])) {
    $errores = $_SESSION['errores'];
    unset($_SESSION['errores']);
} else {
    $errores = [];
}

if (isset($_SESSION['data_vieja'])) {
    $dataVieja = $_SESSION['data_vieja'];
    unset($_SESSION['data_vieja']);
} else {
    $dataVieja = [];
}
?>
<section class="container mt-5 mb-5">
    <h1 class="mb-4 text-white"><i class="bi bi-pencil-square me-2 text-white"></i> Editar producto</h1>

    <form action="acciones/editarProducto.php?id=<?= $producto->getProductoId(); ?>" method="post" enctype="multipart/form-data">
        <div class="card shadow border-0">
            <div class="card-body py-4">
                <div class="row">
                    <div class="col-md-6">
                        <label for="titulo" class="form-label ">Título</label>
                        <input type="text" name="titulo" id="titulo" class="form-control"
                               value="<?= $producto->getTitulo(); ?>">
                    </div>

                    <div class="col-md-6">
                        <label for="precio" class="form-label ">Precio</label>
                        <input type="number" step="0.01" name="precio" id="precio" class="form-control"
                               value="<?= $producto->getPrecio(); ?>">
                    </div>

                    <div class="col-md-12">
                        <label for="descripcion" class="form-label mt-4 ">Descripción</label>
                        <textarea name="descripcion" id="descripcion" class="form-control" rows="2"
                                  placeholder="Escriba una descripción breve"
                                  required><?= $producto->getDescripcion(); ?></textarea>
                    </div>
                    <div class="col-md-12">
                        <label for="caracteristicas"
                               class="form-label mt-4 ">Características</label>
                        <textarea name="caracteristicas" id="caracteristicas" class="form-control" rows="4"
                                  placeholder="Escribe todas las caracteristicas del producto"><?= $producto->getCaracteristicas(); ?></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="card shadow mt-5 border-0">
            <div class="card-body py-4">
                <div class="row">
                    <div class="col-md-6">
                        <label for="categorias" class="form-label  ">Categorías</label>
                        <select name="categorias[]" id="categorias" class="form-select" multiple>
                            <option value="" disabled>Seleccione Categoria</option>
                            <?php foreach ($categorias as $categoria): ?>
                                <option value="<?= $categoria['categoria_id'] ?>"
                                    <?= in_array($categoria['categoria_id'], $categoriasSeleccionadas) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($categoria['nombre_categoria']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <small class="text-muted">Podés seleccionar más de una opción(ctrl + click)</small>
                    </div>
                    <div class="col-md-6">
                        <label for="nueva_categoria" class="form-label  ">
                            Nueva categoría
                        </label>
                        <input id="nueva_categoria" type="text" name="nueva_categoria" class="form-control"
                               placeholder="Ingresá una nueva categoría si no figura en la lista">
                    </div>
                </div>
            </div>
        </div>
        <div class="card shadow mt-5 border-0">
            <div class="card-body py-4">
                <div class="row">
                    <div class="col-md-6">
                        <label for="franquicia_fk" class="form-label  ">
                            Franquicias
                        </label>
                        <select name="franquicia_fk" id="franquicia_fk" class="form-select">
                            <option class="text-dark" value="">Seleccione franquicia</option>
                            <?php foreach ($franquicias as $franquicia): ?>
                                <option value="<?= $franquicia['franquicia_id'] ?>" <?= $producto->getFranquiciaFk() == $franquicia['franquicia_id'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($franquicia['nombre_franquicia']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="nueva_franquicia" class="form-label  ">Nueva
                            franquicia</label>
                        <input id="nueva_franquicia" type="text" name="nueva_franquicia" class="form-control"
                               placeholder="Ingresá una nueva franquicia si no figura en la lista">
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow mt-5 border-0">
            <div class="card-body py-4">
                <div class="row">
                    <div class="col-md-6">
                        <label for="imagen" class="form-label ">Imagen</label>
                        <input type="file" name="imagen" id="imagen" class="form-control" accept="image/*">
                        <?php if ($producto->getImagen()): ?>
                            <small class="text-muted">Imagen actual: <?= $producto->getImagen(); ?></small>
                        <?php endif; ?>
                    </div>

                    <div class="col-md-6">
                        <label for="imagen_descripcion" class="form-label ">Alt imagen</label>
                        <input type="text" name="imagen_descripcion" id="imagen_descripcion" class="form-control"
                               value="<?= $producto->getImagenDescripcion(); ?>">
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 mt-4 d-flex flex-sm-row justify-content-end gap-3">
                <a href="index.php?seccion=productos" class="btn btn-light border-light w-50"
                   onclick="return confirm('¿Estás seguro que querés cancelar? Se perderán los cambios.')">
                    <i class="bi bi-x-circle me-1 text-dark"></i> Cancelar
                </a>
                <button type="submit" class="btn btn-dark border-light w-50">
                    <i class="bi bi-check-circle me-1"></i> Actualizar producto
                </button>
            </div>
        </div>

    </form>
</section>
