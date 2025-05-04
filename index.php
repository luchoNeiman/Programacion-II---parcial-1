<?php

$rutas = [ // Define un array de rutas con sus respectivos títulos.
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

$seccion = $_GET['seccion'] ?? 'home'; // Obtiene el valor de 'seccion' desde la URL, o asigna 'home' como valor por defecto.

if (!isset($rutas[$seccion])) { // Verifica si la sección solicitada no existe en el array de rutas.
    $seccion = '404'; // Si no existe, asigna '404' como sección actual.
}

$rutaConfig = $rutas[$seccion];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $rutaConfig['titulo']; ?> - Otaku Mania</title><!-- Muestra el título de la página dinámica basado en la sección actual -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/estilos.css">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <script defer src="assets/js/bootstrap.bundle.min.js"></script>

</head>

<body>
    <header class="main-header">
        <nav class="navbar navbar-expand-lg bg-dark fixed-top" data-bs-theme="dark">
            <div class="container-fluid ">
                <a class="navbar-brand text-white" href="#">Otaku Mania</a>
                <button class="navbar-toggler white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                    aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="bi bi-xl bi-list text-white"></i>
                </button>
                <div class="collapse navbar-collapse  text-white" id="navbarNavAltMarkup">
                    <div class="navbar-nav ms-auto">
                        <a class="nav-link active text-white" aria-current="page" href="index.php?seccion=home">Inicio</a>
                        <a class="nav-link text-white" href="index.php?seccion=productos">Productos</a>
                        <a class="nav-link text-white" href="index.php?seccion=contacto">Contacto</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <main class="container-fluid pt-5">
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