<div class="container py-5">
    <div class="row justify-content-center">

        <div class="col-md-8">
            <?php if (!$compras): ?>
                <!-- Si no hay datos de la compra (puede que no exista o no sea tuya) -->
                <div class="alert alert-warning">
                    No hay información de compra para mostrar.
                </div>
            <?php else: ?>
                <!-- Si hay compras, muestro el resumen piola -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0"><i class="bi bi-cart4 me-1"></i>Resumen de tu compra</h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        <?php $total = 0; ?>
                        <?php foreach ($compras['productos'] as $item): ?>
                            <?php
                            // Calculo subtotal y voy sumando al total general
                            $subtotal = $item['precio_unitario'] * $item['cantidad'];
                            $total += $subtotal;
                            ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center ">
                                <div>
                                    <strong><?= htmlspecialchars($item['titulo']) ?></strong><br>
                                    <small><?= $item['cantidad'] ?> x
                                        $<?= number_format($item['precio_unitario'], 2, ',', '.') ?></small>
                                </div>
                                <span class="fw-bold">$<?= number_format($subtotal, 2, ',', '.') ?></span>
                            </li>
                        <?php endforeach; ?>
                        <!-- Total final -->
                        <li class="list-group-item d-flex justify-content-between fw-bold bg-dark text-white">
                            Total:
                            <span>$<?= number_format($total, 2, ',', '.') ?></span>
                        </li>
                    </ul>
                </div>
                <!-- Botón para volver al catálogo de productos -->
                <div class="text-center mt-4">
                    <a href="index.php?seccion=productos" class="btn btn-dark border-light">
                        <i class="bi bi-arrow-left me-1"></i> Volver a productos
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>