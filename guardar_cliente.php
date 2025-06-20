<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];

    $stmt = $conn->prepare("INSERT INTO clientes (nombre, apellido, email, telefono, direccion) VALUES (?, ?, ?, ?, ?)");
    if ($stmt === false) {
        die("Error al preparar la consulta: " . $conn->error);
    }
    $stmt->bind_param("sssss", $nombre, $apellido, $email, $telefono, $direccion);

    if ($stmt->execute()) {
        echo "Cliente registrado exitosamente. <br>";
        echo "Redireccionando en 3 segundos...";
        header("refresh:3;url=clientes.html"); 
    } else {
        echo "Error al registrar el cliente: " . $stmt->error . "<br>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Acceso no autorizado. Por favor, envía el formulario desde clientes.html";
}
?>