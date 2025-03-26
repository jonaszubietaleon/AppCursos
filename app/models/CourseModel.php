<?php

class CourseModel {
    private $db;

    public function __construct() {
        $this->db = getDB();
    }

    public function getCoursesByUser($userId, $limit, $offset) {
        $stmt = $this->db->prepare('SELECT * FROM cursos WHERE usuario_id = ? ORDER BY fecha_inicio DESC LIMIT ? OFFSET ?');
        $stmt->execute([$userId, $limit, $offset]);
        return $stmt->fetchAll();
    }

    public function getTotalCoursesByUser($userId) {
        $stmt = $this->db->prepare('SELECT COUNT(*) FROM cursos WHERE usuario_id = ?');
        $stmt->execute([$userId]);
        return $stmt->fetchColumn();
    }

    public function getCourseById($id) {
        $stmt = $this->db->prepare('SELECT * FROM cursos WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function createCourse($userId, $nombre, $abreviacion, $aula, $descripcion, $icono, $estado, $fecha_inicio, $fecha_fin = null) {
        $stmt = $this->db->prepare('INSERT INTO cursos (nombre, abreviacion, aula, descripcion, icono, estado, fecha_inicio, fecha_fin, usuario_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute([$nombre, $abreviacion, $aula, $descripcion, $icono, $estado, $fecha_inicio, $fecha_fin, $userId]);
        return $this->db->lastInsertId();
    }

    public function updateCourse($id, $nombre, $abreviacion, $aula, $descripcion, $icono, $estado, $fecha_inicio, $fecha_fin = null) {
        $stmt = $this->db->prepare('UPDATE cursos SET nombre = ?, abreviacion = ?, aula = ?, descripcion = ?, icono = ?, estado = ?, fecha_inicio = ?, fecha_fin = ? WHERE id = ?');
        return $stmt->execute([$nombre, $abreviacion, $aula, $descripcion, $icono, $estado, $fecha_inicio, $fecha_fin, $id]);
    }

    public function deleteCourse($id) {
        $stmt = $this->db->prepare('DELETE FROM cursos WHERE id = ?');
        return $stmt->execute([$id]);
    }
}