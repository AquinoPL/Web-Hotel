<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bar - Hotel Cielo</title>
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/bar.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/forms.css">
    <link rel="stylesheet" href="../css/rooms.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/selected.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <?php
    // Conexión a la base de datos
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "hotel";

    $conn = new mysqli($host, $username, $password, $database);

    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }
    ?>

    <header>
        <nav class="navbar">
            <div class="logo">Hotel Cielo</div>
            <div class="nav-links">
                <a href="../index.php">Inicio</a>
                <a href="../reservations.php">Reservaciones</a>
                <a href="../restaurant.php">Restaurante</a>
                <a href="bar.php" class="active">Bar</a>
                <a href="../login.php" class="login-btn">Iniciar Sesión</a>
            </div>
        </nav>
    </header>

    <main>
        <section id="selectedProducts">
            <h3>Lista de Productos</h3>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Imagen</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Consulta para obtener productos
                    $sql = "SELECT product_id, product_name, product_description, product_price, product_quantity, product_image FROM Productos";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Mostrar productos en la tabla
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . htmlspecialchars($row['product_id']) . "</td>
                                    <td>" . htmlspecialchars($row['product_name']) . "</td>
                                    <td>" . htmlspecialchars($row['product_description']) . "</td>
                                    <td>S/ " . htmlspecialchars(number_format($row['product_price'], 2)) . "</td>
                                    <td>" . htmlspecialchars($row['product_quantity']) . "</td>
                                    <td>";
                            if (!empty($row['product_image'])) {
                                echo "<img src='" . htmlspecialchars($row['product_image']) . "' alt='Imagen del producto' style='width:100px; height:auto;'>";
                            } else {
                                echo "Sin imagen";
                            }
                            echo "</td></tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No hay productos disponibles</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </main>

    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h4>Contacto</h4>
                <p><i class="fas fa-phone"></i> +51 123 456 789</p>
                <p><i class="fas fa-envelope"></i> info@hotelcielo.com</p>
            </div>
            <div class="footer-section">
                <h4>Síguenos</h4>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>