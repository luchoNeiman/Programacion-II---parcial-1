<?php

$n = $_POST['nombre'];


$e = $_POST['email'];

$t = $_POST['telefono'];

$m = $_POST['mensaje'];
?>

<section class="container mt-5 mb-5">
    <?php


    // Variables para mostrar mensaje
    $mensaje = "";
    $error = false;

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $nombre = trim($_POST["nombre"] ?? "");
        $email = trim($_POST["email"] ?? "");
        $telefono = trim($_POST["telefono"] ?? "");
        $mensajeUsuario = trim($_POST["mensaje"] ?? "");

        // Validaciones
        if (empty($nombre) || empty($email) || empty($telefono) || empty($mensajeUsuario)) {
            $error = true;
            $mensaje = "Por favor, completá todos los campos.";
    ?>
            <img src="assets/imgs/validaciones/validacionNO.png" alt="Error" class="img-fluid" style="width: 200px;">
        <?php
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = true;
            $mensaje = "El email ingresado no es válido.";
        ?>
            <img src="assets/imgs/validaciones/validacionNO.png" alt="Error" class="img-fluid" style="width: 200px;">
        <?php
        } elseif (preg_match('/\d/', $nombre)) { // Verifica si el nombre contiene números
            $error = true;
            $mensaje = "El nombre no puede contener números.";
        ?>
            <img src="assets/imgs/validaciones/validacionNO.png" alt="Error" class="img-fluid" style="width: 200px;">
        <?php
        } elseif (!preg_match('/^\d+$/', $telefono)) { // Verifica si el teléfono contiene solo números
            $error = true;
            $mensaje = "El teléfono solo puede contener números.";
        ?>
            <img src="assets/imgs/validaciones/validacionNO.png" alt="Error" class="img-fluid" style="width: 200px;">
        <?php
        } else {
            $mensaje = "¡Gracias por contactarnos, $nombre! En breve recibiras un mail para confirmar tu cupón.";
            echo "<h2>Datos recibidos:</h2>";
        ?>
            <img src="assets/imgs/validaciones/narutoOK.png" alt="Éxito" class="img-fluid" style="width: 200px;">
    <?php
        }
    }
    ?>

    <?php if ($mensaje): ?>
        <div class="alert <?= $error ? 'alert-danger' : 'alert-success' ?>" role="alert">
            <?= $mensaje ?>
        </div>
    <?php endif; ?>
</section>