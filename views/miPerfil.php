<?php
// Obtiene el ID del usuario desde la sesión
$usuario_id = $_SESSION['usuario_id'];

// Busca el usuario en la base de datos usando el método porId de la clase Usuario
$usuario = (new Usuario())->porId($usuario_id);
?>

<div class="container mt-5 d-flex justify-content-center">
    <!-- card principal del perfil -->
    <div class="card shadow-lg" style="max-width: 600px; width: 100%;">

        <!-- Encabezado del  card-->
        <h4 class="mb-0 card-header bg-dark text-white text-center">
            <i class="bi bi-person-circle me-2"></i>Mi Perfil
        </h4>

        <div class="card-body text-center">

            <!-- Imagen de perfil -->
            <img src="assets/imgs/avatars/<?= htmlspecialchars($usuario->getAvatar() ?? 'avatar.webp') ?>"
                 alt="Avatar"
                 width="180" height="180"
                 class="rounded-circle mb-4 shadow">

            <!-- Formulario para subir un nuevo avatar -->
            <form action="acciones/procesar_mi-perfil.php"
                  method="post"
                  enctype="multipart/form-data"
                  class="mb-4">

                <label for="avatar" class="form-label fw-bold">Subí tu imagen de perfil:</label>

                <!-- Campo de selección de archivo -->
                <input type="file" name="avatar" id="avatar"
                       class="form-control mb-2"
                       accept=".jpg,.jpeg,.png,.webp"
                       required>

                <!-- Botón de envío -->
                <button type="submit" class="btn btn-dark">Actualizar avatar</button>

                <!-- Mensaje de error en caso de fallo -->
              <?php if (isset($errorAvatar)): ?>
                  <div class="alert alert-danger mt-2"><?= $errorAvatar ?></div>
              <?php endif; ?>
            </form>

            <!-- Lista con datos del usuario -->
            <ul class="list-group list-group-flush text-start">
                <li class="list-group-item">
                    <i class="bi bi-person-fill me-2 text-primary"></i>
                    <strong>Nombre:</strong> <?= htmlspecialchars($usuario->getNombre()) ?>
                </li>
                <li class="list-group-item">
                    <i class="bi bi-person-lines-fill me-2 text-success"></i>
                    <strong>Apellido:</strong> <?= htmlspecialchars($usuario->getApellido()) ?>
                </li>
                <li class="list-group-item">
                    <i class="bi bi-envelope-fill me-2 text-danger"></i>
                    <strong>Email:</strong> <?= htmlspecialchars($usuario->getEmail()) ?>
                </li>
            </ul>
        </div>

        <!-- Pie de la tarjeta con botón de volver -->
        <div class="card-footer text-end">
            <a href="index.php?seccion=home" class="btn btn-dark">
                <i class="bi bi-arrow-left me-2"></i>Volver al inicio
            </a>
        </div>
    </div>
</div>
