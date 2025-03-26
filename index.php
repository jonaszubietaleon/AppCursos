<?php
require 'config/database.php';

session_start();

$action = $_GET['action'] ?? 'home';

$controllers = [
    'login' => 'LoginController',
    'register' => 'RegisterController',
    'logout' => 'LogoutController',
    'change-password' => 'ChangePasswordController',
    'delete-account' => 'DeleteAccountController',
    'courses' => 'CourseController',
    'home' => 'HomeController',  
    'account_deleted' => 'AccountDeletedController' // Nueva ruta para confirmación de eliminación
];

// Verificar si el usuario está logueado para rutas protegidas
$protectedRoutes = ['courses', 'change-password', 'delete-account'];
if (in_array($action, $protectedRoutes) && !isset($_SESSION['user_id'])) {
    header('Location: index.php?action=login');
    exit;
}

// Verificar si el usuario NO está logueado para rutas de acceso
$guestRoutes = ['login', 'register'];
if (in_array($action, $guestRoutes) && isset($_SESSION['user_id'])) {
    header('Location: index.php?action=courses');
    exit;
}

if (array_key_exists($action, $controllers)) {
    $controllerFile = "app/controllers/{$controllers[$action]}.php";
    
    if (file_exists($controllerFile)) {
        require $controllerFile;
        $controller = new $controllers[$action]();
        $controller->index();
    } else {
        header('HTTP/1.0 404 Not Found');
        echo 'Controlador no encontrado';
    }
} else {
    header('HTTP/1.0 404 Not Found');
    echo 'Página no encontrada';
}