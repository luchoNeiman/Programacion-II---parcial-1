<?php

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
    '404' => [
        'titulo' => 'Página no encontrada',
    ],
];

$seccion = $_GET['seccion'] ?? 'home';
if (!isset($rutas[$seccion])) {
    $seccion = '404';
}

$rutaConfig = $rutas[$seccion];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $rutaConfig['titulo']; ?> - Otaku Mania</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/estilos.css">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
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
                    <a class="nav-link active text-white fs-5" aria-current="page" href="index.php?seccion=home"><i
                                class="bi bi-house-door me-2"></i>Inicio</a>
                    <a class="nav-link text-white fs-5" href="index.php?seccion=productos"><i
                                class="bi bi-bag me-2"></i>Productos</a>
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