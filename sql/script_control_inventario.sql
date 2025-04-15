CREATE DATABASE almacen;
USE almacen;

-- Tabla de categorías
CREATE TABLE categorias (
    id_categoria INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(50),
    descripcion TEXT
);

-- Tabla de proveedores
CREATE TABLE proveedores (
    id_proveedor INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    telefono VARCHAR(20),
    email VARCHAR(100),
    direccion TEXT
);

-- Tabla de usuarios
CREATE TABLE usuarios (
    id_usuario INT PRIMARY KEY AUTO_INCREMENT,
    nombre_usuario VARCHAR(50),
    clave VARCHAR(20),
    estado TINYINT
);

-- Tabla de productos (relación con categorías)
CREATE TABLE productos (
    id_producto INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100),
    descripcion TEXT,
    precio DECIMAL,
    stock INT, 
    id_categoria INT,
    fecha_registro DATETIME,
    estado TINYINT(1),
    CONSTRAINT fk_cat FOREIGN KEY (id_categoria)
        REFERENCES categorias(id_categoria)
);

-- Tabla de movimientos de inventario (relación con productos, usuarios y proveedores)
CREATE TABLE movimientos_inventario (
    id_movimiento INT AUTO_INCREMENT PRIMARY KEY,
    id_producto INT NOT NULL,
    tipo ENUM('entrada', 'salida') NOT NULL,
    cantidad INT NOT NULL,
    fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
    id_usuario INT,
    id_proveedor INT,
    observaciones TEXT,

    CONSTRAINT fk_movimiento_producto FOREIGN KEY (id_producto)
        REFERENCES productos(id_producto)
        ON DELETE CASCADE
        ON UPDATE CASCADE,

    CONSTRAINT fk_movimiento_usuario FOREIGN KEY (id_usuario)
        REFERENCES usuarios(id_usuario)
        ON DELETE SET NULL
        ON UPDATE CASCADE,

    CONSTRAINT fk_movimiento_proveedor FOREIGN KEY (id_proveedor)
        REFERENCES proveedores(id_proveedor)
        ON DELETE SET NULL
        ON UPDATE CASCADE
);
