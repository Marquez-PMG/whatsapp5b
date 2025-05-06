<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Persona</title>
</head>
<body>

<h1>Editar Persona</h1>
<form action="/apple5a/public/persona/update" method="POST">
    <input type="hidden" name="idpersona" value="<?php echo htmlspecialchars($persona['idpersona']); ?>">

    <label for="nombres">Nombres:</label>
    <input type="text" name="nombres" id="nombres" value="<?php echo htmlspecialchars($persona['nombres']); ?>" required><br><br>

    <label for="apellidos">Apellidos:</label>
    <input type="text" name="apellidos" id="apellidos" value="<?php echo htmlspecialchars($persona['apellidos']); ?>" required><br><br>

    <label for="fechanacimiento">Fecha de Nacimiento:</label>
    <input type="date" name="fechanacimiento" id="fechanacimiento" value="<?php echo htmlspecialchars($persona['fechanacimiento']); ?>" required><br><br>

    <label for="idsexo">Sexo:</label>
    <select name="idsexo" id="idsexo" required>
        <?php
        // Aquí deberías obtener los datos de la tabla sexo desde tu controlador
        // y seleccionar la opción correcta basándote en $persona['idsexo'].
        if (isset($sexos) && !empty($sexos)):
            foreach ($sexos as $sexoOption):
                $selected = ($sexoOption['idsexo'] == $persona['idsexo']) ? 'selected' : '';
                echo '<option value="' . $sexoOption['idsexo'] . '" ' . $selected . '>' . htmlspecialchars($sexoOption['nombre']) . '</option>';
            endforeach;
        else:
            echo '<option value="">No hay sexos disponibles</option>';
        endif;
        ?>
    </select><br><br>

    <label for="idestadocivil">Estado Civil:</label>
    <select name="idestadocivil" id="idestadocivil" required>
        <?php
        // De manera similar, aquí deberías obtener los datos de la tabla estadocivil
        // y seleccionar la opción correcta basándote en $persona['idestadocivil'].
        if (isset($estadosCiviles) && !empty($estadosCiviles)):
            foreach ($estadosCiviles as $estadoCivilOption):
                $selected = ($estadoCivilOption['idestadocivil'] == $persona['idestadocivil']) ? 'selected' : '';
                echo '<option value="' . $estadoCivilOption['idestadocivil'] . '" ' . $selected . '>' . htmlspecialchars($estadoCivilOption['nombre']) . '</option>';
            endforeach;
        else:
            echo '<option value="">No hay estados civiles disponibles</option>';
        endif;
        ?>
    </select><br><br>

    <input type="submit" value="Actualizar Persona">
</form>

<a href="index">Volver al listado</a>

</body>
</html>
