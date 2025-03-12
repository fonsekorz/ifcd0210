CREATE TABLE IF NOT EXISTS usuarios (
  id INT(11) NOT NULL AUTO_INCREMENT,
  usuario VARCHAR(255) NOT NULL,
  contraseña VARCHAR(255) NOT NULL,
  email VARCHAR(255) DEFAULT NULL,
  alias VARCHAR(255) DEFAULT NULL,
  fecha_registro DATE DEFAULT CURDATE(),
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

CREATE TABLE IF NOT EXISTS posts (
  id INT(11) NOT NULL AUTO_INCREMENT,
  id_usuario INT(11) DEFAULT NULL,
  titulo VARCHAR(255) DEFAULT NULL,
  cuerpo TEXT,
  fecha_creacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  fecha_edicion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP(),
  PRIMARY KEY (id),
  KEY fk_usuario (id_usuario),
  CONSTRAINT fk_usuario FOREIGN KEY (id_usuario) REFERENCES usuarios (id) 
  ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

CREATE TABLE IF NOT EXISTS comentarios (
  id INT(11) NOT NULL AUTO_INCREMENT,
  id_post INT(11) DEFAULT NULL,
  texto TEXT,
  fecha_publicacion TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP(),
  PRIMARY KEY (id),
  KEY fk_post (id_post),
  CONSTRAINT fk_post FOREIGN KEY (id_post) REFERENCES posts (id) 
  ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Insertar usuarios
INSERT INTO usuarios (usuario, contraseña, email, alias, fecha_registro) VALUES
('juan123', 'claveSegura1', 'juan@example.com', 'Juanito', '2025-03-01'),
('maria456', 'password123', 'maria@example.com', 'Mari', '2025-03-02'),
('pedro789', 'secreto456', 'pedro@example.com', 'Pedrito', '2025-03-03');

-- Insertar posts
INSERT INTO posts (id_usuario, titulo, cuerpo) VALUES
(1, 'Mi primer post', 'Este es el contenido de mi primer post.'),
(2, 'Receta de cocina', 'Hoy compartiré una receta fácil y rápida.'),
(3, 'Consejos de programación', 'Aquí van algunos consejos útiles para programadores.');

-- Insertar comentarios
INSERT INTO comentarios (id_post, texto) VALUES
(1, '¡Buen post! Me gustó mucho.'),
(1, 'Interesante información, gracias por compartir.'),
(2, 'Voy a probar esta receta hoy mismo.'),
(3, 'Excelentes consejos, seguiré practicando.');