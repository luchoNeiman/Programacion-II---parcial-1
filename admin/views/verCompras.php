<?php
$usuarioId = $_GET['id'] ?? null;
$usuario = (new Usuario())->porId($usuarioId);
$compras = (new Compra)->traerCompras($usuarioId);
//$detalles = (new Usuario())->traerDetalleCompras($compra_id);
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <?php foreach ($compras as $compra): ?>
        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
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
                                <span class="small text-white"><i class="bi bi-currency-dollar me-1"></i>Total compra</span>
                            </div>
                        </div>
                    </a>
                </div>
                

                <!-- Contenido que se despliega -->
                <div id="collapseCompras" class="collapse">
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