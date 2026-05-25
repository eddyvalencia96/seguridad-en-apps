<?php
// Formulario de registro seguro de empleados

declare(strict_types=1);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Seguro de Empleados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h1 class="h4 mb-3">Registro Seguro de Empleados</h1>
                        <p class="text-muted">Complete los datos de manera segura. Todos los campos son obligatorios.</p>

                        <form action="procesar.php" method="POST" novalidate>
                            <div class="mb-3">
                                <label for="nombre_completo" class="form-label">Nombre completo</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="nombre_completo"
                                    name="nombre_completo"
                                    required
                                    maxlength="100"
                                    placeholder="Ej. Ana Perez"
                                >
                            </div>

                            <div class="mb-3">
                                <label for="correo" class="form-label">Correo</label>
                                <input
                                    type="email"
                                    class="form-control"
                                    id="correo"
                                    name="correo"
                                    required
                                    maxlength="100"
                                    placeholder="ejemplo@correo.com"
                                >
                            </div>

                            <div class="mb-3">
                                <label for="contrasena" class="form-label">Contrasena</label>
                                <input
                                    type="password"
                                    class="form-control"
                                    id="contrasena"
                                    name="contrasena"
                                    required
                                    minlength="8"
                                    placeholder="Minimo 8 caracteres"
                                >
                            </div>

                            <div class="mb-3">
                                <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento</label>
                                <input
                                    type="date"
                                    class="form-control"
                                    id="fecha_nacimiento"
                                    name="fecha_nacimiento"
                                    required
                                >
                            </div>

                            <div class="mb-4">
                                <label for="salario_esperado" class="form-label">Salario esperado</label>
                                <input
                                    type="number"
                                    class="form-control"
                                    id="salario_esperado"
                                    name="salario_esperado"
                                    required
                                    min="0"
                                    step="0.01"
                                    placeholder="Ej. 2500.00"
                                >
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Registrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
