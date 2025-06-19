<section class="container mt-5 mb-5">
    <h1 class="mb-4"> <i class="bi bi-plus-lg me-2"></i> Publicar un nuevo producto</h1>

    <div class="card shadow border-0">
        <div class="card-body">
            <form action="../acciones/crearProducto.php" method="post" enctype="multipart/form-data" class="row g-3">

                <div class="col-md-6">
                    <label for="titulo" class="form-label text-secondary-emphasis">Título</label>
                    <input type="text" name="titulo" id="titulo" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label for="precio" class="form-label text-secondary-emphasis">Precio</label>
                    <input type="number" step="0.01" name="precio" id="precio" class="form-control" required>
                </div>
                <div class="col-md-12">
                    <label for="descripcion" class="form-label text-secondary-emphasis">Descripción</label>
                    <textarea name="descripcion" id="descripcion" class="form-control" rows="2" required></textarea>
                </div>
                <div class="col-md-6">
                    <label for="categorias[]" class="form-label text-secondary-emphasis">Categorías</label>
                    <select name="categorias[]" id="categorias" class="form-select" multiple required>

                    </select>
                    <small class="text-muted">Podés seleccionar más de una</small>
                </div>
                <div class="col-md-6">
                    <label for="franquicia_fk" class="form-label text-secondary-emphasis">Franquicia</label>
                    <select name="franquicia_fk" id="franquicia_fk" class="form-select" required>
                        <option value="">Seleccioná una franquicia</option>
                    </select>
                </div>
                <div class="col-md-12">
                    <label for="caracteristicas" class="form-label text-secondary-emphasis">Características</label>
                    <textarea name="caracteristicas" id="caracteristicas" class="form-control" rows="2"></textarea>
                </div>

                <div class="col-md-6">
                    <label for="imagen" class="form-label text-secondary-emphasis">Imagen</label>
                    <input type="file" name="imagen" id="imagen" class="form-control" accept="image/*" required>
                </div>

                <div class="col-md-6">
                    <label for="imagen_descripcion" class="form-label text-secondary-emphasis">Alt imagen</label>
                    <input type="text" name="imagen_descripcion" id="imagen_descripcion" class="form-control">
                </div>
                <div class="col-12 mt-4 d-flex justify-content-center gap-3">
                    <a href="index.php?seccion=productos" class="btn btn-secondary w-25">
                        <i class="bi bi-x-circle me-1"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-dark border-light w-25">
                        <i class="bi bi-check-circle me-1"></i> Guardar producto
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
