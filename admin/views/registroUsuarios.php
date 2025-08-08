<?php
$usuarios = (new Usuario())->traerUsuarios();
?>

<section class="container-fluid mt-5">
    <div class="mx-5 mb-4  d-flex flex-wrap align-items-center justify-content-between">
        <h1 class="text-white m-0 d-flex align-items-center mb-1">
            <i class="bi bi-box-seam-fill me-2"></i> Registro de usuarios
        </h1>
    </div>

    <!-- Tabla para escritorio -->
    <div class="mx-5 mb-5 card border-5 shadow-sm d-none d-md-block">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover mi-tabla-violeta mb-0">
                <thead class="table-dark">
                    <tr>
                        <th class="min-th">Nombre</th>
                        <th class="min-th">Apellido</th>
                        <th class="min-th">Email</th>
                        <th class="min-th">Avatar</th>
                        <th class="min-th text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $usuario): ?>
                        <tr>
                            <td class="align-middle"><?= htmlspecialchars($usuario->getNombre()); ?></td>
                            <td class="align-middle"><?= htmlspecialchars($usuario->getApellido()); ?></td>
                            <td class="align-middle"><?= htmlspecialchars($usuario->getEmail()); ?></td>
                            <td class="align-middle"><img
                                    src="../assets/imgs/avatars/<?= $usuario->getAvatar() ?? 'default.png'; ?>"
                                    alt="Imagen de perfil de <?= htmlspecialchars($usuario->getNombre()); ?>"
                                    width="50" class="img-thumbnail">
                            </td>

                            <td class=" align-middle">
                                <div class="d-flex justify-content-center gap-2">
                                    <!-- Botón ver -->
                                    <a href="index.php?seccion=verCompras&id=<?= $usuario->getUsuarioId(); ?>"
                                        class="btn btn-xl btn-dark rounded-circle" title="Ver">
                                        <i class="bi bi-eye "></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>