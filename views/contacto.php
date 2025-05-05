<main class="container mt-5 mb-5">

    <div class="col-md-12 text-center">
        <h1 class="mb-4 tex-center">Contáctanos</h1>
        <p class="lead">
            Estamos aquí para ayudarte. Si tienes alguna pregunta, comentario o necesitas más información, no dudes en ponerte en contacto con nosotros. Ademas completa el formulario para recibir un cupón de descuento del 35% off.
        </p>
    </div>



    <form method="POST" action="index.php?seccion=procesar-form" class="mx-auto" style="max-width: 600px;">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre completo</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Correo electrónico</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="tel" class="form-control" id="telefono" name="telefono" required>
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="check" name="check">
            <label class="form-check-label" for="check">Quiero recibir notificaciones</label>
        </div>

        <div class="mb-3">
            <label for="mensaje" class="form-label">Mensaje</label>
            <textarea class="form-control" id="mensaje" name="mensaje" rows="5"></textarea>
        </div>
        <button type="submit" class="btn btn-dark">Enviar</button>
    </form>
</main>