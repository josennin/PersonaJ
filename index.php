<?php include 'php/db.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>PersonaJ</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>PersonaJ</h1>
    <form action="php/add_friend.php" method="post">
        <input type="text" name="nombre" placeholder="Nombre" required>
        <select name="arcano_id" required>
            <option value="">Selecciona un arcano</option>
            <?php
            // Obtener todos los arcanos
            $stmt = $conn->query("SELECT * FROM Arcanos");
            $all_arcanos = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Obtener los arcanos asignados
            $stmt = $conn->query("SELECT arcano_id FROM PersonaJ");
            $assigned_arcanos = $stmt->fetchAll(PDO::FETCH_COLUMN);

            // Filtrar arcanos disponibles
            $available_arcanos = array_filter($all_arcanos, function($arcano) use ($assigned_arcanos) {
                return !in_array($arcano['id'], $assigned_arcanos);
            });

            foreach ($available_arcanos as $arcano): ?>
                <option value="<?php echo $arcano['id']; ?>"><?php echo $arcano['nombre']; ?></option>
            <?php endforeach; ?>
        </select>
        <input type="number" name="nivel_afinidad" placeholder="Nivel de Afinidad" required>
        <button type="submit">Agregar Amigo</button>
    </form>

    <div id="friends-list">
        <?php
        $stmt = $conn->query("SELECT PersonaJ.id, PersonaJ.nombre, PersonaJ.nivel_afinidad, Arcanos.nombre AS arcano, Arcanos.imagen_arcano 
                              FROM PersonaJ 
                              JOIN Arcanos ON PersonaJ.arcano_id = Arcanos.id");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<div class='friend'>";
            echo "<img src='images/{$row['imagen_arcano']}' alt='{$row['arcano']}'>";
            echo "<h2>{$row['nombre']}</h2>";
            echo "<p>Arcano: {$row['arcano']}</p>";
            echo "<p>Nivel de Afinidad: {$row['nivel_afinidad']}</p>";
            echo "<a href='php/edit_friend.php?id={$row['id']}'>Editar</a>";
            echo "<a href='php/delete_friend.php?id={$row['id']}' onclick='return confirm(\"¿Estás seguro?\")'>Eliminar</a>";
            echo "</div>";
        }
        ?>
    </div>

    <script src="js/scripts.js"></script>
</body>
</html>