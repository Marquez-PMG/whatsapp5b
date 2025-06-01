<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Persona</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
            padding: 40px;
        }

        .form-container {
            background-color: #ffffff;
            max-width: 600px;
            margin: auto;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }

        .form-container h3 {
            margin-top: 30px;
            color: #555;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="date"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
        }

        .info-display {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 10px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #218838;
        }

        .form-group {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Editar Persona</h2>
    <form action="../../app/controllers/PersonaController.php?action=update" method="POST">
        <input type="hidden" name="idpersona" value="<?= $persona['idpersona'] ?>">

        <div class="form-group">
            <label for="nombres">Nombres:</label>
            <input type="text" name="nombres" id="nombres" value="<?= htmlspecialchars($persona['nombres']) ?>" required>
        </div>

        <div class="form-group">
            <label for="apellidos">Apellidos:</label>
            <input type="text" name="apellidos" id="apellidos" value="<?= htmlspecialchars($persona['apellidos']) ?>" required>
        </div>

        <div class="form-group">
            <label for="fechanacimiento">Fecha de Nacimiento:</label>
            <input type="date" name="fechanacimiento" id="fechanacimiento" value="<?= $persona['fechanacimiento'] ?>" required>
        </div>

        <div class="form-group">
            <label for="idsexo">Sexo:</label>
            <select name="idsexo" id="idsexo" required>
                <?php foreach ($sexos as $sexo): ?>
                    <option value="<?= $sexo['idsexo'] ?>" <?= $sexo['idsexo'] == $persona['idsexo'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($sexo['nombre']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="idestadocivil">Estado Civil:</label>
            <select name="idestadocivil" id="idestadocivil" required>
                <?php foreach ($estadosciviles as $estadocivil): ?>
                    <option value="<?= $estadocivil['idestadocivil'] ?>" <?= $estadocivil['idestadocivil'] == $persona['idestadocivil'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($estadocivil['nombre']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <input type="submit" value="Actualizar Persona">
    </form>

    <!-- Sección de Teléfonos -->
    <h3>Teléfonos Registrados</h3>
    <?php if (!empty($telefonos)): ?>
        <?php foreach ($telefonos as $telefono): ?>
            <div class="info-display">
                <strong>ID:</strong> <?= $telefono['idtelefono'] ?><br>
                <strong>Número:</strong> <?= htmlspecialchars($telefono['numero']) ?>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="info-display">No hay teléfonos registrados.</div>
    <?php endif; ?>

    <!-- Sección de Direcciones -->
    <h3>Direcciones Registradas</h3>
    <?php if (!empty($direcciones)): ?>
        <?php foreach ($direcciones as $direccion): ?>
            <div class="info-display">
                <strong>ID:</strong> <?= $direccion['iddireccion'] ?><br>
                <strong>Dirección:</strong> <?= htmlspecialchars($direccion['nombre']) ?>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="info-display">No hay direcciones registradas.</div>
    <?php endif; ?>
</div>

</body>
</html>
