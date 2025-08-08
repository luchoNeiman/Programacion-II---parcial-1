<?php $productos = (new Producto)->todosProductos(); ?>
<?php $usuarios = (new Usuario)->traerUsuarios(); ?>
<section class="container mt-5">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center text-white mb-4">
                <i class="bi bi-speedometer2 text-white"></i> Panel de Administración
            </h1>
        </div>
    </div>

    <div class="row justify-content-center g-4">
        <div class="col-md-4">
            <div class="card h-100 shadow border-0">
                <div class="card-body text-center">
                    <i class="bi bi-box-seam display-4 text-secondary-emphasis"></i>
                    <h5 class="card-title text-violeta my-3"><?= count($productos) ?> Productos</h5>
                    <a href="index.php?seccion=productos" class="btn btn-dark">
                        <i class="bi bi-arrow-right-circle me-2"></i>Gestionar
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 shadow border-0">
                <div class="card-body text-center">
                    <i class="bi bi-plus-circle display-4 text-secondary-emphasis"></i>
                    <h5 class="card-title my-3 text-violeta">Nuevo Producto</h5>
                    <a href="index.php?seccion=nuevoProducto" class="btn btn-dark">
                        <i class="bi bi-plus-lg me-2"></i>Crear
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 shadow border-0">
                <div class="card-body text-center">
                    <i class="bi bi-person display-4 text-secondary-emphasis"></i>
                    <h5 class="card-title text-violeta my-3"><?= count($usuarios) ?> Usuarios</h5>
                    <a href="index.php?seccion=registroUsuarios" class="btn btn-dark">
                        <i class="bi bi-person me-2"></i>Ver Usuarios registrados
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>