<?php
/*
    Los archivos de biblioteca ("libraries") son aquellos que contienen una o más definiciones de funciones que podemos 
    luego importar.
    Típicamente, las funciones suelen estar agrupadas por alguna funcionalidad en común.

    # Funciones en php
    Una función es un conjunto de instrucciones que se representan con un símbolo, que luego podemos ejecutar en 
    cualquier momento a través de invocarla por su símbolo.

    De más está decir que en php podemos definir nuestras propias funciones.

    Sintaxis sin parámetros:
        function nombre() 
        {
            // ... cuerpo
        }

    A diferencia de lo que pasa en JavaScript, en php sí podemos "tipar" (hacer un "type-hint") tanto los parámetros
    de una función como su retorno.
    "Tipar" es cuando nosotros definimos a nivel del lenguaje el tipo de dato que un valor tiene que ser. Por ejemplo:
    string, array, bool, int, etc.

    El beneficio de "tipar" las cosas es que suma claridad a nuestro código, así como permitir que los editores nos
    den mejores funcionalidades de auto-completado y análisis de nuestro código, e incluso permite al propio lenguaje
    a hacer verificaciones de que nuestro código esté cumpliendo con lo que se pide.
    
    Sintaxis indicando el tipo de dato del retorno:

        function nombre(): tipo-retorno 
        {
            // ... cuerpo
        }


    ## Doc Blocks
    Los doc blocks son comentarios multilínea que sirven para documentar algún símbolo (ej: variables, constantes,
    funciones, clases, etc) del programa.
    Se defienen como un comentario multilínea, pero con algunas características especiales:
    - Abre con 2 "*": /**
    - Si ocupa varias líneas, cada línea debe empezar con un "*"
    - Permiten el uso de "tags", representados con la sintaxis: @tag

    La forma más común de asociar un doc block a un símbolo, es escribiéndolo justo antes del símbolo al que documentan.
*/
require_once __DIR__ . '/../classes/Noticia.php';

const NOTICIAS_NOMBRE_JSON = 'noticias.json';

/**
 * Retorna todas las noticias almacenadas como un array.
 * Este doc block documenta la función obtenerNoticias(), porque está definido justo antes de la declaración de la 
 * función.
 * 
 * @return Noticia[]
 */
function obtenerNoticias(): array
{
    /*
        // return [
        //     [
        //         'noticia_id' => 1,
        //         'titulo' => '\'Manu\' Ginóbili sigue rompiendo récords',
        //         'sinopsis' => 'Emanuel \'Manu\' Ginóbili viene rompiendo algunos récords tanto de su equipo como de la liga.',
        //         'cuerpo' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Harum, exercitationem ab est dolore quae repellendus! Nobis aliquid omnis similique, repellat sequi perferendis suscipit non illum culpa incidunt perspiciatis. Officiis, optio!',
        //         'imagen' => 'manu.jpg',
        //         'imagen_descripcion' => 'Manu Ginóbili',
        //     ],
        //     [
        //         'noticia_id' => 2,
        //         'titulo' => 'Houston Rockets lidera la conferencia',
        //         'sinopsis' => 'De la mano de James Harden, los Rockets se apuntan como candidatos para ganar los playoff.',
        //         'cuerpo' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Hic suscipit ipsum unde maxime rem temporibus quo. Expedita doloremque quia repellat, sapiente facilis numquam neque velit ipsam distinctio odit modi iusto?',
        //         'imagen' => 'rockets-logo.jpg',
        //         'imagen_descripcion' => 'Houston Rockets Logo',
        //     ],
        //     [
        //         'noticia_id' => 3,
        //         'titulo' => 'Toronto Raptors queda primero en el Este',
        //         'sinopsis' => 'Los Raptors de Lowry y DeRozan se quedan con el primer lugar de su conferencia.',
        //         'cuerpo' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Perferendis incidunt voluptate assumenda provident dignissimos non labore perspiciatis fugit tempora, ab soluta quibusdam, laborum magnam id nostrum suscipit ea? Culpa, tenetur!',
        //         'imagen' => 'raptors-logo.jpg',
        //         'imagen_descripcion' => 'Toronto Raptors Logo',
        //     ],
        //     [
        //         'noticia_id' => 4,
        //         'titulo' => 'Denver se queda corto por un partido',
        //         'sinopsis' => 'Quedó a una victoria y media de clasificar a los playoff.',
        //         'cuerpo' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius error ex sapiente adipisci consectetur. Sit aliquam ea labore optio enim velit nulla vel, in ad! Harum dolores et itaque eveniet?',
        //         'imagen' => 'nuggets-logo.jpg',
        //         'imagen_descripcion' => 'Denver Nuggets Logo',
        //     ],
        //     [
        //         'noticia_id' => 5,
        //         'titulo' => 'Nueva noticia sobre Ginóbili',
        //         'sinopsis' => 'Otra noticia que habla de \'Manu\' Ginóbili.',
        //         'cuerpo' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Similique at excepturi quia beatae autem aliquam tempora, commodi, nihil perferendis voluptatum ab necessitatibus doloribus perspiciatis nulla quo vel qui ipsa quaerat?',
        //         'imagen' => 'manu.jpg',
        //         'imagen_descripcion' => 'Manu Ginóbili',
        //     ],
        //     [
        //         'noticia_id' => 6,
        //         'titulo' => 'Alguna noticia sobre Denver',
        //         'sinopsis' => ':D',
        //         'cuerpo' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Similique at excepturi quia beatae autem aliquam tempora, commodi, nihil perferendis voluptatum ab necessitatibus doloribus perspiciatis nulla quo vel qui ipsa quaerat?',
        //         'imagen' => 'nuggets-logo.jpg',
        //         'imagen_descripcion' => 'Denver Nuggets Logo',
        //     ],
        // ];
    */
    $noticiasJson = json_decode(file_get_contents(__DIR__ . '/../data/' . NOTICIAS_NOMBRE_JSON), true);

    // Transformamos las noticias de un array de arrays a un array de objetos Noticia.
    $noticias = []; // Acá van los objetos Noticia.

    foreach($noticiasJson as $unaNoticiaJson) {
        $noticia = new Noticia;
        $noticia->noticia_id            = $unaNoticiaJson['noticia_id'];
        $noticia->titulo                = $unaNoticiaJson['titulo'];
        $noticia->sinopsis              = $unaNoticiaJson['sinopsis'];
        $noticia->cuerpo                = $unaNoticiaJson['cuerpo'];
        $noticia->imagen                = $unaNoticiaJson['imagen'];
        $noticia->imagen_descripcion    = $unaNoticiaJson['imagen_descripcion'];

        $noticias[] = $noticia;
    }

    return $noticias;
}

/**
 * Retorna la noticia que corresponda al $id.
 */
function obtenerNoticiaPorId(int $id): ?Noticia // Equivalente a Noticia|null
{
    $noticias = obtenerNoticias();

    // Buscamos la noticia por su id.
    foreach($noticias as $unaNoticia) {
        if($unaNoticia->noticia_id == $id) {
            return $unaNoticia;
        }
    }

    // Si la noticia no existe, entonces retornamos null.
    return null;
}