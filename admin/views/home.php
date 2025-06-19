<section class="container mt-5" style="max-width: 500px;">
    <h1 class="text-center mb-4">🔐 Ingresar al panel de administración</h1>

    <form action="#" method="POST" class="card shadow p-4 border-0">
        <div class="mb-3">
            <label for="email" class="form-label">Correo electrónico</label>
            <input type="email" class="form-control" id="email" name="email" required autofocus>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

    <!--    <div class="d-grid">
            <button type="submit" class="btn btn-dark">
                <i class="bi bi-box-arrow-in-right me-1"></i> Ingresar
            </button>
        </div>-->
        <div class="d-grid">
            <a href="index.php?seccion=dashboard" class="btn btn-dark">
                <i class="bi bi-box-arrow-in-right me-1"></i> Ingresar
            </a>
        </div>
    </form>
</section>
