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
require_once __DIR__ . '/../classes/Producto.php';

const PRODUCTOS_JSON = 'productos.json';

function cargarProductos(): array
{
    // Leemos el archivo JSON y lo decodificamos a un array asociativo.
    $productos = json_decode(file_get_contents(__DIR__ . '/../' . PRODUCTOS_JSON), true);

    // Convertimos cada producto a un objeto de la clase Producto.
    $productos = array_map(function ($producto) {
        return new Producto($producto);
    }, $productos);

    return $productos;
}
function obtenerProducto(): array
{
    // Cargamos los productos desde el archivo JSON.
    $productos = cargarProductos();

    // Filtramos los productos para obtener solo los que están disponibles.
    $productos = array_filter($productos, function ($producto) {
        return $producto->disponible;
    });

    return $productos;
}