<?php
include 'db.php';

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM PersonaJ WHERE id = ?");
$stmt->execute([$id]);
$friend = $stmt->fetch(PDO::FETCH_ASSOC);

// Obtener todos los arcanos
$stmt = $conn->query("SELECT * FROM Arcanos");
$all_arcanos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Obtener los arcanos asignados excluyendo el arcano actual del amigo
$stmt = $conn->prepare("SELECT arcano_id FROM PersonaJ WHERE id != ?");
$stmt->execute([$id]);
$assigned_arcanos = $stmt->fetchAll(PDO::FETCH_COLUMN);

// Filtrar arcanos disponibles
$available_arcanos = array_filter($all_arcanos, function($arcano) use ($assigned_arcanos) {
    return !in_array($arcano['id'], $assigned_arcanos);
});

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $arcano_id = $_POST['arcano_id'];
    $nivel_afinidad = $_POST['nivel_afinidad'];

    $stmt = $conn->prepare("UPDATE PersonaJ SET nombre = ?, arcano_id = ?, nivel_afinidad = ? WHERE id = ?");
    $stmt->execute([$nombre, $arcano_id, $nivel_afinidad, $id]);

    header("Location: ../index.php");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Amigo</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h1>Editar Amigo</h1>
    <form method="post">
        <input type="text" name="nombre" value="<?php echo $friend['nombre']; ?>" required>
        <select name="arcano_id" required>
            <option value="<?php echo $friend['arcano_id']; ?>"><?php echo $friend['arcano_id']; ?></option>
            <?php foreach ($available_arcanos as $arcano): ?>
                <option value="<?php echo $arcano['nombre']; ?>"><?php echo $arcano['nombre']; ?></option>
            <?php endforeach; ?>
        </select>
        <input type="number" name="nivel_afinidad" value="<?php echo $friend['nivel_afinidad']; ?>" required>
        <button type="submit">Actualizar</button>
    </form>
</body>
</html>