<form action="../../controllers/PersonaController.php?action=create" method="POST">
    <label for="nombres">Nombres:</label>
    <input type="text" name="nombres" id="nombres" required><br><br>

    <label for="apellidos">Apellidos:</label>
    <input type="text" name="apellidos" id="apellidos" required><br><br>

    <label for="fechanacimiento">Fecha de Nacimiento:</label>
    <input type="date" name="fechanacimiento" id="fechanacimiento" required><br><br>

    <label for="idsexo">Sexo:</label>
    <select name="idsexo" id="idsexo" required>
        <?php
        // Aquí deberías obtener los datos de la tabla sexo desde tu controlador
        // y generar las opciones del select dinámicamente.
        // Ejemplo (asumiendo que tienes una variable $sexos en tu vista):
        if (isset($sexos) && !empty($sexos)):
            foreach ($sexos as $sexo):
                echo '<option value="' . $sexo['idsexo'] . '">' . htmlspecialchars($sexo['nombre']) . '</option>';
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
        // y generar las opciones del select.
        // Ejemplo (asumiendo que tienes una variable $estadosCiviles en tu vista):
        if (isset($estadosCiviles) && !empty($estadosCiviles)):
            foreach ($estadosCiviles as $estadoCivil):
                echo '<option value="' . $estadoCivil['idestadocivil'] . '">' . htmlspecialchars($estadoCivil['nombre']) . '</option>';
            endforeach;
        else:
            echo '<option value="">No hay estados civiles disponibles</option>';
        endif;
        ?>
    </select><br><br>

    <input type="submit" value="Crear Persona">
</form>
