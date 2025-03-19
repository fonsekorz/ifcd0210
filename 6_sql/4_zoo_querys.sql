#Todos los cuidadores habilitados para cuidar una determinada especie (por Clave Primaria)
SELECT * 
FROM cuidador_especie
WHERE cod_especie=3
ORDER BY id;
#Todos los ejemplares que pertenecen a una especie (por Clave Primaria)
SELECT *
FROM ejemplares_animales
WHERE cod_especie=4
ORDER BY id;
#El numero de animales preferidos asignados a un voluntario
SELECT COUNT(cod_ejemplar) AS 'Numero animales'
FROM voluntario_ejemplar
WHERE dni_voluntario='34567890H';
#El nombre, telefono del cuidador asignado a determinado ejemplar con un nombre específico
SELECT cuidadores.nombre AS nombre_cuidador, cuidadores.telefono AS telefono_cuidador
FROM cuidadores
WHERE dni IN (SELECT dni_cuidador 
            FROM cuidador_ejemplar
            WHERE cod_ejemplar IN (SELECT id
                                    FROM ejemplares_animales
                                    WHERE cod_especie = (SELECT id
                                                        FROM especies_animales
                                                        WHERE nombre_generico = 'León')));
#Lo mismo pero con JOIN
SELECT cuidadores.nombre AS nombre_cuidador, cuidadores.telefono AS telefono_cuidador
FROM cuidadores 
INNER JOIN cuidador_ejemplar ON cuidadores.dni=cuidador_ejemplar.dni_cuidador
INNER JOIN ejemplares_animales ON cuidador_ejemplar.cod_ejemplar=ejemplares_animales.id
INNER JOIN especies_animales ON ejemplares_animales.cod_especie=especies_animales.id
WHERE especies_animales.nombre_generico='León';
#El nombre del cuidador, nombre del ejemplar, fecha nacimiento ejemplar y nombre de voluntario de las visitas entre dos fechas determinadas
SELECT cuidadores.nombre AS nombre_cuidador, 
    especies_animales.nombre_generico AS nombre_especie, 
    ejemplares_animales.fecha_nacimiento, 
    voluntarios.nombre AS nombre_voluntario
FROM visitas, ejemplares_animales, especies_animales, voluntarios, cuidador_ejemplar, cuidadores
WHERE visitas.cod_ejemplar = ejemplares_animales.id
AND ejemplares_animales.cod_especie = especies_animales.id
AND visitas.dni_voluntario = voluntarios.dni
AND ejemplares_animales.id = cuidador_ejemplar.cod_ejemplar
AND cuidador_ejemplar.dni_cuidador = cuidadores.dni
AND visitas.dia BETWEEN '2025-03-01' AND '2025-03-05';









