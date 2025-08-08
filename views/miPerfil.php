<?php


$usuario_id = $_SESSION['usuario_id'];
$usuario = (new Usuario())->porId($usuario_id);
?>
<div class="container mt-5 d-flex justify-content-center">
  <div class="card shadow-lg" style="max-width: 600px; width: 100%;">
    <h4 class="mb-0 card-header bg-dark text-white text-center"><i class="bi bi-person-circle me-2"></i>Mi Perfil
    </h4>
    <div class="card-body text-center">
      <img src="assets/imgs/avatars/<?= htmlspecialchars($usuario->getAvatar() ?? 'avatar.webp') ?>"
        alt="Avatar"
        width="180" height="180"
        class="rounded-circle mb-4 shadow">

      <form action="acciones/procesar_mi-perfil.php" method="post" enctype="multipart/form-data" class="mb-4">
        <label for="avatar" class="form-label fw-bold">Subí tu imagen de perfil:</label>
        <input type="file" name="avatar" id="avatar" class="form-control mb-2" accept=".jpg,.jpeg,.png,.webp"
          required>
        <button type="submit" class="btn btn-primary">Actualizar avatar</button>
        <?php if (isset($errorAvatar)): ?>
          <div class="alert alert-danger mt-2"><?= $errorAvatar ?></div>
        <?php endif; ?>
      </form>

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
    <div class="card-footer text-end">
      <a href="index.php?seccion=home" class="btn btn-dark">
        <i class="bi bi-arrow-left me-2"></i>Volver al inicio
      </a>
    </div>
  </div>
</div>