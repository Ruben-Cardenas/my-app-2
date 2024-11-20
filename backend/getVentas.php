<?php
header('Content-Type: application/json');
require 'db.php';

$sql = "SELECT * FROM ventas";
$result = $conn->query($sql);

$ventas = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $ventas[] = $row;
    }
}

echo json_encode($ventas);

$conn->close();
?>
