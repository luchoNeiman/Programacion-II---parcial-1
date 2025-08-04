<?php
$compra = $_SESSION['compra'] ?? null;
?>

<div class="container text-white py-5">
    <div class="text-center mb-5">
        <i class="bi bi-check-circle-fill text-success display-1"></i>
        <h2 class="mt-3">¡Gracias por tu compra<?= $compra ? ', ' . htmlspecialchars($compra['nombre']) : '' ?>!</h2>
        <p class="fs-5">Tu pedido fue procesado con éxito. A continuación te dejamos el detalle.</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow border-0 rounded shadow-sm">
                <h4 class="card-header rounded-top-1 bg-dark text-white fs-3">
                    <i class="bi bi-bag-check me-2"></i>Resumen de tu compra
                </h4>
                <div class="card-body border-5 shadow-sm">
                    <?php if (!$compra): ?>
                        <div class="alert alert-warning">No hay información de compra para mostrar.</div>
                    <?php else: ?>
                        <table class="table table-bordered table-striped table-hover mi-tabla-violeta mb-0 align-middle">
                            <thead class="table-dark">
                            <tr>
                                <th>Producto</th>
                                <th class="text-center">Cantidad</th>
                                <th class="text-end">Precio Unitario</th>
                                <th class="text-end">Subtotal</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $total = 0;
                            foreach ($compra['productos'] as $producto):
                                $subtotal = $producto['precio_unitario'] * $producto['cantidad'];
                                $total += $subtotal;
                                ?>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="assets/imgs/productos/<?= $producto['imagen'] ?? 'default.png' ?>" alt="Producto"
                                                 width="60" class="img-fluid rounded me-3">
                                            <div>
                                                <h6 class="mb-0"><?= htmlspecialchars($producto['titulo']) ?></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center"><?= $producto['cantidad'] ?></td>
                                    <td class="text-end">$<?= number_format($producto['precio_unitario'], 2, ',', '.') ?></td>
                                    <td class="text-end">$<?= number_format($subtotal, 2, ',', '.') ?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                            <tfoot class="table-dark">
                            <tr class="fw-bold bg-dark">
                                <td colspan="3" class="text-end">Total pagado:</td>
                                <td class="text-end">$<?= number_format($total, 2, ',', '.') ?></td>
                            </tr>
                            </tfoot>
                        </table>

                        <div class="text-center mt-4">
                            <a href="index.php?seccion=productos" class="btn btn-dark">
                                <i class="bi bi-arrow-left me-1"></i> Volver a productos
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
