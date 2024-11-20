<?php
header('Content-Type: application/json');
include 'db.php';

$tipo_usuario = $_POST['tipo_usuario'];
$nombre = $_POST['nombre'];
$telefono = $_POST['telefono'];
$direccion = $_POST['direccion'];
$correo_electronico = $_POST['correo_electronico'];

$sql = "INSERT INTO usuarios (tipo_usuario, nombre, telefono, direccion, correo_electronico) VALUES ('$tipo_usuario', '$nombre', '$telefono', '$direccion', '$correo_electronico')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(['status' => 'success', 'message' => 'Usuario agregado correctamente']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Error: ' . $conn->error]);
}

$conn->close();
?>
