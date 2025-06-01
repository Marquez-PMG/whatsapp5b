<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Estados Civiles</title>
    <link rel="stylesheet" href="/whatsapp5b/public/css/style.css">
</head>
<body>

<div class="container">
    <h1>Listar Estados Civiles</h1>
    <a href="/whatsapp5b/app/views/estadocivil/create.php"><button>Agregar</button></a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($estadosciviles) && is_array($estadosciviles)): ?>
                <?php foreach ($estadosciviles as $estadocivil): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($estadocivil['idestadocivil']); ?></td>
                        <td><?php echo htmlspecialchars($estadocivil['nombre']); ?></td>
                        <td>
                            <a href="/whatsapp5b/public/estadocivil/edit?idestadocivil=<?php echo htmlspecialchars($estadocivil['idestadocivil']); ?>">
                                <button>Editar</button>
                            </a>
                            <a href="/whatsapp5b/public/estadocivil/eliminar?idestadocivil=<?php echo htmlspecialchars($estadocivil['idestadocivil']); ?>"
                               onclick="return confirm('¿Estás seguro de eliminar este registro?');">
                                <button>Eliminar</button>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3">No hay registros disponibles.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script src="/whatsapp5b/public/js/script.js"></script>
</body>
</html>
