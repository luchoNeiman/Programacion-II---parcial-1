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

    <form action="../admin/acciones/crearProducto.php" method="post">
        <div class="card shadow  border-0">
            <div class="card-body py-4">
                <div class="row">
                    <div class="col-md-6">
                        <label for="titulo" class="form-label text-violeta  ">Título <span class="colorRequiaried">*</span></label>
                        <input type="text" name="titulo" id="titulo" class="form-control"
                               placeholder="Nombre del producto"
                            <?php if (isset($errores['titulo'])): ?>
                                aria-invalid="true"
                                aria-errormessage="error-titulo"
                            <?php
                            endif;
                            ?>
                               value="<?= $dataVieja['titulo'] ?? null; ?>"
                        >
                        <?php
                        if (isset($errores['titulo'])):
                            ?>
                            <div class="msg-error" id="error-titulo"><i
                                        class="bi bi-exclamation-circle-fill text-danger me-3"></i><?= $errores['titulo']; ?>
                            </div>
                        <?php
                        endif;
                        ?>
                    </div>

                    <div class="col-md-6">
                        <label for="precio" class="form-label text-violeta  ">Precio<span>*</span></label>
                        <input type="number" step="0.01" name="precio" id="precio" class="form-control"
                               placeholder="0.01"
                            <?php if (isset($errores['precio'])): ?>
                                aria-invalid="true"
                                aria-errormessage="error-precio"
                            <?php
                            endif;
                            ?>
                               value="<?= $dataVieja['precio'] ?? null; ?>">
                        <?php
                        if (isset($errores['precio'])):
                            ?>
                            <div class="msg-error" id="error-precio">
                                <i class="bi bi-exclamation-circle-fill text-danger me-3"></i>
                                <?= $errores['precio']; ?>
                            </div>
                        <?php
                        endif;
                        ?>
                    </div>
                    <div class="col-md-12">
                        <label for="descripcion" class="form-label text-violeta mt-4 ">Descripción</label>
                        <textarea name="descripcion" id="descripcion" class="form-control" rows="2"
                                  placeholder="Escriba una descripción breve"></textarea>
                    </div>
                    <div class="col-md-12">
                        <label for="caracteristicas"
                               class="form-label text-violeta mt-4 ">Características</label>
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
                        <label for="categorias" class="form-label text-violeta  ">Categorías<span
                                    class="colorRequiaried">*</span></label>
                        <select name="categorias[]" id="categorias"
                                class="form-select" multiple
                            <?php if (isset($errores['categorias'])): ?>
                                aria-invalid="true"
                                aria-errormessage="error-categorias"
                            <?php endif; ?>
                        >
                            <?php foreach ($categorias as $categoria): ?>
                                <option value="<?= $categoria['categoria_id'] ?>"
                                    <?= (isset($dataVieja['categorias']) && in_array($categoria['categoria_id'], $dataVieja['categorias'])) ? 'selected' : '' ?>
                                >
                                    <?= htmlspecialchars($categoria['nombre_categoria']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>


                        <small class="text-muted">Podés seleccionar más de una opción(ctrl + click)</small>
                    </div>
                    <div class="col-md-6">
                        <label for="nueva_categoria" class="form-label text-violeta  ">
                            Nueva categoría
                        </label>
                        <input id="nueva_categoria" type="text" name="nueva_categoria"  class="form-control"
                               placeholder="Ingresá una nueva categoría si no figura en la lista">
                        <?php if (isset($errores['categorias'])): ?>
                            <div class="msg-error" id="error-categorias"><i
                                        class="bi bi-exclamation-circle-fill text-danger me-3"></i><?= $errores['categorias']; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="card shadow mt-5 border-0">
            <div class="card-body py-4">
                <div class="row">
                    <div class="col-md-6">
                        <label for="franquicia_fk" class="form-label text-violeta"> Franquicias<span
                                    class="colorRequiaried">*</span></label>
                        <div class="position-relative">
                            <select name="franquicia_fk" id="franquicia_fk" size="4"
                                    class="form-select" <?php if (isset($errores['franquicias'])): ?>
                                aria-invalid="true"
                                aria-errormessage="error-franquicias"
                            <?php endif; ?>>
                                <option value="" disabled>Seleccione franquicia</option>
                                <?php foreach ($franquicias as $franquicia): ?>
                                    <option value="<?= $franquicia['franquicia_id'] ?>"
                                        <?= (isset($dataVieja['franquicia_fk']) && $dataVieja['franquicia_fk'] == $franquicia['franquicia_id']) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($franquicia['nombre_franquicia']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>

                            <?php if (isset($errores['franquicia'])): ?>
                                <i class="bi bi-exclamation-circle-fill text-danger position-absolute top-50 end-0 translate-middle-y me-3"></i>
                            <?php endif; ?>
                        </div>

                        <?php if (isset($errores['franquicia'])): ?>
                            <div class="msg-error mt-1" id="error-franquicia">
                                <?= $errores['franquicia']; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-6">
                        <label for="nueva_franquicia" class="form-label text-violeta  ">Nueva
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
                        <label for="imagen" class="form-label text-violeta  ">Imagen</label>
                        <input type="file" name="imagen" id="imagen" class="form-control" accept="image/*">
                    </div>

                    <div class="col-md-6">
                        <label for="imagen_descripcion" class="form-label text-violeta  ">Descripción de la
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

<script>
    // Espera 10 segundos y oculta errores + íconos
    setTimeout(() => {
        document.querySelectorAll('.msg-error').forEach(el => {
            el.style.transition = 'opacity 0.5s ease';
            el.style.opacity = 0;
            setTimeout(() => el.remove(), 500);
        });

        document.querySelectorAll('.bi-exclamation-circle-fill').forEach(icon => {
            icon.style.transition = 'opacity 0.5s ease';
            icon.style.opacity = 0;
            setTimeout(() => icon.remove(), 500);
        });
    }, 5000); // 10 segundos
</script>


