<form action="../../controllers/DireccionController.php?action=create" method="POST">
    

<div class="form-group">
                <label for="idpersona">Persona:</label>
                <select name="idpersona" id="idpersona" required>
                    <?php
                    if (isset($personas) && !empty($personas)):
                        foreach ($personas as $persona):
                            echo '<option value="' . $persona['idpersona'] . '">' . htmlspecialchars($persona['apellidos']). htmlspecialchars($persona['nombres'])  . '</option>';
                        endforeach;
                    else:
                        echo '<option value="">No hay estados civiles disponibles</option>';
                    endif;
                    ?>
                </select>
            </div>



    <label for="nombre">Dirección:</label>
    <input type="text" name="nombre" id="nombre" required>

    <input type="submit" value="Crear">
</form>
