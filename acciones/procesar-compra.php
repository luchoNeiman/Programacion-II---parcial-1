<?php
require_once __DIR__ . '/../bootstrap/init.php';

$carrito = new Carrito();
$items = $carrito->getItems();

if (empty($items)) {
    $_SESSION['feedback_error'] = "Tu carrito está vacío. No se puede procesar la compra.";
    header("Location: ../index.php?seccion=ver-carrito");
    exit;
}

// Capturar datos del formulario
$nombre     = $_POST['nombre'] ?? '';
$email      = $_POST['email'] ?? '';
$direccion  = $_POST['direccion'] ?? '';
$metodoPago = $_POST['metodo_pago'] ?? '';

// (opcional) Podés validar que no estén vacíos, pero por ahora seguimos

// Simular "procesamiento"
$_SESSION['compra'] = [
    'nombre'     => $nombre,
    'email'      => $email,
    'direccion'  => $direccion,
    'metodo'     => $metodoPago,
    'productos'  => $items
];

// Vaciar carrito
$carrito->vaciar();

// Redirigir a pantalla de gracias
header("Location: ../index.php?seccion=gracias");
exit;
