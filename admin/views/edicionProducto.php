<section class="container mt-5 mb-5">
  <?php
  $producto = (new Producto)->porId($_GET['id']);
  //variables para los select
  $categorias = (new Categoria)->todasCategorias();
  $franquicias = (new Franquicia)->todasFranquicias();


  //se usa para traer los datos de la tabla pivot de categorias en un array para mostrar
  //las categorias seleccionadas del select
  $categoriasSeleccionadas = (new Categoria)->getCategoriasProductosIds($_GET['id']);


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
    <h1 class="mb-4 text-white"><i class="bi bi-pencil-square me-2 text-white"></i> Editar producto</h1>
    <form action="acciones/editarProducto.php?id=<?= ($producto->getProductoId()) ?>" method="POST"
          enctype="multipart/form-data">
        <div class="card shadow">
            <h2 class="card-header rounded-top-1 bg-dark text-white fs-3">Datos</h2>
            <div class="card-body py-4">
                <div class="row">
                    <div class="col-md-6">
                        <!--Titulo obligatorio tiene q ser menor a 27 caracteres y mayor a 6 caracteres-->
                        <label for="titulo" class="form-label text-violeta  ">Título <span
                                    class="colorRequiaried">*</span></label>
                        <input type="text" name="titulo" id="titulo" class="form-control mb-3"
                               placeholder="Nombre del producto"
                          <?php if (isset($errores['titulo'])): ?>
                              aria-invalid="true"
                              aria-errormessage="error-titulo"
                          <?php endif; ?>
                               value="<?= $dataVieja['titulo'] ?? null ?? $producto->getTitulo(); ?>">
                      <?php if (isset($errores['titulo'])): ?>

                          <!--Muestra el error del titulo-->
                          <div class="msg-error" id="error-titulo"><i
                                      class="bi bi-exclamation-circle-fill text-danger me-3"></i><?= $errores['titulo']; ?>
                          </div>
                      <?php endif; ?>
                    </div>

                    <!--Precio deberia ser solo numerico y mayor a 0 -->
                    <div class="col-md-6">
                        <label for="precio" class="form-label text-violeta  ">Precio<span>*</span></label>
                        <input type="number" step="0.01" name="precio" id="precio" class="form-control"
                               placeholder="0.01"
                          <?php if (isset($errores['precio'])): ?>
                              aria-invalid="true"
                              aria-errormessage="error-precio"
                          <?php endif; ?>
                               value="<?= $dataVieja['precio'] ?? null ?? $producto->getPrecio(); ?>">
                      <?php if (isset($errores['precio'])): ?>
                          <!--Muestra el error de precio-->
                          <div class="msg-error" id="error-precio">
                              <i class="bi bi-exclamation-circle-fill text-danger me-3"></i>
                            <?= $errores['precio']; ?>
                          </div>
                      <?php endif; ?>
                    </div>

                    <!--Descripcion del producto-->
                    <div class="col-md-12">
                        <label for="descripcion" class="form-label text-violeta mt-4 ">Descripción</label>
                        <textarea name="descripcion" id="descripcion" class="form-control" rows="2"
                                  placeholder="Escriba una descripción breve"><?= $dataVieja['descripcion'] ?? null ?? $producto->getDescripcion(); ?></textarea>
                    </div>

                    <!--Caracteristicas -->
                    <div class="col-md-12">
                        <label for="caracteristicas"
                               class="form-label text-violeta mt-4 ">Características</label>
                        <textarea name="caracteristicas" id="caracteristicas" class="form-control" rows="2"
                                  placeholder="Escribe todas las caracteristicas del producto"><?= $dataVieja['caracteristicas'] ?? null ?? $producto->getCaracteristicas(); ?></textarea>
                    </div>
                </div>
            </div>
        </div>

        <!--Categorias son pbligatorias se puede seleccionar mas de una o agregar una nueva o ambas-->
        <!-- Buscar alguna forma para poner cuando selecciona otro se habilite el campo de nueva categoria -->
        <div class="card shadow mt-5">
            <h2 class="card-header rounded-top-1 bg-dark text-white fs-3">Categorias</h2>
            <div class="card-body py-4">
                <div class="row">
                    <div class="col-md-6">
                        <label for="categoria_fk" class="form-label text-violeta">Seleccioná las categorías
                            <span class="colorRequiaried">*</span>
                        </label>

                        <select name="categoria_fk[]" id="categoria_fk" class="form-select mb-2" multiple
                          <?php if (isset($errores['categoria_fk'])): ?>
                              aria-invalid="true"
                              aria-errormessage="error-categoria_fk"
                          <?php endif; ?>>

                            <!-- Por cada categoría en el array $categorias... -->
                            <!-- Se establece el valor de la opción como el ID de la categoría -->
                          <?php foreach ($categorias as $categoria): ?>
                              <option value="<?= $categoria['categoria_id'] ?>" <?= in_array($categoria['categoria_id'], $categoriasSeleccionadas) ? 'selected' : '' ?>>
                                  <!-- Si hay datos viejos de categorías seleccionadas, y
                                   el ID de esta categoría está entre ellas,
                                   se marca la opción como seleccionada (atributo "selected") -->
                                <?= htmlspecialchars($categoria['nombre_categoria']) ?>
                              </option>

                              <!-- Por cada categoría en el array $categorias... -->
                              <!-- Se establece el valor de la opción como el ID de la categoría -->
                          <?php endforeach; ?>
                        </select>
                        <small>*Usá "Ctrl + clic" para seleccionar varias o para desmarcar
                            todas.</small>
                    </div>

                    <!--Se agregan nuevas categorias si no esta en la lista-->
                    <!--Plantearse en otra instancia mas adelante la posibilidad de editar y eliminar categorias-->
                    <div class="col-md-6">
                        <label for="nueva_categoria" class="form-label text-violeta  ">
                            Nueva categoría
                        </label>
                        <input id="nueva_categoria" type="text" name="nueva_categoria" class="form-control"
                               placeholder="Ingresá una nueva categoría si no figura en la lista"
                               value="<?= $dataVieja['nueva_categoria'] ?? null; ?>">
                      <?php if (isset($errores['categorias'])): ?>

                          <!--Aca se muestran los erroes de las categorias obligando a q cree una nueva categoria o seleccione una-->
                          <div class="msg-error" id="error-categorias"><i
                                      class="bi bi-exclamation-circle-fill text-danger me-3"></i><?= $errores['categorias']; ?>
                          </div>
                      <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!--Franquicias del producto. solo puede haber una franquicia o sino puede crear una nueva-->
        <div class="card shadow mt-5">
            <h2 class="card-header rounded-top-1 bg-dark text-white fs-3">Franquicias</h2>
            <div class="card-body py-4">
                <div class="row">
                    <div class="col-md-6 ">
                        <label for="franquicia_fk" class="form-label text-violeta"> Selecciona una franquicia<span
                                    class="colorRequiaried">*</span></label>
                        <div class="position-relative">
                            <select name="franquicia_fk" id="franquicia_fk" size="4"
                                    class="form-select" <?php if (isset($errores['franquicias'])): ?>
                                aria-invalid="true"
                                aria-errormessage="error-franquicias"
                            <?php endif; ?>>
                                <option value=" <?= empty($dataVieja['franquicia_fk']) ? 'selected' : '' ?>">Nueva
                                    franquicia
                                </option>
                              <?php foreach ($franquicias as $franquicia): ?>
                                  <option value="<?= $franquicia['franquicia_id'] ?>"
                                    <?= (
                                      (isset($dataVieja['franquicia_fk']) && $dataVieja['franquicia_fk'] == $franquicia['franquicia_id']) ||
                                      (!isset($dataVieja['franquicia_fk']) && $producto->getFranquiciaFk() == $franquicia['franquicia_id'])
                                    ) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($franquicia['nombre_franquicia']) ?>
                                  </option>
                              <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <!--A futuro habilitar este campó cuando selecciona nueva franquicia(hacerlo con js)-->
                    <!--por ahora solo valido q selecciono nueva franquicia en el select-->
                    <div class="col-md-6">
                        <label for="nueva_franquicia" class="form-label text-violeta  ">Nueva
                            franquicia</label>
                        <input id="nueva_franquicia" type="text" name="nueva_franquicia" class="form-control"
                               placeholder="Ingresá una nueva franquicia si no figura en la lista"
                               value="<?= $dataVieja['nueva_franquicia'] ?? null; ?>">
                        <small class="text-muted">
                            *Solo completá este campo si seleccionaste "Nueva franquicia".
                        </small>
                      <?php if (isset($errores['franquicia'])): ?>
                          <div class="msg-error mt-1" id="error-franquicia">
                              <i class="bi bi-exclamation-circle-fill text-danger"></i>
                            <?= $errores['franquicia']; ?>
                          </div>
                      <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <!--Imagenes del producto-->
        <div class="card shadow mt-5 ">
            <h2 class="card-header rounded-top-1 bg-dark text-white fs-3">Imagenes</h2>
            <div class="card-body py-4">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="imagen" class="form-label text-violeta  ">Imagen</label>
                                <input type="file" name="imagen" id="imagen" class="form-control"
                                       accept="image/*" <?php if (isset($errores['imagen'])): ?>
                                    aria-invalid="true"
                                    aria-errormessage="error-imagen"
                                    value=""
                                <?php
                                endif;
                                ?>
                                  <?= $dataVieja['imagen'] ?? null; ?>>
                              <?php if (isset($errores['imagen'])): ?>
                                  <div class="msg-error" id="error-imagen"><i
                                              class="bi bi-exclamation-circle-fill text-danger me-3"></i><?= $errores['imagen']; ?>
                                  </div>
                              <?php endif; ?>
                            </div>

                            <div class="col-12 ">
                                <label for="imagen_descripcion" class="form-label text-violeta  ">Descripción de
                                    la
                                    imagen</label>
                                <input type="text" name="imagen_descripcion" id="imagen_descripcion"
                                       class="form-control"
                                       placeholder="Escribe una breve descripción"
                                       value="<?= $dataVieja['imagen_descripcion'] ?? null ?? $producto->getImagenDescripcion(); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <p class="m-1 text-violeta">Imagen actual</p>
                      <?php if ($producto->getImagen() !== null): ?>
                          <img src="../assets/imgs/productos/<?= $dataVieja['imagen'] ?? null ?? htmlspecialchars($producto->getImagen()); ?>"
                               alt="Imagen actual"
                               class="imagen-producto img-fluid rounded border w-25">
                      <?php else: ?>
                          <img src="../assets/imgs/productos/default.png"
                               alt="Imagen actual"
                               class="imagen-producto img-fluid rounded border w-25">
                      <?php endif; ?>
                    </div>

                </div>

            </div>
        </div>
        <div class="pt-4 mt-4 border-top d-flex justify-content-center gap-3">
            <a href="index.php?seccion=productos"
               class="btn btn-light border-light px-4 py-2 fs-6"
               onclick="return confirm('¿Estás seguro que querés cancelar? Se perderán los cambios.')">
                <i class="bi bi-x-circle me-1 text-dark"></i> Cancelar
            </a>
            <button type="submit"
                    class="btn btn-dark border-light px-4 py-2 fs-6">
                <i class="bi bi-check-circle me-1"></i> Guardar producto
            </button>

        </div>

    </form>
</section>
