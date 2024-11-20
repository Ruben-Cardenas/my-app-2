<?php
header('Content-Type: application/json');
require 'conexion.php';

// Verificar si se proporciona una tabla en la URL
$table = $_GET['table'] ?? null;

if (!$table) {
    echo json_encode(['error' => 'No se especificó ninguna tabla.']);
    exit;
}

// Asegurarse de que la tabla sea válida
$validTables = ['proveedores', 'trabajadores', 'ventas', 'servicios', 'clientes'];
if (!in_array($table, $validTables)) {
    echo json_encode(['error' => 'Tabla no válida.']);
    exit;
}

// Consultar los registros de la tabla específica
$sql = "SELECT fecha, accion, detalles FROM historial_$table ORDER BY fecha DESC";
$result = $conn->query($sql);

$records = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $records[] = $row;
    }
}

// Devolver los registros en formato JSON
echo json_encode($records);

$conn->close();
?>
