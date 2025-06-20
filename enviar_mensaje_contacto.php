<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $asunto = $_POST['asunto'];
    $mensaje = $_POST['mensaje'];

    $stmt = $conn->prepare("INSERT INTO contactos (nombre, email, asunto, mensaje) VALUES (?, ?, ?, ?)");
    if ($stmt === false) {
        die("Error al preparar la consulta: " . $conn->error);
    }
    $stmt->bind_param("ssss", $nombre, $email, $asunto, $mensaje);

    if ($stmt->execute()) {
        echo "Tu mensaje para Delicias Express ha sido enviado exitosamente. <br>";
        echo "Nos pondremos en contacto contigo pronto. Redireccionando en 3 segundos...";
        header("refresh:3;url=contactanos.html");
    } else {
        echo "Error al enviar el mensaje: " . $stmt->error . "<br>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Acceso no autorizado. Por favor, envía el formulario desde contactanos.html";
}
?>