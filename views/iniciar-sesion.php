<?php

// Recuperar errores y datos viejos de la sesión si existen
$errores = $_SESSION['errores'] ?? [];
$data_vieja = $_SESSION['data_vieja'] ?? [];
$feedback_error = $_SESSION['feedback_error'] ?? null;

// Limpiar errores y datos viejos de la sesión para que no persistan
unset($_SESSION['errores'], $_SESSION['data_vieja'], $_SESSION['feedback_error']);

$email = $data_vieja['email'] ?? '';
?>


<section class="container mt-5 d-flex align-items-center justify-content-center">
    <div class="row w-100 justify-content-center">
        <div class="col-12 col-sm-10 col-md-8 col-lg-5">
            <h1 class="text-center mb-4 text-white">
                <i class="bi bi-person-circle me-1 text-white"></i> Iniciar sesión en tu cuenta
            </h1>
            <?php if ($feedback_error): ?>
                <div class="alert alert-danger"><?= $feedback_error ?></div>
            <?php endif; ?>
            <form action="acciones/procesar_iniciar-sesion.php" method="POST" class="card shadow p-4 border-0" novalidate>
                <div class="mb-3">
                    <label for="email" class="form-label text-violeta">Correo electrónico</label>
                    <input type="email" class="form-control <?php if (isset($errores['email'])) echo 'is-invalid'; ?>" id="email" name="email" value="<?= htmlspecialchars($email) ?>" required autofocus>
                    <?php if (isset($errores['email'])): ?>
                        <div class="invalid-feedback d-block">
                            <?= $errores['email'] ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label text-violeta">Contraseña</label>
                    <input type="password" class="form-control <?php if (isset($errores['password'])) echo 'is-invalid'; ?>" id="password" name="password" required>
                    <?php if (isset($errores['password'])): ?>
                        <div class="invalid-feedback d-block">
                            <?= $errores['password'] ?>
                        </div>
                    <?php endif; ?>
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