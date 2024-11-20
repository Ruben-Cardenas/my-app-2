<?php
header('Content-Type: application/json');
include 'db.php';

$num_usuario = $_POST['num_usuario'];

$sql = "DELETE FROM usuarios WHERE num_usuario = '$num_usuario'";

if ($conn->query($sql) === TRUE) {
    echo json_encode(['status' => 'success', 'message' => 'Usuario eliminado correctamente']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Error: ' . $conn->error]);
}

$conn->close();
?>
