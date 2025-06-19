<section class="container mt-5" style="max-width: 500px;">
    <h1 class="text-center mb-4 text-white">
        <i class="bi bi-shield-lock-fill me-2 text-white"></i> Ingresar al panel de administración
    </h1>


    <form action="acciones/iniciarSesion.php" method="POST" class="card shadow p-4 border-0">
        <div class="mb-3">
            <label for="email" class="form-label">Correo electrónico</label>
            <input type="email" class="form-control" id="email" name="email" required autofocus>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <div class="d-grid">
            <button type="submit href="index.php?seccion=dashboard" class="btn btn-dark">
                <i class="bi bi-box-arrow-in-right me-1"></i> Ingresar
            </button>
        </div>

    </form>
</section>
