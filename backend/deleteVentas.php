<?php
header('Content-Type: application/json');
require 'db.php';

$id = $_GET['id'];

$sql = "DELETE FROM ventas WHERE Id = $id";

if ($conn->query($sql) === TRUE) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['error' => $conn->error]);
}

$conn->close();
?>
