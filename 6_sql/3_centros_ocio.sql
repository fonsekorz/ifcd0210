CREATE TABLE
    IF NOT EXISTS socios (
        dni CHAR(9),
        nombre VARCHAR(100),
        primer_apellido VARCHAR(100),
        segundo_apellido VARCHAR(100),
        numero_cuenta INT,
        telefono VARCHAR(50),
        email VARCHAR(100),
        fecha_nacimiento DATE,
        PRIMARY KEY (dni)
    );

CREATE TABLE
    IF NOT EXISTS centros (
        cod_centro CHAR(3),
        nombre VARCHAR(100),
        direccion VARCHAR(100),
        ciudad VARCHAR(100),
        telefono VARCHAR(50),
        email VARCHAR(100),
        PRIMARY KEY (cod_centro)
    );

CREATE TABLE
    IF NOT EXISTS actividades (
        cod_actividad INT AUTO_INCREMENT,
        nombre VARCHAR(100),
        fecha TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
        explicacion TEXT,
        PRIMARY KEY (cod_actividad)
    );

CREATE TABLE
    IF NOT EXISTS registros (
        num_socio INT AUTO_INCREMENT,
        dni CHAR(9),
        cod_centro CHAR(3),
        fecha_alta TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (num_socio),
        KEY fk_registro_dni (dni),
        KEY fk_registro_cod_centro (cod_centro),
        CONSTRAINT fk_registro_dni FOREIGN KEY (dni) REFERENCES socios (dni) ON DELETE CASCADE ON UPDATE CASCADE,
        CONSTRAINT fk_registro_cod_centro FOREIGN KEY (cod_centro) REFERENCES centros (cod_centro) ON DELETE CASCADE ON UPDATE CASCADE
    );

CREATE TABLE
    IF NOT EXISTS matriculas (
        numero_matricula INT AUTO_INCREMENT,
        cod_centro CHAR(3),
        dni CHAR(9),
        cod_actividad INT,
        PRIMARY KEY (numero_matricula),
        KEY fk_matricula_centro (cod_centro),
        KEY fk_matricula_dni (dni),
        KEY fk_matricula_actividad (cod_actividad),
        CONSTRAINT fk_matricula_centro FOREIGN KEY (cod_centro) REFERENCES centros (cod_centro) ON DELETE CASCADE ON UPDATE CASCADE,
        CONSTRAINT fk_matricula_dni FOREIGN KEY (dni) REFERENCES socios (dni) ON DELETE CASCADE ON UPDATE CASCADE,
        CONSTRAINT fk_matricula_actividad FOREIGN KEY (cod_actividad) REFERENCES actividades (cod_actividad) ON DELETE CASCADE ON UPDATE CASCADE
    );

CREATE TABLE
    IF NOT EXISTS salas (
        nombre_sala VARCHAR(100),
        cod_centro CHAR(3),
        PRIMARY KEY (nombre_sala),
        KEY fk_sala_centro (cod_centro),
        CONSTRAINT fk_sala_centro FOREIGN KEY (cod_centro) REFERENCES centros (cod_centro) ON DELETE CASCADE ON UPDATE CASCADE
    );

CREATE TABLE
    IF NOT EXISTS reservas (
        id INT AUTO_INCREMENT,
        nombre_sala VARCHAR(100),
        dni CHAR(9),
        fecha TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
        hora_inicio TIME DEFAULT CURRENT_TIME,
        hora_fin TIME DEFAULT CURRENT_TIME,
        PRIMARY KEY (id),
        KEY fk_reserva_sala (nombre_sala),
        KEY fk_reserva_socio (dni),
        CONSTRAINT fk_reserva_sala FOREIGN KEY (nombre_sala) REFERENCES salas (nombre_sala) ON DELETE CASCADE ON UPDATE CASCADE,
        CONSTRAINT fk_reserva_socio FOREIGN KEY (dni) REFERENCES socios (dni) ON DELETE CASCADE ON UPDATE CASCADE
    );

-- Insertar datos en socios
INSERT INTO
    socios (
        dni,
        nombre,
        primer_apellido,
        segundo_apellido,
        numero_cuenta,
        telefono,
        email,
        fecha_nacimiento
    )
VALUES
    (
        '12345678A',
        'Juan',
        'Pérez',
        'García',
        123456,
        '600123456',
        'juan.perez@email.com',
        '1985-06-15'
    ),
    (
        '87654321B',
        'María',
        'López',
        'Martínez',
        654321,
        '611987654',
        'maria.lopez@email.com',
        '1992-09-22'
    ),
    (
        '11223344C',
        'Carlos',
        'Fernández',
        'Ruiz',
        112233,
        '622456789',
        'carlos.fernandez@email.com',
        '1978-11-30'
    );

-- Insertar datos en centros
INSERT INTO
    centros (
        cod_centro,
        nombre,
        direccion,
        ciudad,
        telefono,
        email
    )
VALUES
    (
        'C01',
        'Centro Deportivo Norte',
        'Av. Libertad 123',
        'Madrid',
        '915678910',
        'centronorte@email.com'
    ),
    (
        'C02',
        'Centro Fitness Sur',
        'Calle Sol 45',
        'Sevilla',
        '955123456',
        'centrosur@email.com'
    );

-- Insertar datos en actividades
INSERT INTO
    actividades (nombre, fecha, explicacion)
VALUES
    (
        'Yoga',
        '2025-03-15 10:00:00',
        'Clase de relajación y meditación a través del yoga.'
    ),
    (
        'Zumba',
        '2025-03-16 18:00:00',
        'Clase de baile fitness al ritmo de la música.'
    ),
    (
        'CrossFit',
        '2025-03-17 19:30:00',
        'Entrenamiento de alta intensidad para mejorar fuerza y resistencia.'
    );

-- Insertar datos en registros
INSERT INTO
    registros (dni, cod_centro, fecha_alta)
VALUES
    ('12345678A', 'C01', '2024-01-10 09:00:00'),
    ('87654321B', 'C02', '2024-02-20 10:30:00'),
    ('11223344C', 'C01', '2024-03-05 12:00:00');

-- Insertar datos en matriculas
INSERT INTO
    matriculas (cod_centro, dni, cod_actividad)
VALUES
    ('C01', '12345678A', 1),
    ('C02', '87654321B', 2),
    ('C01', '11223344C', 3);

-- Insertar datos en salas
INSERT INTO
    salas (nombre_sala, cod_centro)
VALUES
    ('Sala A', 'C01'),
    ('Sala B', 'C02'),
    ('Sala C', 'C01');

-- Insertar datos en reservas
INSERT INTO
    reservas (nombre_sala, dni, fecha, hora_inicio, hora_fin)
VALUES
    (
        'Sala A',
        '12345678A',
        '2025-03-20 09:00:00',
        '09:00:00',
        '10:00:00'
    ),
    (
        'Sala B',
        '87654321B',
        '2025-03-21 18:00:00',
        '18:00:00',
        '19:30:00'
    ),
    (
        'Sala C',
        '11223344C',
        '2025-03-22 19:30:00',
        '19:30:00',
        '21:00:00'
    );