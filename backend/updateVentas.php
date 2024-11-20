<?php
header('Content-Type: application/json');
require 'db.php';

$id = $_GET['id'];
$data = json_decode(file_get_contents('php://input'), true);

$descripcion = $data['Descripcion'];
$tipo_de_pago = $data['Tipo_de_Pago'];
$total_pagado = $data['Total_pagado'];
$fecha = $data['Fecha'];
$num_usuario = $data['Num_usuario'];
$id_proveedor_servicio = $data['Id_proveedor_servicio'];
$num_empleado = $data['Num_empleado'];

$sql = "UPDATE ventas 
        SET Descripcion = '$descripcion', 
            Tipo_de_Pago = '$tipo_de_pago', 
            Total_pagado = '$total_pagado', 
            Fecha = '$fecha', 
            Num_usuario = '$num_usuario', 
            Id_proveedor_servicio = '$id_proveedor_servicio', 
            Num_empleado = '$num_empleado' 
        WHERE Id = $id";

if ($conn->query($sql) === TRUE) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['error' => $conn->error]);
}

$conn->close();
?>
