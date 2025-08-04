<?php
require_once __DIR__ . '/../bootstrap/init.php';

$carrito = new Carrito();
$items = $carrito->getItems();
?>

<div class="container my-5">
    <h2 class="text-center mb-4 text-white"><i class="bi bi-bag-check-fill me-2"></i>Finalizar compra</h2>
        <div class="row">
            <!-- Resumen del carrito -->
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0"><i class="bi bi-cart4 me-1"></i>Resumen de tu compra</h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        <?php $total = 0; ?>
                        <?php foreach ($items as $item): ?>
                            <?php $subtotal = $item['precio_unitario'] * $item['cantidad']; ?>
                            <?php $total += $subtotal; ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center ">
                                <div>
                                    <strong><?= htmlspecialchars($item['titulo']) ?></strong><br>
                                    <small><?= $item['cantidad'] ?> x $<?= number_format($item['precio_unitario'], 2, ',', '.') ?></small>
                                </div>
                                <span class="fw-bold">$<?= number_format($subtotal, 2, ',', '.') ?></span>
                            </li>
                        <?php endforeach; ?>
                        <li class="list-group-item d-flex justify-content-between fw-bold bg-dark text-white">
                            Total:
                            <span>$<?= number_format($total, 2, ',', '.') ?></span>
                        </li>
                    </ul>
                </div>
                <!-- BOTON QUE VUELVE AL CARRITO-->
                <a href="index.php?seccion=ver-carrito" class="btn btn-dark border-light w-100 mt-2">
                    <i class="bi bi-arrow-left-circle me-1"></i>Volver al carrito
                </a>
            </div>

            <!-- Formulario de compra -->
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0"><i class="bi bi-person-lines-fill me-1"></i>Tus datos</h5>
                    </div>
                    <div class="card-body">
                        <form action="acciones/procesar-compra.php" method="post">
                            <div class="mb-3">
                                <label for="nombre" class="form-label text-violeta">Nombre completo</label>
                                <input type="text" name="nombre" id="nombre" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label text-violeta">Correo electrónico</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="direccion" class="form-label text-violeta">Dirección</label>
                                <input type="text" name="direccion" id="direccion" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="metodo_pago" class="form-label text-violeta">Método de pago</label>
                                <select name="metodo_pago" id="metodo_pago" class="form-select" required>
                                    <option value="tarjeta">Tarjeta de crédito</option>
                                    <option value="transferencia">Transferencia bancaria</option>
                                    <option value="efectivo">Efectivo</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-success w-100">
                                <i class="bi bi-check-circle me-1"></i>Confirmar compra
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>
