<?php
require_once __DIR__ . '/../bootstrap/init.php';

$usuario_id = $_SESSION['usuario_id'];
$usuario = (new Usuario())->porId($usuario_id);
// Procesar subida de avatar
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
  $archivo = $_FILES['avatar'];
  $extensionesPermitidas = ['jpg', 'jpeg', 'png', 'webp'];
  $nombreOriginal = $archivo['name'];
  $extension = strtolower(pathinfo($nombreOriginal, PATHINFO_EXTENSION));

  if (in_array($extension, $extensionesPermitidas)) {
    $nombreFinal = 'avatar_' . $usuario->getUsuarioId() . '_' . time() . '.' . $extension;
    $rutaDestino = __DIR__ . '/../assets/imgs/avatars/' . $nombreFinal;
    if (move_uploaded_file($archivo['tmp_name'], $rutaDestino)) {
      $usuario->actualizarAvatar($nombreFinal); // Debes implementar este método en Usuario
      header("Location: ../index.php?seccion=miPerfil");
      exit;
    } else {
      $errorAvatar = "No se pudo subir el archivo. Intenta nuevamente.";
    }
  } else {
    $errorAvatar = "Formato de imagen no permitido. Usa jpg, jpeg, png o webp.";
  }
}
?>