<?php
header('Content-Type: application/json');
include 'db.php';

$sql = "SELECT num_usuario, tipo_usuario, nombre, telefono, direccion, correo_electronico FROM usuarios";
$result = $conn->query($sql);

$usuarios = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $usuarios[] = $row;
    }
}

echo json_encode($usuarios);
$conn->close();
?>

