<?php
require_once __DIR__ . '../../classes/Autenticacion.php';
require_once __DIR__ . '/../bootstrap/autoload.php';

// Iniciamos la sesión para el admin.
session_start();
$rutas = [
    'home' => [
        'titulo' => 'Ingresar',
    ],
    'dashboard' => [
        'titulo' => 'Tablero',
        'requiereAutenticacion' => true,
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
    'confirmarBajaProducto' => [
        'titulo' => 'Se requiere cumplir con las confirmaciones para eliminar la noticia.',
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

// Instaciamos la clase de autenticación.
$autenticacion = new Autenticacion;

// Preguntamos si la ruta requiere autenticación. De así requerirlo, verificamos que el usuario esté autenticado.
// Si no lo está, entonces lo redireccionamos al login.
$requiereAutenticacion = $rutaConfig['requiereAutenticacion'] ?? false;
if ($requiereAutenticacion && !$autenticacion->estaAutenticado()) {
    $_SESSION['feedback_error'] = "Se requiere haber iniciado sesión para ver este contenido.";
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
    <link rel="stylesheet" href="../assets/css/estilos.css">
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <script defer src="../assets/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <header class="main-header">
        <nav class="navbar navbar-expand-lg bg-azul fixed-top border-bottom border-light" data-bs-theme="dark">
            <div class="container-fluid ">
                <a class="navbar-brand text-white" href="index.php?seccion=home">
                    <img src="../assets/imgs/logo.webp" alt="Otaku Mania Logo" height="30" class="me-2">
                </a>
                <button class="navbar-toggler white" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavAltMarkup"
                    aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="bi bi-xl bi-list text-white"></i>
                </button>
                <div class="collapse navbar-collapse text-white" id="navbarNavAltMarkup">
                    <div class="navbar-nav ms-auto">
                        <a class="nav-link active text-white fs-5" aria-current="page" href="../index.php?seccion=home">🏠Inicio</a>
                        <a class="nav-link text-white fs-5" href="../index.php?seccion=productos">📦Productos</a>
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