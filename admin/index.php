<?php
require_once __DIR__ . '/../bootstrap/init.php';

$rutas = [
  'home' => [
    'titulo' => 'Ingresar',
  ],
  'dashboard' => [
    'titulo' => 'Tablero',
    'requiereAutenticacion' => true,
  ],
  'miPerfil' => [
    'titulo' => 'Mi Perfil',
    'requiereAutenticacion' => false,
  ],

  'productos' => [
    'titulo' => 'Administrar productos',
    'requiereAutenticacion' => true,
  ],
  'nuevoProducto' => [
    'titulo' => 'Nuevo Producto',
    'requiereAutenticacion' => true,
  ],
  'edicionProducto' => [
    'titulo' => 'Editar producto',
    'requiereAutenticacion' => true,
  ],
  'verProducto' => [
    'titulo' => 'Ver producto',
    'requiereAutenticacion' => true,
  ],
  'confirmarBajaProducto' => [
    'titulo' => 'Confirmacion de baja de producto',
    'requiereAutenticacion' => true,
  ],
  '404' => [
    'titulo' => 'Página no encontrada',
  ],
];

$seccion = $_GET['seccion'] ?? 'home';
if (!isset($rutas[$seccion])) {
  $seccion = '404';
}

$rutaConfig = $rutas[$seccion];

$autenticacion = new Autenticacion;

$requiereAutenticacion = $rutaConfig['requiereAutenticacion'] ?? false;
if (
  $requiereAutenticacion &&
  (
    !$autenticacion->estaAutenticado() ||
    !$autenticacion->getUsuario()->esAdmin()
  )
) {
  $_SESSION['feedback_error'] = "❌ Se requiere haber iniciado sesión como administrador para ver este contenido.";
  header("Location: index.php");
  exit;
}

// Capturamos el mensaje de feedback, si existe.
if (isset($_SESSION['feedback_exito'])) {
  $feedbackExito = $_SESSION['feedback_exito'];
  unset($_SESSION['feedback_exito']);
}

if (isset($_SESSION['feedback_error'])) {
  $feedbackError = $_SESSION['feedback_error'];
  unset($_SESSION['feedback_error']);
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $rutaConfig['titulo']; ?> - Otaku Mania</title>
  <link rel="icon" href="../favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/estilos.css">
  <script defer src="../assets/js/bootstrap.bundle.min.js"></script>
</head>

<body>
  <header class="main-header">
    <nav class="navbar navbar-expand-lg bg-azul fixed-top border-bottom border-light" data-bs-theme="dark">
      <div class="container-fluid ">
        <a class="navbar-brand text-white" href="../index.php?seccion=home">
          <img src="../assets/imgs/logo.webp" alt="Otaku Mania Logo" class="mx-2">
        </a>
        <button class="navbar-toggler white" type="button" data-bs-toggle="collapse"
          data-bs-target="#navbarNavAltMarkupAdmin"
          aria-controls="navbarNavAltMarkupAdmin" aria-expanded="false" aria-label="Toggle navigation">
          <i class="bi bi-xl bi-list text-white"></i>
        </button>
        <div class="collapse navbar-collapse text-white" id="navbarNavAltMarkupAdmin">
          <?php
          if ($autenticacion->estaAutenticado()):
          ?>
            <?php $usuario = $autenticacion->getUsuarioLogin(); ?>

            <div class="navbar-nav ms-auto">
              <a class="nav-link active text-white fs-5" href="index.php?seccion=dashboard">
                <i class="bi bi-layout-text-sidebar me-1"></i> Tablero
              </a>

              <a class="nav-link text-white fs-5" href="index.php?seccion=productos">
                <i class="bi bi-box-seam "></i> Productos
              </a>
              <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle d-flex align-items-center text-white fs-5" href="#"
                  role="button"
                  data-bs-toggle="dropdown" aria-expanded="false">
                  <img src="../assets/imgs/avatars/<?= $usuario->getAvatar() ?? 'avatar.webp'; ?>"
                    alt="Avatar"
                    width="32" height="32" class="rounded-circle me-2">
                  <?= htmlspecialchars($usuario->getNombre()) ?>

                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li>
                    <a href="index.php?seccion=miPerfil" class="dropdown-item fs-5">
                      <i class="bi bi-person-circle me-2"></i> Mi perfil
                    </a>

                  </li>
                  <li>
                    <form action="acciones/cerrarSesion.php" method="post" class="d-inline">
                      <button type="submit" class="dropdown-item fs-5">
                        <i class="bi bi-box-arrow-right me-1"></i> Cerrar sesión
                      </button>
                    </form>
                  </li>
                </ul>
              </div>
            </div>
          <?php
          endif;
          ?>
        </div>
      </div>
    </nav>
  </header>
  <main class="pt-5 bg-degrade text-white">
    <?php if (isset($feedbackExito)): ?>
      <div class="msg-success  mt-5 mx-5" id="msg-success">
        <span><?= $feedbackExito; ?></span>
        <button class="close-btn" onclick="this.parentElement.style.display='none';">✖</button>
      </div>
    <?php endif; ?>

    <?php if (isset($feedbackError)): ?>
      <div class="msg-error mt-5  mx-5" id="msg-error">
        <span><?= $feedbackError; ?></span>
        <button class="close-btn" onclick="this.parentElement.style.display='none';">✖</button>
      </div>
    <?php endif; ?>

    <?php
    require_once __DIR__ . '/views/' . $seccion . '.php';
    ?>
  </main>
  <footer class="main-footer bg-azul text-white py-3  border-top border-light">
    <div class="container text-center">
      <p class="mb-1">&copy; Da Vinci - 2025</p>
      <p class="mb-1">Alumnos: Ricardo Garcia, Luciano Neimán</p>
      <p class="mb-0">Profesor: Santiago Gallino - Materia: Programación 2</p>
    </div>
  </footer>


  <script>
    // Espera 5 segundos y oculta las notificaciones de los mensajes si existen
    setTimeout(() => {
      const successMsg = document.getElementById('msg-success');
      const errorMsg = document.getElementById('msg-error');

      if (successMsg) {
        successMsg.style.opacity = 0;
        setTimeout(() => successMsg.remove(), 500);
      }

      if (errorMsg) {
        errorMsg.style.opacity = 0;
        setTimeout(() => errorMsg.remove(), 500);
      }
    }, 5000);
  </script>
</body>

</html>