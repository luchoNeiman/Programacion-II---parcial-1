<?php
$categorias = (new Categoria)->todasCategorias();
$franquicias = (new Franquicia)->todasFranquicias();

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
    <h1 class="mb-4 text-white"><i class="bi bi-plus-lg me-2 text-white"></i> Nuevo producto</h1>

    <form action="acciones/crearProducto.php" method="post">
        <div class="card shadow  border-0">
            <div class="card-body py-4">
                <div class="row">
                    <div class="col-md-6">
                        <label for="titulo" class="form-label  ">Título</label>
                        <input type="text" name="titulo" id="titulo" class="form-control"
                               placeholder="Nombre del producto">
                    </div>

                    <div class="col-md-6">
                        <label for="precio" class="form-label  ">Precio</label>
                        <input type="number" step="0.01" name="precio" id="precio" class="form-control"
                               placeholder="0.01">
                    </div>
                    <div class="col-md-12">
                        <label for="descripcion" class="form-label mt-4 ">Descripción</label>
                        <textarea name="descripcion" id="descripcion" class="form-control" rows="2"
                                  placeholder="Escriba una descripción breve"></textarea>
                    </div>
                    <div class="col-md-12">
                        <label for="caracteristicas"
                               class="form-label mt-4 ">Características</label>
                        <textarea name="caracteristicas" id="caracteristicas" class="form-control" rows="2"
                                  placeholder="Escribe todas las caracteristicas del producto"></textarea>
                    </div>

                </div>
            </div>
        </div>
        <div class="card shadow mt-5 border-0">
            <div class="card-body py-4">
                <div class="row">
                    <div class="col-md-6">
                        <label for="categorias" class="form-label  ">Categorías</label>
                        <select name="categorias[]" id="categorias" class="form-select " multiple>
                            <?php foreach ($categorias as $categoria): ?>
                                <option class="text-secondary" value="<?= $categoria['categoria_id'] ?>">
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
                                <option class="text-secondary" value="<?= $franquicia['franquicia_id'] ?>">
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
                        <label for="imagen" class="form-label  ">Imagen</label>
                        <input type="file" name="imagen" id="imagen" class="form-control" accept="image/*">
                    </div>

                    <div class="col-md-6">
                        <label for="imagen_descripcion" class="form-label  ">Descripción de la
                            imagen</label>
                        <input type="text" name="imagen_descripcion" id="imagen_descripcion" class="form-control"
                               placeholder="Escribe una breve descripción">
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
                    <i class="bi bi-check-circle me-1"></i> Guardar producto
                </button>
            </div>
        </div>

    </form>
</section>
