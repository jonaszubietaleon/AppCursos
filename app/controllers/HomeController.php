<?php

class HomeController {
    public function index() {
        // Redirige al login si el usuario no está autenticado
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?action=login');
            exit;
        }

        // Si el usuario está autenticado, redirige a la página de cursos
        header('Location: index.php?action=courses');
        exit;
    }
}

$homeController = new HomeController();
$homeController->index();