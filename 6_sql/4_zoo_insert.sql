-- Insertar especies animales
INSERT INTO especies_animales (nombre_cientifico, nombre_generico, familia, cuidados, informacion, explicacion)
VALUES
('Panthera leo', 'León', 'Felidae', 'Requiere grandes espacios y dieta rica en proteínas.', 'El león es un mamífero carnívoro, conocido por su melena.', 'El león es el único miembro del género Panthera que vive en grupos llamados manadas.'),
('Elephas maximus', 'Elefante Asiático', 'Elephantidae', 'Necesita mucho espacio y agua para hidratarse.', 'El elefante asiático es más pequeño que su pariente africano y se encuentra en Asia.', 'Estos animales son conocidos por su inteligencia y sus largas trompas.'),
('Giraffa camelopardalis', 'Jirafa', 'Giraffidae', 'Se alimenta de hojas altas, requiere mucho espacio para moverse.', 'La jirafa es el mamífero terrestre más alto del mundo.', 'Tiene un cuello largo y patas que le permiten alcanzar las copas de los árboles.'),
('Crocodylus acutus', 'Cocodrilo de río', 'Crocodylidae', 'Prefiere climas cálidos y agua dulce, con una dieta carnívora.', 'El cocodrilo de río es un reptil agresivo que habita en los ríos y lagos de América.', 'Es conocido por su gran tamaño y su mandíbula potente.'),
('Vulpes vulpes', 'Zorro rojo', 'Canidae', 'Suelen habitar en áreas boscosas, con una dieta omnívora.', 'El zorro rojo es un mamífero carnívoro común en Europa y Asia.', 'Es un animal astuto y adaptable, conocido por su agilidad.');

-- Insertar cuidadores
INSERT INTO cuidadores (dni, nombre, primer_apellido, segundo_apellido, telefono)
VALUES
('12345678A', 'Carlos', 'González', 'Sánchez', '612345678'),
('23456789B', 'Ana', 'Martínez', 'Pérez', '623456789'),
('34567890C', 'José', 'Rodríguez', 'López', '634567890'),
('45678901D', 'Laura', 'García', 'Martín', '645678901'),
('56789012E', 'David', 'Fernández', 'Hernández', '656789012');

-- Insertar voluntarios
INSERT INTO voluntarios (dni, nombre, primer_apellido, segundo_apellido, fecha_nacimiento, telefono)
VALUES
('12345678F', 'María', 'López', 'Torres', '1995-07-10', '612345678'),
('23456789G', 'Juan', 'Gómez', 'Vega', '1992-11-15', '623456789'),
('34567890H', 'Lucía', 'Jiménez', 'Ruiz', '2000-05-22', '634567890'),
('45678901I', 'Pedro', 'Sánchez', 'Morales', '1998-02-28', '645678901'),
('56789012J', 'Elena', 'Martín', 'Alonso', '1997-03-30', '656789012');

-- Insertar ejemplares animales
INSERT INTO ejemplares_animales (cod_especie, padre, madre, fecha_nacimiento, fecha_defuncion)
VALUES
(1, NULL, NULL, '2022-06-01', NULL),
(2, NULL, NULL, '2021-07-10', NULL),
(3, 1, 2, '2020-05-15', NULL),
(4, 3, 2, '2023-02-20', '2025-03-10'),
(5, 1, 4, '2021-12-05', NULL);

-- Insertar cuidador_especie
INSERT INTO cuidador_especie (cod_especie, dni_cuidador)
VALUES
(1, '12345678A'),
(2, '23456789B'),
(3, '34567890C'),
(4, '45678901D'),
(5, '56789012E');

-- Insertar voluntario_ejemplar
INSERT INTO voluntario_ejemplar (cod_ejemplar, dni_voluntario)
VALUES
(1, '12345678F'),
(2, '23456789G'),
(3, '34567890H'),
(4, '45678901I'),
(5, '56789012J');

-- Insertar visitas
INSERT INTO visitas (dni_cuidador, dni_voluntario, cod_ejemplar, dia, hora, incidencia)
VALUES
('12345678A', '12345678F', 1, '2025-03-01', '10:00:00', 'Revisión de salud del león'),
('23456789B', '23456789G', 2, '2025-03-02', '11:00:00', 'Alimentación del elefante asiático'),
('34567890C', '34567890H', 3, '2025-03-03', '12:00:00', 'Observación de la jirafa'),
('45678901D', '45678901I', 4, '2025-03-04', '13:00:00', 'Mantenimiento de hábitat del cocodrilo'),
('56789012E', '56789012J', 5, '2025-03-05', '14:00:00', 'Limpieza de zona del zorro');

-- Insertar cuidador_ejemplar
INSERT INTO cuidador_ejemplar (cod_ejemplar, dni_cuidador, fecha)
VALUES
(1, '12345678A', '2025-03-14 09:30:00'),
(2, '23456789B', '2025-03-14 10:00:00'),
(3, '34567890C', '2025-03-14 11:00:00'),
(4, '45678901D', '2025-03-14 12:00:00'),
(5, '56789012E', '2025-03-14 13:00:00');

-- Insertar más cuidadores asignados a especies
INSERT INTO cuidador_especie (cod_especie, dni_cuidador)
VALUES
(1, '23456789B'),
(2, '34567890C'),
(3, '45678901D'),
(4, '56789012E'),
(5, '12345678A');

-- Insertar más ejemplares animales
INSERT INTO ejemplares_animales (cod_especie, padre, madre, fecha_nacimiento, fecha_defuncion)
VALUES
(1, NULL, NULL, '2020-05-15', NULL),
(2, NULL, NULL, '2019-08-22', NULL),
(3, 1, 2, '2023-01-10', NULL),
(4, 3, 2, '2022-09-30', NULL),
(5, 1, 4, '2021-04-25', NULL);

-- Asignar más voluntarios a ejemplares
INSERT INTO voluntario_ejemplar (cod_ejemplar, dni_voluntario)
VALUES
(1, '23456789G'),
(2, '34567890H'),
(3, '45678901I'),
(4, '56789012J'),
(5, '12345678F');

-- Asignar más cuidadores a ejemplares
INSERT INTO cuidador_ejemplar (cod_ejemplar, dni_cuidador, fecha)
VALUES
(1, '23456789B', '2025-03-14 09:30:00'),
(2, '34567890C', '2025-03-14 10:00:00'),
(3, '45678901D', '2025-03-14 11:00:00'),
(4, '56789012E', '2025-03-14 12:00:00'),
(5, '12345678A', '2025-03-14 13:00:00');

-- Insertar más visitas entre fechas determinadas
INSERT INTO visitas (dni_cuidador, dni_voluntario, cod_ejemplar, dia, hora, incidencia)
VALUES
('12345678A', '12345678F', 1, '2025-03-06', '09:00:00', 'Revisión general de salud'),
('23456789B', '23456789G', 2, '2025-03-07', '10:30:00', 'Cambio de dieta del elefante'),
('34567890C', '34567890H', 3, '2025-03-08', '11:45:00', 'Limpieza del hábitat de la jirafa'),
('45678901D', '45678901I', 4, '2025-03-09', '12:15:00', 'Monitoreo del cocodrilo'),
('56789012E', '56789012J', 5, '2025-03-10', '13:00:00', 'Observación del zorro');