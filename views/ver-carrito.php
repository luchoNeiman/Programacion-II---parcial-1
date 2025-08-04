<?php $carrito = new Carrito();
$productos = $carrito->getItems();
?>
<div class="container py-5">
    <h2 class="text-center text-white mb-5"><i class="bi bi-cart-fill me-2"></i>Carrito de Compras</h2>

    <!-- Si el carrito está vacío -->
    <?php if (empty($productos)): ?>
    <div class="container ">
        <div class="text-center bg-light p-5 rounded shadow-sm">
            <i class="bi bi-cart-x text-secondary display-1 mb-4"></i>
            <h3 class="mb-3">Tu carrito está vacío</h3>
            <p class="fs-5 text-muted">Parece que todavía no agregaste ningún producto.</p>
            <a href="index.php?seccion=productos" class="btn btn-dark mt-3">
                <i class="bi bi-arrow-left me-1"></i> Seguir comprando
            </a>
        </div>
    </div>
    <?php else: ?>
    <div class="my-5"></div>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="mx-5 mb-5 card shadow-sm d-none d-md-block">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover mi-tabla-violeta mb-0">
                        <thead class="table-dark">
                        <tr>
                            <th class="min-th-accion"></th>
                            <th>Producto</th>
                            <th class="text-center">Cantidad</th>
                            <th class="text-end">Precio Unitario</th>
                            <th class="text-end">Subtotal</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($carrito->getItems() as $producto): ?>
                        <!-- Producto -->
                        <tr>
                            <td class="align-middle text-center">
                                <form action="acciones/carrito-procesar.php" method="post" class="d-inline">
                                <input type="hidden" name="accion" value="eliminar">
                                <input type="hidden" name="id" value="<?= $producto['producto_id']; ?>">
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                                </form>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="../assets/imgs/productos/<?= $producto['imagen'] ?>" alt="Producto"
                                         width="60" class="img-fluid rounded me-3">

                                    <div>
                                        <h6 class="mb-0"><?= htmlspecialchars($producto['titulo']) ?></h6>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle text-center">
                                <form action="acciones/carrito-procesar.php" method="post" class="d-inline">
                                    <input type="hidden" name="accion" value="restar">
                                    <input type="hidden" name="id" value="<?= $producto['producto_id']; ?>">
                                    <button type="submit" class="btn btn-sm btn-outline-secondary">
                                        <i class="bi bi-dash"></i>
                                    </button>
                                </form>
                                <span class="mx-2"><?= $producto['cantidad'] ?></span>

                                <form action="acciones/carrito-procesar.php" method="post" class="d-inline">
                                    <input type="hidden" name="accion" value="sumar">
                                    <input type="hidden" name="id" value="<?= $producto['producto_id']; ?>">
                                    <button type="submit" class="btn btn-sm btn-outline-success">
                                        <i class="bi bi-plus"></i>
                                    </button>
                                </form>




                            </td>

                            <td class="align-middle text-end">$<?= $producto['precio_unitario'] ?></td>
                            <td class="align-middle text-end"><?= $producto['precio_unitario'] * $producto['cantidad'] ?></td>
                        </tr>
                        <?php endforeach; ?>

                        </tbody>
                        <tfoot class="table-dark">
                        <tr class="fw-bold">
                            <td colspan="3" class="text-end">Total:</td>
                            <td class="text-end">$<?= $carrito->calcularTotal(); ?></td>
                            <td></td>
                        </tr>
                        </tfoot>
                    </table>
                    <!-- Botones -->
                    <div class="d-flex justify-content-between mt-2 mb-2">
                        <!-- Botón Vaciar Carrito a la izquierda -->
                        <form action="acciones/carrito-procesar.php" method="post" class="d-inline">
                        <input type="hidden" name="accion" value="vaciar">
                        <button type="submit" class="btn btn-danger ms-1">
                            <i class="bi bi-credit-card me-1"></i>Vaciar Carrito
                        </button>
                        </form>

                        <!-- Contenedor para los otros dos botones alineados a la derecha -->
                        <div class="d-flex">
                            <a href="index.php?seccion=productos" class="btn btn-outline-dark me-2">
                                <i class="bi bi-arrow-left me-1"></i>Seguir comprando
                            </a>
                            <a href="index.php?seccion=checkout" class="btn btn-dark me-1">
                                <i class="bi bi-credit-card me-1"></i>Finalizar compra
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>
