<?php

require 'app/models/UserModel.php';

class RegisterController {
    public function index() {
        $errors = [];
        $success = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username']);
            $email = trim($_POST['email']);
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];

            // Validaciones
            if (empty($username)) {
                $errors['username'] = 'El nombre de usuario es requerido';
            } elseif (strlen($username) < 4) {
                $errors['username'] = 'El usuario debe tener al menos 4 caracteres';
            }

            if (empty($email)) {
                $errors['email'] = 'El correo electrónico es requerido';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'El correo electrónico no es válido';
            }

            if (empty($password)) {
                $errors['password'] = 'La contraseña es requerida';
            } elseif (strlen($password) < 8) {
                $errors['password'] = 'La contraseña debe tener al menos 8 caracteres';
            }

            if ($password !== $confirmPassword) {
                $errors['confirm_password'] = 'Las contraseñas no coinciden';
            }

            // Si no hay errores, proceder con el registro
            if (empty($errors)) {
                $userModel = new UserModel();
                
                // Verificar si el usuario ya existe
                if ($userModel->getUserByUsername($username)) {
                    $errors['username'] = 'Este nombre de usuario ya está en uso';
                } elseif ($userModel->getUserByEmail($email)) {
                    $errors['email'] = 'Este correo electrónico ya está registrado';
                } else {
                    // Registrar al usuario (versión con texto plano - para producción usa password_hash)
                    $userModel->createUser($username, $email, $password);
                    $success = '¡Registro exitoso! Redirigiendo...';
                    
                    // Redirigir después de 2 segundos
                    header("Refresh: 2; URL=index.php?action=login");
                }
            }
        }

        require 'app/views/register.php';
    }
}