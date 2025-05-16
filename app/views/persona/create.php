<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Persona</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
            padding: 40px;
        }

        .form-container {
            background-color: #ffffff;
            max-width: 500px;
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

        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .form-group {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <div class="form-container">
        <h2>Crear Nueva Persona</h2>
        <form action="../../app/controllers/PersonaController.php?action=create" method="POST">
            <div class="form-group">
                <label for="nombres">Nombres:</label>
                <input type="text" name="nombres" id="nombres" required>
            </div>

            <div class="form-group">
                <label for="apellidos">Apellidos:</label>
                <input type="text" name="apellidos" id="apellidos" required>
            </div>

            <div class="form-group">
                <label for="fechanacimiento">Fecha de Nacimiento:</label>
                <input type="date" name="fechanacimiento" id="fechanacimiento" required>
            </div>

            <div class="form-group">
                <label for="idsexo">Sexo:</label>
                <select name="idsexo" id="idsexo" required>
                    <?php
                    if (isset($sexos) && !empty($sexos)):
                        foreach ($sexos as $sexo):
                            echo '<option value="' . $sexo['idsexo'] . '">' . htmlspecialchars($sexo['nombre']) . '</option>';
                        endforeach;
                    else:
                        echo '<option value="">No hay sexos disponibles</option>';
                    endif;
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="idestadocivil">Estado Civil:</label>
                <select name="idestadocivil" id="idestadocivil" required>
                    <?php
                    if (isset($estadosciviles) && !empty($estadosciviles)):
                        foreach ($estadosciviles as $estadocivil):
                            echo '<option value="' . $estadocivil['idestadocivil'] . '">' . htmlspecialchars($estadocivil['nombre']) . '</option>';
                        endforeach;
                    else:
                        echo '<option value="">No hay estados civiles disponibles</option>';
                    endif;
                    ?>
                </select>
            </div>

            <input type="submit" value="Crear Persona">
        </form>
    </div>

</body>
</html>

