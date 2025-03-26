<?php

class UserModel
{
    private $db;

    public function __construct()
    {
        $this->db = getDB();
    }

    public function getUserByUsername($username)
    {
        $stmt = $this->db->prepare('SELECT * FROM usuarios WHERE username = ?');
        $stmt->execute([$username]);
        return $stmt->fetch();
    }

    public function getUserByEmail($email)
    {
        $stmt = $this->db->prepare('SELECT * FROM usuarios WHERE email = ?');
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    public function createUser($username, $email, $password)
    {
        $stmt = $this->db->prepare('INSERT INTO usuarios (username, email, password) VALUES (?, ?, ?)');
        $stmt->execute([$username, $email, $password]);
    }

    public function getUserById($id)
    {
        $stmt = $this->db->prepare('SELECT * FROM usuarios WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function updatePassword($id, $newPassword)
    {
        // Versión texto plano (NO seguro para producción)
        $stmt = $this->db->prepare('UPDATE usuarios SET password = ? WHERE id = ?');
        $stmt->execute([$newPassword, $id]);
    }

    public function deleteUser($userId)
    {
        try {
            // Iniciar transacción
            $this->db->beginTransaction();
            
            // 1. Eliminar cursos asociados (y sus archivos)
            $courseModel = new CourseModel();
            $courses = $courseModel->getCoursesByUser($userId, 1000, 0);
            
            foreach ($courses as $course) {
                if (!empty($course['icono'])) {
                    $filePath = 'public/uploads/icons/' . $course['icono'];
                    if (file_exists($filePath)) {
                        unlink($filePath);
                    }
                }
            }
            
            // 2. Eliminar al usuario
            $stmt = $this->db->prepare("DELETE FROM usuarios WHERE id = ?");
            $stmt->execute([$userId]);
            
            $this->db->commit();
            return true;
        } catch (PDOException $e) {
            $this->db->rollBack();
            error_log("Error al eliminar usuario: " . $e->getMessage());
            return false;
        }
    }
}