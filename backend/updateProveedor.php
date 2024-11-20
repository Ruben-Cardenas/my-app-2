<?php
header('Content-Type: application/json');

$conexion = new mysqli("localhost", "root", "", "canesa");

if ($conexion->connect_error) {
    echo json_encode(["status" => "error", "message" => "Error en la conexión a la base de datos"]);
    exit;
}

$nombre = $_POST['nombre'];
$correo_electronico = $_POST['correo_electronico'];
$telefono = $_POST['telefono'];
$detalles = $_POST['detalles'];

$query = "UPDATE proveedores SET Correo_Electronico = ?, Telefono = ?, Detalles = ? WHERE Nombre = ?";
$stmt = $conexion->prepare($query);
$stmt->bind_param("ssss", $correo_electronico, $telefono, $detalles, $nombre);

if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "Proveedor actualizado exitosamente"]);
} else {
    echo json_encode(["status" => "error", "message" => "Error al actualizar proveedor"]);
}

$stmt->close();
$conexion->close();
?>
