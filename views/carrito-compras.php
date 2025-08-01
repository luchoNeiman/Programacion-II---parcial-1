<div class="container-fluid text-white py-5">
    <h2 class="text-center mb-5"><i class="bi bi-cart-fill me-2"></i>Carrito de Compras</h2>

    <!-- Si el carrito está vacío -->

    <div class="text-center">
        <i class="bi bi-cart-x display-1 text-muted"></i>
        <p class="fs-4 mt-3">Tu carrito está vacío.</p>
        <a href="index.php?seccion=productos" class="btn btn-outline-dark mt-3">
            <i class="bi bi-arrow-left"></i> Ver productos
        </a>
    </div>


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
                        <!-- Producto -->
                        <tr>
                            <td class="align-middle text-center">
                                <button class="btn btn btn-outline-danger">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="assets/imgs/productos/20250627151940_tanjiro-danza.png" alt="Producto"
                                         width="60" class="img-fluid rounded me-3">
                                    <div>
                                        <h6 class="mb-0">Figura de Tanjiro</h6>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle text-center">
                                <form action="acciones/carrito.php" method="post" class="d-inline">
                                    <input type="hidden" name="accion" value="sumar">
                                    <input type="hidden" name="id" value="1">
                                    <button type="submit" class="btn btn-sm btn-outline-success">
                                        <i class="bi bi-plus"></i>
                                    </button>
                                </form>

                                <span class="mx-2">1</span>

                                <form action="acciones/carrito.php" method="post" class="d-inline">
                                    <input type="hidden" name="accion" value="restar">
                                    <input type="hidden" name="id" value="1">
                                    <button type="submit" class="btn btn-sm btn-outline-secondary">
                                        <i class="bi bi-dash"></i>
                                    </button>
                                </form>
                            </td>

                            <td class="align-middle text-end">$6.500</td>
                            <td class="align-middle text-end">$6.500</td>
                        </tr>

                        </tbody>
                        <tfoot>
                        <tr class="fw-bold">
                            <td colspan="3" class="text-end">Total:</td>
                            <td class="text-end">$6.500</td>
                            <td></td>
                        </tr>
                        </tfoot>
                    </table>

                    <!-- Botones -->
                    <div class="d-flex justify-content-between mt-4 mb-2">
                        <a href="index.php?seccion=productos" class="btn btn-outline-dark ms-1">
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
