<?php
$errores = $_SESSION['errores'] ?? [];
$data_vieja = $_SESSION['data_vieja'] ?? [];
$feedback_error = $_SESSION['feedback_error'] ?? null;
unset($_SESSION['errores'], $_SESSION['data_vieja'], $_SESSION['feedback_error']);
?>


<section class="container mt-5 mb-5 d-flex align-items-center justify-content-center">
    <div class="row w-100 justify-content-center">
        <div class="col-12 col-sm-10 col-md-8 col-lg-5">
            <h1 class="text-center mb-4 text-white">
                <i class="bi bi-person-circle me-1 text-white"></i> ¡Registrate y no te pierdas nuestra ofertas!
            </h1>
            <?php if ($feedback_error): ?>
                <div class="alert alert-danger"><?= $feedback_error ?></div>
            <?php endif; ?>
            <form action="acciones/crear-cuenta.php" method="POST" class="card shadow p-4 border-0" novalidate>
                <div class="mb-3">
                    <div class="row">
                        <div class="col-6">
                            <label for="nombre" class="form-label text-violeta">Nombre</label>
                            <input type="text" class="form-control <?php if (isset($errores['nombre'])) echo 'is-invalid'; ?>" id="nombre" name="nombre" required autofocus value="<?= htmlspecialchars($data_vieja['nombre'] ?? '') ?>">
                            <?php if (isset($errores['nombre'])): ?>
                                <div class="invalid-feedback d-block"><?= $errores['nombre'] ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="col-6">
                            <label for="apellido" class="form-label text-violeta">Apellido</label>
                            <input type="text" class="form-control <?php if (isset($errores['apellido'])) echo 'is-invalid'; ?>" id="apellido" name="apellido" required value="<?= htmlspecialchars($data_vieja['apellido'] ?? '') ?>">
                            <?php if (isset($errores['apellido'])): ?>
                                <div class="invalid-feedback d-block"><?= $errores['apellido'] ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label text-violeta">Correo electrónico</label>
                    <input type="email" class="form-control <?php if (isset($errores['email'])) echo 'is-invalid'; ?>" id="email" name="email" required autofocus value="<?= htmlspecialchars($data_vieja['email'] ?? '') ?>">
                    <?php if (isset($errores['email'])): ?>
                        <div class="invalid-feedback d-block"><?= $errores['email'] ?></div>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="emailconfirmed" class="form-label text-violeta">Confirmar Correo electrónico</label>
                    <input type="email" class="form-control <?php if (isset($errores['emailconfirmed'])) echo 'is-invalid'; ?>" id="emailconfirmed" name="emailconfirmed" required autofocus value="<?= htmlspecialchars($data_vieja['emailconfirmed'] ?? '') ?>">
                    <?php if (isset($errores['emailconfirmed'])): ?>
                        <div class="invalid-feedback d-block"><?= $errores['emailconfirmed'] ?></div>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label text-violeta">Contraseña</label>
                    <div class="input-group">
                        <input type="password" class="form-control <?php if (isset($errores['password'])) echo 'is-invalid'; ?>" id="password" name="password" required>
                        <button type="button" class="btn btn-outline-secondary" tabindex="-1"
                            onclick="const p=document.getElementById('password'); p.type=p.type==='password'?'text':'password'; this.querySelector('i').classList.toggle('bi-eye'); this.querySelector('i').classList.toggle('bi-eye-slash'); return false;">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                    <?php if (isset($errores['password'])): ?>
                        <div class="invalid-feedback d-block"><?= $errores['password'] ?></div>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="passwordconfirmed" class="form-label text-violeta">Confirmar Contraseña</label>
                    <div class="input-group">
                        <input type="password" class="form-control <?php if (isset($errores['passwordconfirmed'])) echo 'is-invalid'; ?>" id="passwordconfirmed" name="passwordconfirmed" required>
                        <button type="button" class="btn btn-outline-secondary" tabindex="-1"
                            onclick="const p=document.getElementById('passwordconfirmed'); p.type=p.type==='password'?'text':'password'; this.querySelector('i').classList.toggle('bi-eye'); this.querySelector('i').classList.toggle('bi-eye-slash'); return false;">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                    <?php if (isset($errores['passwordconfirmed'])): ?>
                        <div class="invalid-feedback d-block"><?= $errores['passwordconfirmed'] ?></div>
                    <?php endif; ?>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-dark">
                        <i class="bi bi-box-arrow-in-right me-1"></i> Registrarse
                    </button>
                </div>
                <small class="mt-1">
                    ¿ya tienes cuenta? <a class="text-decoration-none" href="index.php?seccion=iniciar-sesion"><strong class="text-violeta">Iniciar sesión</strong></a>
                </small>
            </form>
        </div>