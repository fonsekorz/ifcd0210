CREATE DATABASE IF NOT EXISTS zoo;
USE zoo;

CREATE TABLE IF NOT EXISTS especies_animales (
    id SMALLINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre_cientifico VARCHAR(100) NOT NULL,
    nombre_generico VARCHAR(100) NOT NULL,
    familia VARCHAR(100) NOT NULL,
    cuidados TEXT DEFAULT NULL,
    informacion TEXT DEFAULT NULL,
    explicacion TEXT DEFAULT NULL
);

CREATE TABLE IF NOT EXISTS cuidadores (
    dni CHAR(9) PRIMARY KEY,
    nombre VARCHAR(100) DEFAULT NULL,
    primer_apellido VARCHAR(100) DEFAULT NULL,
    segundo_apellido VARCHAR(100) DEFAULT NULL,
    telefono VARCHAR(50) DEFAULT NULL
);

CREATE TABLE IF NOT EXISTS voluntarios (
    dni CHAR(9) PRIMARY KEY,
    nombre VARCHAR(100) DEFAULT NULL,
    primer_apellido VARCHAR(100) DEFAULT NULL,
    segundo_apellido VARCHAR(100) DEFAULT NULL,
    fecha_nacimiento DATE DEFAULT NULL,
    telefono VARCHAR(50) DEFAULT NULL
);

CREATE TABLE IF NOT EXISTS ejemplares_animales (
    id SMALLINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    cod_especie SMALLINT UNSIGNED NOT NULL,
    padre SMALLINT UNSIGNED DEFAULT NULL,
    madre SMALLINT UNSIGNED DEFAULT NULL,
    fecha_nacimiento DATE NOT NULL,
    fecha_defuncion DATE DEFAULT NULL,
    CONSTRAINT fk_ejemplar_especie FOREIGN KEY (cod_especie) REFERENCES especies_animales (id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_ejemplar_padre FOREIGN KEY (padre) REFERENCES ejemplares_animales (id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_ejemplar_madre FOREIGN KEY (madre) REFERENCES ejemplares_animales (id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS cuidador_especie (
    id SMALLINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    cod_especie SMALLINT UNSIGNED NOT NULL,
    dni_cuidador CHAR(9) NOT NULL,
    CONSTRAINT fk_cuidador_especie_cod FOREIGN KEY (cod_especie) REFERENCES especies_animales (id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_cuidador_especie_dni FOREIGN KEY (dni_cuidador) REFERENCES cuidadores (dni) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS voluntario_ejemplar (
    id SMALLINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    cod_ejemplar SMALLINT UNSIGNED NOT NULL,
    dni_voluntario CHAR(9) NOT NULL,
    CONSTRAINT fk_voluntario_ejemplar_cod FOREIGN KEY (cod_ejemplar) REFERENCES ejemplares_animales (id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_voluntario_ejemplar_dni FOREIGN KEY (dni_voluntario) REFERENCES voluntarios (dni) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS visitas (
    id SMALLINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    dni_cuidador CHAR(9) NOT NULL,
    dni_voluntario CHAR(9) NOT NULL,
    cod_ejemplar SMALLINT UNSIGNED NOT NULL,
    dia DATE DEFAULT NULL,
    hora TIME DEFAULT NULL,
    incidencia TEXT,
    CONSTRAINT fk_visita_cuidador FOREIGN KEY (dni_cuidador) REFERENCES cuidadores (dni) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_visita_voluntario FOREIGN KEY (dni_voluntario) REFERENCES voluntarios (dni) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_visita_ejemplar FOREIGN KEY (cod_ejemplar) REFERENCES ejemplares_animales (id)
);

CREATE TABLE IF NOT EXISTS cuidador_ejemplar (
    id SMALLINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    cod_ejemplar SMALLINT UNSIGNED NOT NULL,
    dni_cuidador CHAR(9) NOT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_cuidador_ejemplar_cod FOREIGN KEY (cod_ejemplar) REFERENCES ejemplares_animales (id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_cuidador_ejemplar_dni FOREIGN KEY (dni_cuidador) REFERENCES cuidadores (dni) ON DELETE CASCADE ON UPDATE CASCADE
);
