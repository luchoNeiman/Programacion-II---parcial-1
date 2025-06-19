<?php
require_once __DIR__ . '/DBConexion.php';
require_once __DIR__ . '/Usuario.php';

class Autenticacion
{
    public function intentarIngresar(string $email, string $password): bool
    {
        $usuario = $this->traerUsuarioPorEmail($email);
        if (!$usuario) {
            return false; // El usuario no existe.
        }

        if (!password_verify($password, $usuario->getPassword())) {
            return false; // El password no coincide.
        }

        $this->autenticar($usuario);
        return true;
    }

    public function autenticar(Usuario $usuario): void
    {
        // Para marcar al usuario como autenticado, guardamos en una variable de sesión el id.
        $_SESSION['usuario_id'] = $usuario->getUsuarioId();
    }

    public function cerrarSesion(): void
    {
        // Destruimos la variable de sesión que marca al usuario como autenticado.
        unset($_SESSION['usuario_id']);
    }

    public function estaAutenticado(): bool
    {
        return isset($_SESSION['usuario_id']);
    }

    public function traerUsuarioPorEmail(string $email): ?Usuario
    {
        return (new Usuario)->porEmail($email);
    }
}
