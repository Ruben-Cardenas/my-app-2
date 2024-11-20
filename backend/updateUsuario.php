<?php
header('Content-Type: application/json');
include 'db.php';

$num_usuario = $_POST['num_usuario'];
$tipo_usuario = $_POST['tipo_usuario'];
$nombre = $_POST['nombre'];
$telefono = $_POST['telefono'];
$direccion = $_POST['direccion'];
$correo_electronico = $_POST['correo_electronico'];

$sql = "UPDATE usuarios SET tipo_usuario = '$tipo_usuario', nombre = '$nombre', telefono = '$telefono', direccion = '$direccion', correo_electronico = '$correo_electronico' WHERE num_usuario = '$num_usuario'";

if ($conn->query($sql) === TRUE) {
    echo json_encode(['status' => 'success', 'message' => 'Usuario actualizado correctamente']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Error: ' . $conn->error]);
}

$conn->close();
?>
