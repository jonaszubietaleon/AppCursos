<?php

require 'app/models/CourseModel.php';

class CourseController {
    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?action=login');
            exit;
        }

        // Configurar directorio de uploads
        $uploadDir = 'public/uploads/icons/';
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $courseModel = new CourseModel();
        $page = $_GET['page'] ?? 1;
        $limit = 10;
        $offset = ($page - 1) * $limit;
        $courses = $courseModel->getCoursesByUser($_SESSION['user_id'], $limit, $offset);
        $totalCourses = $courseModel->getTotalCoursesByUser($_SESSION['user_id']);
        $totalPages = ceil($totalCourses / $limit);

        // Variables para el formulario de edición
        $editCourse = null;
        if (isset($_GET['edit'])) {
            $editCourse = $courseModel->getCourseById($_GET['edit']);
            if ($editCourse && $editCourse['usuario_id'] != $_SESSION['user_id']) {
                $editCourse = null; // No permitir editar cursos de otros usuarios
            }
        }

        // Procesar formularios
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'];
            $id = $_POST['id'] ?? null;

            // Validar datos básicos
            $nombre = trim($_POST['nombre']);
            $abreviacion = trim($_POST['abreviacion']);
            $aula = trim($_POST['aula']);
            $descripcion = trim($_POST['descripcion']);
            $estado = isset($_POST['estado']) ? 1 : 0;
            $fecha_inicio = $_POST['fecha_inicio'];
            $fecha_fin = !empty($_POST['fecha_fin']) ? $_POST['fecha_fin'] : null;

            // Procesar imagen del ícono
            $iconName = null;
            if (!empty($_FILES['icono']['name'])) {
                $iconName = $this->handleIconUpload($_FILES['icono']);
            } elseif ($action === 'update' && $id) {
                // Mantener el ícono existente si no se sube uno nuevo
                $currentCourse = $courseModel->getCourseById($id);
                $iconName = $currentCourse['icono'];
            }

            if ($action === 'create') {
                $courseModel->createCourse(
                    $_SESSION['user_id'],
                    $nombre,
                    $abreviacion,
                    $aula,
                    $descripcion,
                    $iconName,
                    $estado,
                    $fecha_inicio,
                    $fecha_fin
                );
                
                $_SESSION['success'] = 'Curso creado exitosamente';
                header('Location: index.php?action=courses');
                exit;
                
            } elseif ($action === 'update' && $id) {
                $courseModel->updateCourse(
                    $id,
                    $nombre,
                    $abreviacion,
                    $aula,
                    $descripcion,
                    $iconName,
                    $estado,
                    $fecha_inicio,
                    $fecha_fin
                );
                
                $_SESSION['success'] = 'Curso actualizado exitosamente';
                header('Location: index.php?action=courses');
                exit;
                
            } elseif ($action === 'delete' && $id) {
                // Eliminar la imagen asociada si existe
                $course = $courseModel->getCourseById($id);
                if (!empty($course['icono'])) {
                    $this->deleteIconFile($course['icono']);
                }
                
                $courseModel->deleteCourse($id);
                $_SESSION['success'] = 'Curso eliminado exitosamente';
                header('Location: index.php?action=courses');
                exit;
            }
        }

        require 'app/views/courses.php';
    }

    private function handleIconUpload($file) {
        $uploadDir = 'public/uploads/icons/';
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/svg+xml'];
        $maxSize = 2 * 1024 * 1024; // 2MB

        // Validar tipo de archivo
        if (!in_array($file['type'], $allowedTypes)) {
            $_SESSION['error'] = 'Solo se permiten imágenes (JPEG, PNG, GIF, SVG)';
            header('Location: index.php?action=courses');
            exit;
        }

        // Validar tamaño
        if ($file['size'] > $maxSize) {
            $_SESSION['error'] = 'La imagen no puede superar los 2MB';
            header('Location: index.php?action=courses');
            exit;
        }

        // Generar nombre único
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $fileName = uniqid('course_') . '.' . $extension;

        // Mover el archivo
        if (!move_uploaded_file($file['tmp_name'], $uploadDir . $fileName)) {
            $_SESSION['error'] = 'Error al subir la imagen';
            header('Location: index.php?action=courses');
            exit;
        }

        return $fileName;
    }

    private function deleteIconFile($fileName) {
        $filePath = 'public/uploads/icons/' . $fileName;
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }
}