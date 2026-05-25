<?php
// Clase de conexion a MySQL usando PDO
// Implementa el patron Singleton para evitar multiples conexiones

declare(strict_types=1);

class Conexion
{
    private static ?Conexion $instancia = null;
    private PDO $conexion;

    private string $host = 'localhost';
    private string $dbname = 'empresa_segura';
    private string $usuario = 'root';
    private string $contrasena = '';

    private function __construct()
    {
        $dsn = "mysql:host={$this->host};dbname={$this->dbname};charset=utf8mb4";

        $this->conexion = new PDO(
            $dsn,
            $this->usuario,
            $this->contrasena,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]
        );
    }

    // Evita la clonacion de la instancia
    private function __clone()
    {
    }

    // Evita la deserializacion de la instancia
    public function __wakeup()
    {
        throw new Exception('No se puede deserializar la clase Conexion.');
    }

    public static function getInstancia(): Conexion
    {
        if (self::$instancia === null) {
            self::$instancia = new Conexion();
        }

        return self::$instancia;
    }

    public function getConexion(): PDO
    {
        return $this->conexion;
    }
}
