<section class="container mt-5 d-flex align-items-center justify-content-center">
    <div class="row w-100 justify-content-center">
        <div class="col-12 col-sm-10 col-md-8 col-lg-5">
            <h1 class="text-center mb-4 text-white">
                <!-- <i class="bi bi-shield-lock-fill me-2 text-white"></i> Iniciar sesión en tu cuenta -->
                <i class="bi bi-person-circle me-1 text-white"></i> Iniciar sesión en tu cuenta
            </h1>
            <form action="acciones/procesar_iniciar-sesion.php" method="POST" class="card shadow p-4 border-0">
                <div class="mb-3">
                    <label for="email" class="form-label text-violeta">Correo electrónico</label>
                    <input type="email" class="form-control" id="email" name="email" required autofocus>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label text-violeta">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-dark">
                        <i class="bi bi-box-arrow-in-right me-1"></i> Ingresar
                    </button>
                </div>
                <small class="mt-1">
                    ¿No tienes cuenta? <a class="text-decoration-none " href="index.php?seccion=registrarse"><strong class="text-violeta">Regístrate</strong></a>  
                </small>
            </form>
        </div>
    </div>
</section>