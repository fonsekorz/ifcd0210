CREATE TABLE
    IF NOT EXISTS usuarios (
        id INT (11) NOT NULL AUTO_INCREMENT,
        nombre VARCHAR(255) NOT NULL,
        contraseña VARCHAR(255) NOT NULL,
        PRIMARY KEY (id)
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_bin;

CREATE TABLE
    IF NOT EXISTS categorias (
        id INT (11) NOT NULL AUTO_INCREMENT,
        nombre VARCHAR(255) NOT NULL,
        PRIMARY KEY (id)
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_bin;

CREATE TABLE
    IF NOT EXISTS productos (
        referencia VARCHAR(255) NOT NULL,
        id_categoria INT (11) DEFAULT NULL,
        nombre VARCHAR(255) NOT NULL,
        marca VARCHAR(255) NOT NULL,
        precio DECIMAL(10, 2) NOT NULL,
        PRIMARY KEY (referencia),
        KEY fk_categoria (id_categoria),
        CONSTRAINT fk_categoria FOREIGN KEY (id_categoria) REFERENCES categorias (id) ON DELETE CASCADE ON UPDATE CASCADE
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_bin;

CREATE TABLE
    IF NOT EXISTS compras (
        id INT (11) NOT NULL AUTO_INCREMENT,
        id_producto VARCHAR(255) NOT NULL,
        id_usuario INT (11) NOT NULL,
        fecha_compra DATE DEFAULT CURRENT_DATE,
        PRIMARY KEY (id),
        KEY fk_producto (id_producto),
        KEY fk_usuario_compras (id_usuario),
        CONSTRAINT fk_producto FOREIGN KEY (id_producto) REFERENCES productos (referencia) ON DELETE CASCADE ON UPDATE CASCADE,
        CONSTRAINT fk_usuario_compras FOREIGN KEY (id_usuario) REFERENCES usuarios (id) ON DELETE CASCADE ON UPDATE CASCADE
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_bin;

CREATE TABLE
    IF NOT EXISTS direcciones (
        id INT (11) NOT NULL AUTO_INCREMENT,
        id_usuario INT (11) NOT NULL,
        calle VARCHAR(255) DEFAULT NULL,
        piso VARCHAR(20) DEFAULT NULL,
        ciudad VARCHAR(100) DEFAULT NULL,
        codigo_postal CHAR(5) DEFAULT NULL,
        provincia VARCHAR(100) DEFAULT NULL,
        PRIMARY KEY (id),
        KEY fk_usuario_direcciones (id_usuario),
        CONSTRAINT fk_usuario_direcciones FOREIGN KEY (id_usuario) REFERENCES usuarios (id) ON DELETE CASCADE ON UPDATE CASCADE
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_bin;

-- Insertar usuarios
INSERT INTO
    usuarios (nombre, contraseña)
VALUES
    ('juanperez', 'contraseña_segura123'),
    ('maria_gomez', 'otra_contraseña456');

-- Insertar categorias
INSERT INTO
    categorias (nombre)
VALUES
    ('Electrónica'),
    ('Hogar'),
    ('Ropa');

-- Insertar productos
INSERT INTO
    productos (referencia, id_categoria, nombre, marca, precio)
VALUES
    ('P001', 1, 'Smartphone', 'MarcaX', 499.99),
    ('P002', 1, 'Laptop', 'MarcaY', 899.99),
    ('P003', 2, 'Sofá', 'MarcaZ', 350.00);

-- Insertar compras
INSERT INTO
    compras (id_producto, id_usuario, fecha_compra)
VALUES
    ('P001', 1, '2025-03-12'),
    ('P003', 2, '2025-03-12');

-- Insertar direcciones
INSERT INTO
    direcciones (
        id_usuario,
        calle,
        piso,
        ciudad,
        codigo_postal,
        provincia
    )
VALUES
    (
        1,
        'Calle Ficticia 123',
        '3B',
        'Oviedo',
        '33001',
        'Asturias'
    ),
    (
        2,
        'Avenida Real 456',
        '1A',
        'Madrid',
        '28001',
        'Madrid'
    );