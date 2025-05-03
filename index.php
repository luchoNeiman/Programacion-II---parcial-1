<?php

$rutas = [
    'home' => [
        'titulo' => 'Página principal',
    ],
    'productos' => [
        'titulo' => 'Productos',
    ],
    'detalle-producto'     => [
            'titulo' => 'Detalle Producto',
        ],
    'contacto' => [
        'titulo' => 'Contacto',
    ],
    '404'  => [
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/estilos.css">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <script defer src="assets/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>

</head>

<body>
    <header class="main-header">
        <nav class="navbar navbar-expand-lg bg-primary text-white " data-bs-theme="dark">
            <div class="container-fluid">
                <a class="navbar-brand text-white" href="#">Logo</a>
                <button class="navbar-toggler white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                    aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="bi bi-xl bi-list text-white"></i>
                </button>
                <div class="collapse navbar-collapse text-white" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link active text-white" aria-current="page" href="index.php?seccion=home">Inicio</a>
                        <a class="nav-link text-white" href="index.php?seccion=productos">Productos</a>
                        <a class="nav-link text-white" href="index.php?seccion=contacto">Contacto</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <?php
        require_once __DIR__ . '/views/' . $seccion . '.php';
        ?>
    </main>
    <footer class="main-footer bg-dark text-white py-3">
        <div class="container text-center">
            <p class="mb-1">&copy; Da Vinci - 2025</p>
            <p class="mb-1">Alumnos: Ricardo Garcia, Luciano Neimán</p>
            <p class="mb-0">Profesor: Santiago Gallino - Materia: Programación 2</p>
        </div>
    </footer>


</body>

</html>