<?php
include 'db.php';

$nombre = $_POST['nombre'];
$arcano_id = $_POST['arcano_id'];
$nivel_afinidad = $_POST['nivel_afinidad'];

$stmt = $conn->prepare("INSERT INTO PersonaJ (nombre, arcano_id, nivel_afinidad) VALUES (?, ?, ?)");
$stmt->execute([$nombre, $arcano_id, $nivel_afinidad]);

header("Location: ../index.php");
?>