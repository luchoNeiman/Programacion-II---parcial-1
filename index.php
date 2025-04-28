<?php

$rutas = [
    'home'              => [
        'titulo' => 'Página principal',
    ],
    'productos'          => [
        'titulo' => 'Productos',
    ],
    'contacto'       => [
        'titulo' => 'Contacto',
    ],
    '404'               => [
        'titulo' => 'Página no encontrada',
    ],
];

$seccion = $_GET['seccion'] ?? 'home';

// Ahora que sabemos la sección que se está pidiendo, vamos a corroborar que la misma figure entre las "rutas" 
// permitidas.
if (!isset($rutas[$seccion])) {
    // La ruta no está definida. Mostramos una página de error.
    $seccion = '404';
}

// Ahora que tenemos definida cuál es la ruta a mostrar, podemos guardar para facilidad de acceso el array de configuración
// de la ruta.
$rutaConfig = $rutas[$seccion];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="favicon.ico" sizes="any">
    <link rel="icon" href="favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="favicon-ios.png">
    <title><?= $rutaConfig['titulo']; ?> - Otaku Mania</title>
    <link rel="stylesheet" href="css/estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
   
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" />
</head>

<body>
    <div class="layout">
        <header class="main-header">
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">Navbar</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <div class="navbar-nav">
                            <a class="nav-link active" aria-current="page" href="index.php?seccion=home">Home</a>
                            <a class="nav-link" href="index.php?seccion=productos">Productos</a>
                            <a class="nav-link" href="index.php?seccion=contacto">Contacto</a>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
        <main class="main-content">
            <?php
            // Incluimos la sección que el usuario desea ver, que se indicó en el query string.
            require_once __DIR__ . '/views/' . $seccion . '.php';

            // Lo anterior queda, por ejemplo, como:
            // require_once __DIR__ . '/views/home.php';
            // require_once __DIR__ . '/views/productos.php';
            // require_once __DIR__ . '/views/iniciar-sesion.php';
            // require_once __DIR__ . '/views/registrarse.php';
            ?>
        </main>
        <footer class="main-footer">
            <p>&copy; Da Vinci - 2025</p>
        </footer>
    </div>
    <script  src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
</body>

</html>