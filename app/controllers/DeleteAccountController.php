<?php

require 'app/models/UserModel.php';
require 'app/models/CourseModel.php';

class DeleteAccountController {
    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?action=login');
            exit;
        }

        $errors = [];
        $courseModel = new CourseModel();
        $totalCursos = $courseModel->getTotalCoursesByUser($_SESSION['user_id']);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $password = $_POST['password'];

            if (empty($password)) {
                $errors['password'] = 'La contraseña es requerida';
            } else {
                $userModel = new UserModel();
                $user = $userModel->getUserById($_SESSION['user_id']);

                // Verificar contraseña (versión texto plano)
                if ($user && $password === $user['password']) {
                    // Eliminar cuenta y cursos asociados
                    if ($userModel->deleteUser($_SESSION['user_id'])) {
                        session_destroy();
                        header('Location: index.php?action=account_deleted');
                        exit;
                    } else {
                        $errors['general'] = 'Ocurrió un error al eliminar la cuenta';
                    }
                } else {
                    $errors['password'] = 'La contraseña es incorrecta';
                }
            }
        }

        require 'app/views/delete_account.php';
    }
}