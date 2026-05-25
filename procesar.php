<?php
// Controlador para procesar el registro de empleados

declare(strict_types=1);

require_once __DIR__ . '/includes/Empleado.php';

$errores = [];
$exito = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombreCompleto = trim($_POST['nombre_completo'] ?? '');
    $correo = trim($_POST['correo'] ?? '');
    $contrasena = $_POST['contrasena'] ?? '';
    $fechaNacimiento = trim($_POST['fecha_nacimiento'] ?? '');
    $salarioEsperado = trim($_POST['salario_esperado'] ?? '');

    // Validaciones basicas de no vacio
    if ($nombreCompleto === '') {
        $errores[] = 'El nombre completo es obligatorio.';
    }

    if ($correo === '') {
        $errores[] = 'El correo es obligatorio.';
    } elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $errores[] = 'El correo no tiene un formato valido.';
    }

    if ($contrasena === '') {
        $errores[] = 'La contrasena es obligatoria.';
    } elseif (strlen($contrasena) < 8) {
        $errores[] = 'La contrasena debe tener al menos 8 caracteres.';
    }

    if ($fechaNacimiento === '') {
        $errores[] = 'La fecha de nacimiento es obligatoria.';
    }

    if ($salarioEsperado === '') {
        $errores[] = 'El salario esperado es obligatorio.';
    } elseif (!is_numeric($salarioEsperado) || (float)$salarioEsperado < 0) {
        $errores[] = 'El salario esperado debe ser un numero positivo.';
    }

    // Si no hay errores, sanitizar y procesar
    if (count($errores) === 0) {
        $nombreCompletoSeguro = htmlspecialchars($nombreCompleto, ENT_QUOTES, 'UTF-8');
        $correoSeguro = htmlspecialchars($correo, ENT_QUOTES, 'UTF-8');
        $fechaNacimientoSeguro = htmlspecialchars($fechaNacimiento, ENT_QUOTES, 'UTF-8');
        $salarioEsperadoSeguro = (float)$salarioEsperado;

        // Hash seguro de la contrasena
        $contrasenaHash = password_hash($contrasena, PASSWORD_DEFAULT);

        try {
            $empleado = new Empleado(
                $nombreCompletoSeguro,
                $correoSeguro,
                $contrasenaHash,
                $fechaNacimientoSeguro,
                $salarioEsperadoSeguro
            );

            $exito = $empleado->guardar();
            if (!$exito) {
                $errores[] = 'No se pudo registrar el empleado. Intente nuevamente.';
            }
        } catch (Exception $e) {
            $errores[] = 'Ocurrio un error inesperado al registrar el empleado.';
        }
    }
} else {
    $errores[] = 'Metodo no permitido.';
}

// Respuesta sencilla para el usuario
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado del Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h1 class="h4 mb-3">Resultado del Registro</h1>

                <?php if ($exito): ?>
                    <div class="alert alert-success">Empleado registrado correctamente.</div>
                <?php else: ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            <?php foreach ($errores as $error): ?>
                                <li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <a class="btn btn-primary" href="index.php">Volver al formulario</a>
            </div>
        </div>
    </div>
</body>
</html>
