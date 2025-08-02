<?php
require_once __DIR__ . '/bootstrap/autoload.php';
$rutas = [
  'home' => [
    'titulo' => 'Página principal',
  ],
  'productos' => [
    'titulo' => 'Productos',
  ],
  'detalle-producto' => [
    'titulo' => 'Detalle Producto',
  ],
  'contacto' => [
    'titulo' => 'Contacto',
  ],
  'procesar-form' => [
    'titulo' => 'Procesar Formulario',
  ],
  'ver-carrito' => [
    'titulo' => 'Carrito de compras',
  ],
  'checkout' => [
    'titulo' => 'finalizar compra',
  ],


  'registrarse' => [
    'titulo' => 'Crear una cuenta',
  ],
  'iniciar-sesion' => [
    'titulo' => 'Ingresar a mi cuenta',
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
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $rutaConfig['titulo']; ?> - Otaku Mania</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/estilos.css">
    <script defer src="assets/js/bootstrap.bundle.min.js"></script>
</head>

<body>
<header class="main-header">
    <nav class="navbar navbar-expand-lg bg-azul fixed-top border-bottom border-light" data-bs-theme="dark">
        <div class="container-fluid ">
            <a class="navbar-brand text-white" href="index.php?seccion=home">
                <img src="assets/imgs/logo.webp" alt="Otaku Mania Logo" height="30" class="me-2">
            </a>
            <button class="navbar-toggler white" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavAltMarkup"
                    aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <i class="bi bi-xl bi-list text-white"></i>
            </button>

            <div class="collapse navbar-collapse text-white" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-auto">
                    <a class="nav-link active text-white fs-5" aria-current="page" href="index.php?seccion=home">
                        <i class="bi bi-house-door me-1"></i> Inicio
                    </a>
                    <a class="nav-link text-white fs-5" href="index.php?seccion=productos">
                        <i class="bi bi-box-seam me-1"></i> Productos
                    </a>
                    <!-- Para facil acceso al panel(aca va a ocupar el lugar de iniciar sesion/resgistrarse)-->
                    <a class="nav-link text-white fs-5" href="admin/index.php?seccion=dashboard">
                        <i class="bi bi-lock-fill me-1"></i> Panel Admin
                    </a>
                    <a class="nav-link text-white fs-5" href="index.php?seccion=ver-carrito">
                        <i class="bi bi-cart me-1"></i>
                    </a>

                    <div class="nav-item dropdown">
                      <?php
                      if (!$autenticacion->estaAutenticado()):
                      ?>

                        <a class="nav-link dropdown-toggle d-flex align-items-center text-white fs-5" href="#"
                           role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle me-1"></i> Mi cuenta
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a href="index.php?seccion=iniciar-sesion" class="dropdown-item fs-5">
                                    Iniciar sesión
                                </a>
                            </li>
                            <li>
                                <a href="index.php?seccion=registrarse" class="dropdown-item fs-5">
                                    Registrarse
                                </a>
                            </li>
                        </ul>
                    </div>
                  <?php else: ?>
                      <!-- aca va el else -->
                    <?php $usuario = $autenticacion->getUsuarioLogin(); ?>
                      <a class="nav-link dropdown-toggle d-flex align-items-center text-white fs-5" href="#"
                         role="button"
                         data-bs-toggle="dropdown" aria-expanded="false">
                          <img src="../assets/imgs/avatars/<?= $usuario['avatar'] ?? 'avatar.webp'; ?>"
                               alt="Avatar"
                               width="32" height="32" class="rounded-circle me-2">
                        <?= htmlspecialchars($usuario['nombre']) ?>
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

                  <?php endif; ?>

                </div>
            </div>
        </div>
    </nav>
</header>
<main class="pt-5 bg-degrade">
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
</body>

</html>