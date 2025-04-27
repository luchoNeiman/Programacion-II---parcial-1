<?php
// La forma recomendada siempre de organizar el código php con respecto al de HTML es:
// 1. Todo el código php que no sea solamente impresión de datos. Esto incluye, pero no se limita a:
//  - Cálculos de valores.
//  - Definiciones de variables, constantes, funciones, clases, etc.
//  - Ejecución de instrucciones (ej: conectar con la base de datos, configurar el entorno, etc).
//  - Todo tipo de llamadas de funciones (ej: hacer consultas a la base de datos, llamar a servicios externos, etc).
// 2. Cuando terminamos con *todo* el procesamiento y preparación de datos, recién ahí viene el HTML. Cualquier código
//  de php de acá en adelante debería limitarse a lo necesario para imprimir el HTML. Cosas como:
//  - echo.
//  - condicionales.
//  - bucles.
//  - requires de templates parciales.

// Vamos a definir una lista de las "rutas" (routes) válidas para nuestra aplicación.
// Una "ruta" en este contexto se refiere un recurso que queremos que se pueda acceder de alguna determinada manera.
// En nuestro caso, van a ser los valores para el parámetro "seccion" que aceptamos.
// Es muy importante restringir qué valores aceptamos como sección, para evitar potenciales vectores de ataque en nuestro
// sitio (ejecución indebida de código, carga de secciones que no deberían poder verse en este contexto, etc).
// En sistemas, existen 2 tipos de listas que podemos definir para aplicar restricciones:
// - Whitelist (lista blanca)
// - Blacklist (lista negra)
// Una "whitelist" es una lista de "inclusión". Es decir, nosotros listamos qué valores son los que queremos expresamente
// permitir. Cualquier valor no mencionado, se prohibe.
// Una "blacklist" es lo opuesto. Es una lista de "exclusión". Esto es, nosotros solo listamos los valores que queremos
// expresamente prohibir, y a todos los demás los dejamos pasar.
// En líneas generales, las "blacklists" son más fáciles de implementar, pero son menos seguras.
// Para las rutas, generalmente se utiliza siempre una "whitelist".
// Nuestra lista de rutas va a ser un array asociativo que contenga en cada posición la ruta usando como clave el nombre
// de la ruta.
// Mientras que el valor de cada ruta va a ser un array asociativo con las "opciones de configuración" de la ruta.
$rutas = [
    'home'              => [
        'titulo' => 'Página principal',
    ],
    'noticias'          => [
        'titulo' => 'Últimas noticias',
    ],
    'noticias-leer'     => [
        'titulo' => 'Leer noticia',
    ],
    'iniciar-sesion'    => [
        'titulo' => 'Ingresar a mi cuenta',
    ],
    'registrarse'       => [
        'titulo' => 'Crear una cuenta',
    ],
    '404'               => [
        'titulo' => 'Página no encontrada',
    ],
];

// Capturamos la sección que nos piden cargar a través del parámetro "seccion" del query string.
// Como no tenemos garantía de que el valor "seccion" figure en el query string, es necesario primero verificar que así
// sea. De manera tal que si no existe, podamos definirle un valor por defecto.
//  isset($variable) retorna true si la $variable existe, y false de lo contrario.
// if(isset($_GET['seccion'])) {
//     $seccion = $_GET['seccion'];
// } else {
//     $seccion = 'home';
// }

// También podríamos escribir lo anterior como un condicional en-línea (operador ternario):
// $seccion = isset($_GET['seccion']) ? $_GET['seccion'] : 'home';

// Dicho esto, en php tenemos una manera aún más breve y fácil de leer de lograr el mismo objetivo: el operador
// "null coalesce" (fusión de null): ??
// Este operador se usa:
//  $valor ?? default
// Lo que hace es decir: "Si $valor existe, usá ese dato. Si no existe o es null, usá el default".
$seccion = $_GET['seccion'] ?? 'home';

// Ahora que sabemos la sección que se está pidiendo, vamos a corroborar que la misma figure entre las "rutas" 
// permitidas.
if(!isset($rutas[$seccion])) {
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
    <title><?= $rutaConfig['titulo'];?> :: Saraza Basket</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <div class="layout">
        <header class="main-header">
            <p class="brand">Saraza Basket</p>
            <p>Enterate de todas las novedades sobre la NBA</p>
        </header>
        <nav class="main-nav">
            <div class="container-fixed">
                <ul>
                    <li><a href="index.php?seccion=home">Home</a></li>
                    <li><a href="index.php?seccion=noticias">Noticias</a></li>
                    <li><a href="index.php?seccion=iniciar-sesion">Iniciar Sesión</a></li>
                    <li><a href="index.php?seccion=registrarse">Registrarse</a></li>
                </ul>
            </div>
        </nav>
        <main class="main-content">
            <?php
            // Incluimos la sección que el usuario desea ver, que se indicó en el query string.
            require_once __DIR__ . '/views/' . $seccion . '.php';

            // Lo anterior queda, por ejemplo, como:
            // require_once __DIR__ . '/views/home.php';
            // require_once __DIR__ . '/views/noticias.php';
            // require_once __DIR__ . '/views/iniciar-sesion.php';
            // require_once __DIR__ . '/views/registrarse.php';
            ?>
        </main>
        <footer class="main-footer">
            <p>&copy; Da Vinci - 2025</p>
        </footer>
    </div>
</body>
</html>
