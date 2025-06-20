<?php
include 'db_connection.php';

$sql = "SELECT nombre_producto, descripcion, precio, categoria, imagen_url FROM productos WHERE disponible = TRUE";
$result = $conn->query($sql);

if ($result === false) {
    die("Error al ejecutar la consulta: " . $conn->error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nuestro Catálogo - Delicias Express - Hermosillo</title>
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
</head>
<body>
    <header>
        <h1>Delicias Express - Hermosillo</h1>
        <p>¡Tu sabor favorito, entregado rápidamente!</p>
    </header>

    <nav>
        <a href="index.html">Inicio</a><br>
        <a href="quieness.html">Quiénes Somos</a><br>
        <a href="clientes.html">Registro de Clientes</a><br>
        <a href="ventas.html">Registro de Ventas</a><br>
        <a href="catalogo.php">Nuestro Catálogo</a><br>
        <a href="contactanos.html">Contáctanos</a><br>
        <a href="programadores.html">Programadores</a><br>
    </nav>

    <main>
        <section class="fondo">
            <h2>Nuestro Catálogo</h2>
            <p>Descubre las deliciosas opciones que Delicias Express tiene para ti:</p>

            <div class="catalogo-grid">
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<div class='producto-card'>";
                        echo "<h3>" . htmlspecialchars($row["nombre_producto"]) . "</h3>";
                        echo "<img src='" . htmlspecialchars($row["imagen_url"]) . "' alt='" . htmlspecialchars($row["nombre_producto"]) . "' class='producto-img'>";
                        echo "<p>" . htmlspecialchars($row["descripcion"]) . "</p>";
                        echo "<p class='precio'>Precio: $" . number_format($row["precio"], 2) . "</p>";    
                        echo "<p class='categoria'>Categoría: " . htmlspecialchars($row["categoria"]) . "</p>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>No hay productos disponibles en el catálogo en este momento.</p>";
                }
                $conn->close();
                ?>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy;2025 Delicias Express - Hermosillo - Todos los derechos reservados.</p>
        <p>Maestra Alondra Zavala - 2025</p>
        <p>4A Programación - Mario Antonio Cárdenas López</p>
    </footer>

</body>
</html>