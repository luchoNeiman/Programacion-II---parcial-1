<?php

class Autenticacion
{
    /**
     * Intenta autenticar a un usuario con sus credenciales de email y password
     *
     * @param string $email Email del usuario a autenticar
     * @param string $password Password a verificar
     * @return bool true si la autenticación fue exitosa, false en caso contrario
     */
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

    /**
     * Marca al usuario como autenticado guardando su ID en la sesión
     *
     * @param Usuario $usuario Usuario a autenticar
     * @return void
     */
    public function autenticar(Usuario $usuario): void
    {
        $_SESSION['usuario_id'] = $usuario->getUsuarioId();
    }

    /**
     * Cierra la sesión del usuario autenticado eliminando su ID de la sesión
     *
     * @return void
     */
    public function cerrarSesion(): void
    {
        // Destruimos la variable de sesión que marca al usuario como autenticado.
        unset($_SESSION['usuario_id']);
    }

    /**
     * Verifica si hay un usuario autenticado chequeando la existencia del ID en la sesión
     */
    public function estaAutenticado(): bool
    {
        return isset($_SESSION['usuario_id']);
    }

    /**
     * Busca un usuario por su email en la base de datos
     * @param string $email Email del usuario a buscar
     * @return Usuario|null Retorna el objeto Usuario si existe, null si no
     */
    public function traerUsuarioPorEmail(string $email): ?Usuario
    {
        return (new Usuario)->porEmail($email);
    }

    /**
     * busca un usuario por su id en la base de datos
     * @param int $id id del usuario a buscar
     * @return Usuario|null Retorna nombre y avatar para el enlace login si existe, null si no
     */
    public function getUsuarioLogin(): ?array
    {
        // Si el usuario no está autenticado, retornar null
        if (!$this->estaAutenticado()) {
            return null;
        }
        // Obtener el usuario por el ID almacenado en la sesión
        $usuario = (new Usuario)->porId($_SESSION['usuario_id']);
        //Si no existe el usuario retornar null
        if (!$usuario) {
            return null;
        }
        // Retornar array con nombre y avatar del usuario
        return [
            'nombre' => $usuario->getNombre(),
            'avatar' => $usuario->getAvatar(),
        ];
    }


}
