<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar direcciones</title>
    <link rel="stylesheet" href="/apple5a/public/css/style.css">
</head>
<body>

<div class="container">
    <h1>Listar  direcciones</h1>
    <a href="/apple5a/app/views/sexo/create.php"><button>Agregar</button></a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($sexos) && is_array($sexos)): ?>
                <?php foreach ($sexos as $sexo): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($sexo['idsexo']); ?></td>
                        <td><?php echo htmlspecialchars($sexo['nombre']); ?></td>
                        <td>
    <a href="/apple5a/public/sexo/edit?idsexo=<?php echo htmlspecialchars($sexo['idsexo']); ?>">
        <button>Editar</button>
    </a>
    <a href="/apple5a/public/sexo/eliminar?idsexo=<?php echo htmlspecialchars($sexo['idsexo']); ?>" 
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

<script src="/apple5a/public/js/script.js"></script>
</body>
</html>
