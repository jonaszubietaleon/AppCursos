<?php

require 'app/models/UserModel.php';

class LoginController {
    public function index() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $remember = isset($_POST['remember']);

            $userModel = new UserModel();
            $user = $userModel->getUserByUsername($username);

            // Verificación de credenciales (versión con texto plano)
            if ($user && $password === $user['password']) {
                $_SESSION['user_id'] = $user['id'];
                
                // Opción "Recordarme" - Cookie por 30 días
                if ($remember) {
                    setcookie('remember_user', $user['id'], time() + (30 * 24 * 60 * 60), '/');
                }
                
                header('Location: index.php?action=courses');
                exit;
            } else {
                $error = "Usuario o contraseña incorrectos";
            }
        }
        require 'app/views/login.php';
    }
}