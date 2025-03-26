<?php

require 'app/models/UserModel.php';

class ChangePasswordController {
    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?action=login');
            exit;
        }

        $errors = [];
        $success = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $currentPassword = $_POST['current_password'];
            $newPassword = $_POST['new_password'];
            $confirmPassword = $_POST['confirm_password'];

            // Validaciones
            if (empty($currentPassword)) {
                $errors['current_password'] = 'La contraseña actual es requerida';
            }

            if (empty($newPassword)) {
                $errors['new_password'] = 'La nueva contraseña es requerida';
            } elseif (strlen($newPassword) < 8) {
                $errors['new_password'] = 'La contraseña debe tener al menos 8 caracteres';
            }

            if ($newPassword !== $confirmPassword) {
                $errors['confirm_password'] = 'Las contraseñas no coinciden';
            }

            // Si no hay errores, verificar y cambiar la contraseña
            if (empty($errors)) {
                $userModel = new UserModel();
                $user = $userModel->getUserById($_SESSION['user_id']);

                // Verificar contraseña actual (versión texto plano - para producción usa password_verify)
                if ($user && $currentPassword === $user['password']) {
                    // Actualizar contraseña (versión texto plano - para producción usa password_hash)
                    $userModel->updatePassword($user['id'], $newPassword);
                    $success = '¡Contraseña actualizada correctamente!';
                } else {
                    $errors['current_password'] = 'La contraseña actual es incorrecta';
                }
            }
        }

        require 'app/views/change_password.php';
    }
}