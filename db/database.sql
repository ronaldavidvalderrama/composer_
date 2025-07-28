-- Active: 1753716772597@@127.0.0.1@3306@php_pdo

-- Database commands

CREATE DATABASE IF NOT EXISTS php_pdo;

USE php_pdo;

SHOW TABLES;

SELECT * FROM producto;

SELECT * FROM campers;

SELECT * FROM usuarios;

-- Drops

DROP TABLE IF EXISTS productos;

DROP TABLE IF EXISTS campers;

DROP TABLE IF EXISTS usuarios;

-- Tables

CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(80) NOT NULL UNIQUE,
    precio DECIMAL(10,2) NOT NULL CHECK(precio > 0)
);

CREATE TABLE campers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL UNIQUE,
    edad INT NOT NULL,
    documento VARCHAR(30) UNIQUE NOT NULL,
    tipo_documento VARCHAR(20) NOT NULL,
    nivel_ingles TINYINT DEFAULT 0 CHECK (nivel_ingles BETWEEN 0 AND 6),
    nivel_programacion TINYINT DEFAULT 0 CHECK (nivel_programacion BETWEEN 0 AND 5),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE usuarios (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    rol ENUM('admin', 'user') NOT NULL DEFAULT 'user'
);


-- Inserts

INSERT INTO productos(nombre, precio)
VALUES('esponja', 4000),
('pan de queso', 2000);

INSERT INTO campers (nombre, edad, documento, tipo_documento, nivel_ingles, nivel_programacion)
VALUES 
('Ana Maria Rios', 19, '1001234567', 'Cedula', 4, 3),
('Luis Alberto Pena', 22, '1002234568', 'Cedula', 3, 4),
('Camila Torres', 20, '1003234569', 'Cedula', 5, 5),
('Carlos Mendez', 18, '1004234570', 'TI', 2, 1),
('Laura Galvis', 21, '1005234571', 'Cedula', 3, 3),
('Diego Suarez', 24, '1006234572', 'Cedula', 1, 2),
('Valentina Lopez', 20, '1007234573', 'Cedula', 4, 4),
('Andres Gomez', 23, '1008234574', 'Pasaporte', 2, 3),
('Maria Fernanda Ruiz', 25, '1009234575', 'Cedula', 5, 5),
('Jhonatan Paez', 19, '1010234576', 'Cedula', 3, 2);

INSERT INTO usuarios ()