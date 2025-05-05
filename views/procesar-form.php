<section class="container mt-5 mb-5 text-center">
    <?php
    $nombre = $_POST['nombre'] ?? '';
    $mail = $_POST['email'] ?? '';
    $mensaje = $_POST['mensaje'] ?? '';
    $check = $_POST['check'] ?? false;

    if ($nombre):
    ?>
        <h2>¡Gracias por contactarnos, <?= $nombre ?>!</h2>
        <div class="alert alert-success" role="alert">
            <p class="text-center">¡Se recibió el formulario correctamente! En breve recibirás un correo en <strong><?= $mail ?></strong> para confirmar tu cupón de descuento del 35%.</p>
        </div>
        <div class="d-flex justify-content-center align-items-center">
            <img src="assets/imgs/validaciones/narutoOK.png" alt="Éxito" class="img-fluid" style="width: 400px;">
        </div>
    <?php else: ?>
        <div class="alert alert-warning" role="alert">
            No se recibieron datos válidos.
        </div>
    <?php endif; ?>

    <div class="d-flex justify-content-center align-items-center mt-4">
        <a href="index.php?seccion=home" class="btn btn-dark">Volver al inicio</a>
    </div>

</section>