<section class="container my-5">
    <div class="row">
        <div class="col-md-12">
            <h1 class="mb-4 text-center">Reclamá el cupón</h1>
            <p class="mb-4">
                Estamos aquí para ayudarte. Si tienes alguna pregunta, comentario o necesitas más información, no dudes en <strong>ponerte en contacto</strong> con nosotros. Además, completa el formulario para recibir un cupón de <strong>descuento del 35% off</strong>.
            </p>
        </div>
    
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body ">
                    <img class="w-100 img-fluid" src="assets/imgs/Banners/banner-descuento.webp"
                        alt="Descuento especial 35% off">
                </div>
            </div>
        </div>

        <div class="col-md-6 card shadow">
            <div class="card-body">
                <form method="POST" action="index.php?seccion=procesar-form" class="mx-auto" style="max-width: 600px;">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre completo</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
            
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="check" name="check">
                        <label class="form-check-label" for="check">Quiero recibir notificaciones</label>
                    </div>
            
                    <div class="mb-3">
                        <label for="mensaje" class="form-label">Mensaje</label>
                        <textarea class="form-control" id="mensaje" name="mensaje" rows="5"></textarea>
                    </div>
                    <div class="d-flex justify-content-center align-items-center">
                        <button type="submit" class="btn btn-dark">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body ">
                    <img class="w-100 img-fluid" src="assets/imgs/Banners/banner-descuento.webp"
                        alt="Descuento especial 35% off">
                </div>
            </div>
        </div>
    
    </div>
</section>