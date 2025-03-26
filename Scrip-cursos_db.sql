-- Eliminar la base de datos existente (si es necesario)
DROP DATABASE IF EXISTS cursos_db;

-- Crear la base de datos
CREATE DATABASE cursos_db;

USE cursos_db;

-- Tabla de usuarios con estructura actualizada
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabla de cursos con estructura completa
CREATE TABLE cursos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    abreviacion VARCHAR(10) NOT NULL,
    aula VARCHAR(50) NOT NULL,
    descripcion TEXT,
    icono VARCHAR(255),
    estado BOOLEAN DEFAULT 1,
    fecha_inicio DATE NOT NULL,
    fecha_fin DATE NULL,
    usuario_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
);

-- Insertar datos de prueba para usuarios con contraseñas cortas hasheadas ("123")
INSERT INTO usuarios (username, email, password) VALUES 
('jonas', 'jonasito@gmail.com', '$2y$10$Hqky0'),
('maria', 'maria@gmail.com', '$2y$10$Hqky0YxA'),   
('franklin_Vasquez', 'franklin@gmail.com', '$2y$10$Hqky0YxA');  

select * from usuarios;
-- Insertar datos de prueba para cursos
INSERT INTO cursos (nombre, abreviacion, aula, descripcion, icono, estado, fecha_inicio, fecha_fin, usuario_id) VALUES 
('Programación en Java', 'JAVA', 'Aula 101', 'Curso de introducción a Java.', 'java-icon.png', 1, '2023-09-01', '2023-12-15', 1),
('Desarrollo Web', 'WEB', 'Aula 102', 'Curso sobre HTML, CSS y JS.', 'web-icon.png', 1, '2023-09-05', '2023-12-20', 2),
('Base de Datos', 'DB', 'Aula 103', 'Curso sobre SQL y NoSQL.', 'db-icon.png', 1, '2023-09-10', NULL, 3);
