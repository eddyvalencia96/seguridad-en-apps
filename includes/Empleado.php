<?php
// Clase Empleado: representa la entidad y su logica de registro

declare(strict_types=1);

require_once __DIR__ . '/Conexion.php';

class Empleado
{
    private ?int $id = null;
    private string $nombreCompleto;
    private string $correo;
    private string $contrasenaHash;
    private string $fechaNacimiento;
    private float $salarioEsperado;

    public function __construct(
        string $nombreCompleto,
        string $correo,
        string $contrasenaHash,
        string $fechaNacimiento,
        float $salarioEsperado
    ) {
        $this->nombreCompleto = $nombreCompleto;
        $this->correo = $correo;
        $this->contrasenaHash = $contrasenaHash;
        $this->fechaNacimiento = $fechaNacimiento;
        $this->salarioEsperado = $salarioEsperado;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombreCompleto(): string
    {
        return $this->nombreCompleto;
    }

    public function setNombreCompleto(string $nombreCompleto): void
    {
        $this->nombreCompleto = $nombreCompleto;
    }

    public function getCorreo(): string
    {
        return $this->correo;
    }

    public function setCorreo(string $correo): void
    {
        $this->correo = $correo;
    }

    public function getContrasenaHash(): string
    {
        return $this->contrasenaHash;
    }

    public function setContrasenaHash(string $contrasenaHash): void
    {
        $this->contrasenaHash = $contrasenaHash;
    }

    public function getFechaNacimiento(): string
    {
        return $this->fechaNacimiento;
    }

    public function setFechaNacimiento(string $fechaNacimiento): void
    {
        $this->fechaNacimiento = $fechaNacimiento;
    }

    public function getSalarioEsperado(): float
    {
        return $this->salarioEsperado;
    }

    public function setSalarioEsperado(float $salarioEsperado): void
    {
        $this->salarioEsperado = $salarioEsperado;
    }

    // Guarda el empleado en la base de datos usando consultas preparadas
    public function guardar(): bool
    {
        $conexion = Conexion::getInstancia()->getConexion();

        $sql = 'INSERT INTO empleados (nombre_completo, correo, contrasena, fecha_nacimiento, salario_esperado)
                VALUES (:nombre_completo, :correo, :contrasena, :fecha_nacimiento, :salario_esperado)';

        $stmt = $conexion->prepare($sql);

        return $stmt->execute([
            ':nombre_completo' => $this->nombreCompleto,
            ':correo' => $this->correo,
            ':contrasena' => $this->contrasenaHash,
            ':fecha_nacimiento' => $this->fechaNacimiento,
            ':salario_esperado' => $this->salarioEsperado,
        ]);
    }
}
