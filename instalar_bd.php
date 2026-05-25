<?php
// Script de instalacion de base de datos y tabla
// Usa PDO para crear la base de datos y la tabla empleados

declare(strict_types=1);

$host = 'localhost';
$usuario = 'root';
$contrasena = '';
$dbname = 'empresa_segura';

try {
    // Conexion sin base de datos para poder crearla
    $pdo = new PDO(
        "mysql:host={$host};charset=utf8mb4",
        $usuario,
        $contrasena,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    );

    // Crear base de datos si no existe
    $pdo->exec("CREATE DATABASE IF NOT EXISTS {$dbname} CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");

    // Seleccionar base de datos
    $pdo->exec("USE {$dbname}");

    // Crear tabla empleados
    $sqlTabla = "CREATE TABLE IF NOT EXISTS empleados (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nombre_completo VARCHAR(100) NOT NULL,
        correo VARCHAR(100) NOT NULL UNIQUE,
        contrasena VARCHAR(255) NOT NULL,
        fecha_nacimiento DATE NOT NULL,
        salario_esperado DECIMAL(10,2) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

    $pdo->exec($sqlTabla);

    echo 'Base de datos y tabla creadas correctamente.';
} catch (PDOException $e) {
    // Mensaje generico para no exponer detalles internos
    echo 'Error al instalar la base de datos. Verifique la configuracion de MySQL.';
}
