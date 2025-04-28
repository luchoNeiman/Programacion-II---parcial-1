<?php

$rutas = [
    'home' => [
        'titulo' => 'Página principal',
    ],
    'productos' => [
        'titulo' => 'Productos',
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" />
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/estilos.css">
</head>

<body>
    <header class="main-header">
        <nav class="navbar navbar-expand-lg bg-primary text-white fixed-top" data-bs-theme="dark">
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
    <main >
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