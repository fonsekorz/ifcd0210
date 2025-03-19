CREATE DATABASE IF NOT EXISTS blog;
USE blog;

-- Tabla de usuarios
CREATE TABLE IF NOT EXISTS usuarios (
    id INT(11) NOT NULL AUTO_INCREMENT,
    usuario VARCHAR(255) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE,
    alias VARCHAR(255),
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_bin;

-- Tabla de posts
CREATE TABLE IF NOT EXISTS posts (
    id INT(11) NOT NULL AUTO_INCREMENT,
    id_usuario INT(11) NOT NULL,
    titulo VARCHAR(255) NOT NULL,
    cuerpo TEXT NOT NULL,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_edicion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_bin;

-- Tabla de comentarios
CREATE TABLE IF NOT EXISTS comentarios (
    id INT(11) NOT NULL AUTO_INCREMENT,
    id_post INT(11) NOT NULL,
    id_usuario INT(11) NOT NULL,
    texto TEXT NOT NULL,
    fecha_publicacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (id_post) REFERENCES posts(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_bin;

-- Insertar usuarios
INSERT INTO usuarios (usuario, password_hash, email, alias)
VALUES
    ('juan123', 'claveSegura1', 'juan@example.com', 'Juanito'),
    ('maria456', 'password123', 'maria@example.com', 'Mari'),
    ('pedro789', 'secreto456', 'pedro@example.com', 'Pedrito');

-- Insertar posts
INSERT INTO posts (id_usuario, titulo, cuerpo)
VALUES
    (1, 'Mi primer post', 'Este es el contenido de mi primer post.'),
    (2, 'Receta de cocina', 'Hoy compartiré una receta fácil y rápida.'),
    (3, 'Consejos de programación', 'Aquí van algunos consejos útiles para programadores.');

-- Insertar comentarios
INSERT INTO comentarios (id_post, id_usuario, texto)
VALUES
    (1, 2, '¡Buen post! Me gustó mucho.'),
    (1, 3, 'Interesante información, gracias por compartir.'),
    (2, 1, 'Voy a probar esta receta hoy mismo.'),
    (3, 2, 'Excelentes consejos, seguiré practicando.');