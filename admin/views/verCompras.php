<?php
$usuarioId = $_GET['id'] ?? null;
$usuario = (new Usuario())->porId($usuarioId);
$compras = (new Compra)->traerCompras($usuario->getUsuarioId());

?>

<div class="container py-5">
    <div class="row justify-content-center">
        <?php foreach ($compras as $compra): ?>
            <div class="col-md-8">
                <div class="card border-0 shadow-sm my-3">
                    <!-- Encabezado clickable -->
                    <div class="card-header p-0 border-0">
                        <a class="d-block text-decoration-none text-white"
                            data-bs-toggle="collapse"
                            href="#collapseCompras"
                            role="button"
                            aria-expanded="false"
                            aria-controls="collapseCompras">

                            <div class="p-3 bg-dark d-flex justify-content-between align-items-center rounded-top">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-table me-2"></i>
                                    <strong class="text-white">Compras</strong>
                                </div>
                                <div class="text-end">
                                    <span class="small text-white me-3"><i class="bi bi-calendar-event me-1"></i><?= htmlspecialchars($compra->getFecha()); ?>Fecha</span>
                                    <span class="small text-white"><i class="bi bi-currency-dollar me-1"></i><?= htmlspecialchars($compra->getTotalCompra()); ?> Total compra</span>
                                </div>
                            </div>
                        </a>
                    </div>


                    <!-- Contenido que se despliega -->
                    <div id="collapseCompras" class="collapse">
                        <?php $detalles = $compra->traerDetalleCompras($compra->getCompraId()); ?>
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-md-12">
                                    <?php if (!$compras): ?>
                                        <!-- Si no hay datos de la compra (puede que no exista o no sea tuya) -->
                                        <div class="alert alert-warning">
                                            <p>No hay información de compra para mostrar.</p>
                                        </div>
                                    <?php else: ?>
                                        <!-- Si hay compras, muestro el resumen piola -->

                                        <ul class="list-group list-group-flush">

                                            <?php foreach ($detalles as $detalle): ?>
                                                <?php
                                                $subtotal = $detalle->total;
                                                ?>
                                                <li class="list-group-item d-flex justify-content-between align-items-center ">
                                                    <div>
                                                        <strong><?= htmlspecialchars($detalle->titulo) ?></strong><br>
                                                        <small><?= $detalle->cantidad ?> x
                                                            $<?= number_format($detalle->precio_unitario, 2, ',', '.') ?></small>
                                                    </div>
                                                    <span class="fw-bold">$<?= number_format($subtotal, 2, ',', '.') ?></span>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>

                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        <?php endforeach; ?>
    </div>


</div>