<section class="container mt-5 mb-5 d-flex align-items-center justify-content-center">
    <div class="row w-100 justify-content-center">
        <div class="col-12 col-sm-10 col-md-8 col-lg-5">
            <h1 class="text-center mb-4 text-white">
                <i class="bi bi-person-circle me-1 text-white"></i> ¡Registrate y no te pierdas nuestra ofertas!
            </h1>
            <form action="acciones/crear-cuenta.php" method="POST" class="card shadow p-4 border-0">
                <div class="mb-3">
                    <label for="nombre" class="form-label text-violeta">Nombre Completo</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required autofocus>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label text-violeta">Correo electrónico</label>
                    <input type="email" class="form-control" id="email" name="email" required autofocus>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label text-violeta">Confirmar Correo electrónico</label>
                    <input type="email" class="form-control" id="emailconfirmed" name="emailconfirmed" required autofocus>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label text-violeta">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label text-violeta">Confirmar Contraseña</label>
                    <input type="password" class="form-control" id="passwordconfirmed" name="passwordconfirmed" required>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-dark">
                        <i class="bi bi-box-arrow-in-right me-1"></i> Registrarse  
                        <!-- cambiar icono -->
                    </button>
                </div>
                <small class="mt-1">
                    ¿ya tienes cuenta? <a class="text-decoration-none " href="index.php?seccion=iniciar-sesion"><strong class="text-violeta">Iniciar sesión</strong></a>  
                    <!-- para cuando cree el registro cambiar el href del a -->
                </small>
            </form>
        </div>
    </div>
</section>