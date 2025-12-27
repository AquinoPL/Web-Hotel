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
    $host = "srv1006.hstgr.io";
    $username = "u472469844_est31";
    $password = "#Bd00031";
    $database = "u472469844_est31";
    
    $conn = new mysqli($host, $username, $password, $database);

    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    session_start();
    if (!isset($_SESSION['selectedProducts'])) {
        $_SESSION['selectedProducts'] = [];
    }
    

    

    // Agregar producto al carrito
    if (isset($_POST['addProduct'])) {
        $selectedProduct = [
            'name' => $_POST['product_name'],
            'price' => $_POST['product_price'],
            'quantity' => $_POST['product_quantity'] // Añadir cantidad
        ];
        $_SESSION['selectedProducts'][] = $selectedProduct;
    }

    // Eliminar producto del carrito
    if (isset($_POST['deleteProduct'])) {
        $productIndexToDelete = $_POST['productIndex'];
        unset($_SESSION['selectedProducts'][$productIndexToDelete]);
        $_SESSION['selectedProducts'] = array_values($_SESSION['selectedProducts']);
    }

    // Pagar directamente y reducir cantidad de productos
    if (isset($_POST['payDirectly'])) {
        $totalCost = 0;
        foreach ($_SESSION['selectedProducts'] as $product) {
            $totalCost += $product['price'] * $product['quantity']; // Calcular el costo total por producto

            // Reducir la cantidad de cada producto en la base de datos según la cantidad seleccionada
            $stmt = $conn->prepare("UPDATE Productos SET product_quantity = product_quantity - ? WHERE product_name = ?");
            $stmt->bind_param("is", $product['quantity'], $product['name']);
            $stmt->execute();
        }

        // Mostrar mensaje de pago exitoso
        echo "<script>alert('Pago realizado con éxito. Total: \$" . $totalCost . " USD');</script>";
        $_SESSION['selectedProducts'] = []; // Limpiar el carrito
    }

    if (!isset($_SESSION['showSearchBar'])) {
        $_SESSION['showSearchBar'] = false;
    }

    // Mostrar la barra de búsqueda si se ha presionado el botón "Añadir a Cuenta"
    if (isset($_POST['addToAccount'])) {
        $_SESSION['showSearchBar'] = true;
    }

    // Variable para mostrar mensajes
    $message = "";

    // Lógica para manejar la búsqueda
    // Lógica para manejar la búsqueda
    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $searchTerm = $_GET['search'];

        // Buscar en la tabla Usuarios
        $sqlUsuarios = "SELECT user_name, user_lastname, user_doc FROM Usuarios WHERE user_doc = ?";
        $stmtUsuarios = $conn->prepare($sqlUsuarios);
        $stmtUsuarios->bind_param("s", $searchTerm);
        $stmtUsuarios->execute();
        $resultUsuarios = $stmtUsuarios->get_result();

        if ($resultUsuarios->num_rows > 0) {
            $user = $resultUsuarios->fetch_assoc();
            $message = "Usuario encontrado: " . $user['user_name'] . " " . $user['user_lastname'] . " (Documento: " . $user['user_doc'] . ")";
        } else {
            // Buscar en la tabla Huespedes
            $sqlHuespedes = "SELECT huesped_name, huesped_lastname, huesped_doc FROM Huespedes WHERE huesped_doc = ?";
            $stmtHuespedes = $conn->prepare($sqlHuespedes);
            $stmtHuespedes->bind_param("s", $searchTerm);
            $stmtHuespedes->execute();
            $resultHuespedes = $stmtHuespedes->get_result();

            if ($resultHuespedes->num_rows > 0) {
                $huesped = $resultHuespedes->fetch_assoc();
                $message = "Huésped encontrado: " . $huesped['huesped_name'] . " " . $huesped['huesped_lastname'] . " (Documento: " . $huesped['huesped_doc'] . ")";
            } else {
                $message = "No se encontró ningún usuario o huésped con ese documento.";
            }
        }

        // Limpiar el mensaje después de mostrarlo
        $_SESSION['message'] = ""; 
    }



    function insertConsumo($conn, $reservationId, $productId, $quantity) {
        // Liberar resultados si hay alguna consulta pendiente
        if ($conn->more_results()) {
            $conn->next_result();
        }
    
        // Llamar al procedimiento almacenado para registrar el consumo
        $stmtConsumo = $conn->prepare("CALL RegistrarConsumoBar(?, ?, ?)");
        $stmtConsumo->bind_param("iii", $reservationId, $productId, $quantity); // Asignar los parámetros
        $stmtConsumo->execute(); // Ejecutar la llamada al procedimiento
    
        // Verificar si el procedimiento fue exitoso
        if ($stmtConsumo->affected_rows > 0) {
            echo "<script>alert('Consumo registrado correctamente.');</script>";
        } else {
            echo "<script>alert('Error al registrar el consumo.');</script>";
        }
    
        // Cerrar el statement de consumo
        $stmtConsumo->close();
    }
    
    if (isset($_POST['addResult'])) {
        $totalCost = 0;
        foreach ($_SESSION['selectedProducts'] as $product) {
            $totalCost += $product['price'] * $product['quantity']; // Calcular el costo total por producto
        }
        echo "<script>alert('Pago realizado con éxito. Total: \$" . $totalCost . " USD');</script>";
        // Paso 1: Obtener la reservación por número de documento
        $stmt = $conn->prepare("CALL BuscarReservacionPorDocumento(?)");
        $stmt->bind_param("s", $searchTerm); // El número de documento es el parámetro de entrada
        $stmt->execute();
        $stmt->bind_result($reservationId); // El ID de la reservación
        $stmt->fetch();
            
        $stmt->free_result(); // Liberar los resultados
        $stmt->close(); // Cerrar el statement
    
        // Paso 2: Procesar todos los productos seleccionados
        if (isset($_SESSION['selectedProducts']) && count($_SESSION['selectedProducts']) > 0) {
            // Iterar sobre todos los productos seleccionados
            foreach ($_SESSION['selectedProducts'] as $product) {
                // Verificar que la cantidad sea un número entero positivo
                $quantity = intval($product['quantity']); // Convertir a entero
    
                // Si la cantidad no es un valor válido, continuar con el siguiente producto
                if ($quantity <= 0) {
                    echo "<script>alert('La cantidad para el producto " . $product['name'] . " no es válida.');</script>";
                    continue;
                }
    
                // Obtener el product_id usando el procedimiento BuscarProductoPorNombre
                $stmtProduct = $conn->prepare("CALL BuscarProductoPorNombre(?)");
                $stmtProduct->bind_param("s", $product['name']); // El nombre del producto es el parámetro de entrada
                $stmtProduct->execute();
    
                // Usamos get_result() para obtener el resultado
                $result = $stmtProduct->get_result();
                if ($row = $result->fetch_assoc()) {
                    $productId = $row['product_id']; // Obtener el product_id del resultado
                    
                    // Paso 3: Llamar a la función insertConsumo para registrar el consumo
                    insertConsumo($conn, $reservationId, $productId, $quantity); // Llamada a la función
                }
                $_SESSION['selectedProducts'] = [];
                // Liberar el resultado y cerrar el statement de producto
                $result->free();
                $stmtProduct->close();
            }
        }  
        $_SESSION['showSearchBar'] = false; // Ocultar la barra de búsqueda
    }
    
    
    

    ?>

    <header>
        <nav class="navbar">
            <div class="logo">Hotel Cielo</div>
            <div class="nav-links">
                <a href="../index.php">Inicio</a>
                <a href="../reservations.php">Reservaciones</a>
                <a href="../restaurant/restaurant.php">Restaurante</a>
                <a href="bar.php" class="active">Bar</a>
                <a href="../REPORTES/indexxx.php">Reportes</a>
                <a href="../login.php" class="login-btn">Iniciar Sesión</a>
            </div>
        </nav>
    </header>

    <main>
        <!-- Carrito de Compras -->
        <section id="selectedProducts">
            <h3>Carrito de Compras</h3>
            <?php
            $totalCost = 0;
            if (!empty($_SESSION['selectedProducts'])) {
                echo "<table border='1'>
                        <tr>
                            <th>Nombre del Producto</th>
                            <th>Cantidad</th>
                            <th>Precio (USD)</th>
                            <th>Total (USD)</th>
                            <th>Acciones</th>
                        </tr>";
                foreach ($_SESSION['selectedProducts'] as $index => $product) {
                    $productTotal = $product['price'] * $product['quantity']; // Calcular el total por producto
                    $totalCost += $productTotal;
                    echo "<tr>
                            <td>{$product['name']}</td>
                            <td>{$product['quantity']}</td>
                            <td>{$product['price']}</td>
                            <td>{$productTotal}</td>
                            <td>
                                <form method='POST' action=''>
                                    <input type='hidden' name='productIndex' value='{$index}'>
                                    <button type='submit' name='deleteProduct' class='btn btn-danger'>Eliminar</button>
                                </form>
                            </td>
                        </tr>";
                }
                echo "</table>";
                echo "<div class='total-cost'>
                        <h4>Total a pagar: <span>\${$totalCost} USD</span></h4>
                    </div>";

                // Botón para pagar
                echo "<div class='payment-buttons'>
                        <form method='POST' action=''>
                        <button type='submit' name='payDirectly' class='btn btn-pay'>Pagar</button>
                    </form>";
                // Botón para Añadir a la cuenta
                echo "<div class='payment-buttons'>
                        <form method='POST'>
                            <form method='POST'>
                                <button type='submit' name='addToAccount' value='1' class='btn btn-pay'>Añadir a Cuenta</button>
                            </form>
                        </form>

                    </div>";
            } else {
                echo "<p>No hay productos seleccionados.</p>";
            }
            ?>
        </section>

        <?php
        // Simulación de resultados de búsqueda (reemplazar esto con tu lógica real)
        $resultFound = !empty($message); // Determina si hay un resultado basado en $message.

        if (isset($_SESSION['showSearchBar']) && $_SESSION['showSearchBar']): ?>
            <section id="searchSection">
                <div class="search-container">
                    <form method="GET" class="search-form">
                        <label for="search" class="search-label">Número de Documento:</label>
                        <input type="text" id="search" name="search" placeholder="Ingresa el documento" required>
                        <button type="submit" class="btn btn-search">Buscar</button>
                    </form>
                </div>
                <?php if ($resultFound): ?>
                    <div class="search-result">
                        <p class="result-text"><?php echo $message; ?></p>
                        <!-- Botón "Añadir" cuando hay un resultado -->
                        <form method="POST" class="add-form">
                            <div class="button-container">
                                <button type="submit" name="addResult" class="btn btn-info">Añadir</button>
                            </div>
                        </form>
                    </div>
                <?php endif; ?>
                <?php $_SESSION['message'] = ""; ?>
            </section>
            <?php endif; ?>
            

        <!-- Catálogo de Productos -->
        <!-- Catálogo de Productos -->
        <section id="productCatalog" class="room-catalog">
            <h2>Productos Disponibles</h2>
            <div class="room-grid">
                <?php
                $sql = "SELECT p.product_id, p.product_name, p.product_description, 
                            p.product_price, p.product_quantity, p.product_image
                        FROM Productos p";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $imagePath = !empty($row['product_image']) ? $row['product_image'] : 'https://via.placeholder.com/300x200';
                        echo "<div class='room-card'>
                                <div class='room-info'>
                                    <img src='{$imagePath}' alt='Imagen del producto'>
                                    <h3>{$row['product_name']}</h3>
                                    <p>{$row['product_description']}</p>
                                    <p>Precio: \${$row['product_price']}</p>
                                    <form method='POST' action='' style='display: flex; align-items: center; gap: 5px;'>
                                        <input type='hidden' name='product_name' value='{$row['product_name']}'>
                                        <input type='hidden' name='product_price' value='{$row['product_price']}'>
                                        
                                        <!-- Campo para seleccionar la cantidad con botones + y - -->
                                        <button type='button' onclick='updateQuantity(this, -1, {$row['product_quantity']})' style='padding: 5px; background-color: #f0f0f0; border: 1px solid #ccc; cursor: pointer;'>-</button>
                                        <input type='number' name='product_quantity' value='1' min='1' max='{$row['product_quantity']}' readonly style='width: 60px; text-align: center;'>
                                        <button type='button' onclick='updateQuantity(this, 1, {$row['product_quantity']})' style='padding: 5px; background-color: #f0f0f0; border: 1px solid #ccc; cursor: pointer;'>+</button>
                                        
                                        <button type='submit' name='addProduct' class='btn btn-info'>Agregar al Carrito</button>
                                    </form>
                                </div>
                            </div>";
                    }
                } else {
                    echo "<p>No hay productos disponibles.</p>";
                }
                ?>
            </div>
        </section>

        <script>
        function updateQuantity(button, change, maxQuantity) {
            const input = button.parentElement.querySelector("input[name='product_quantity']");
            let currentValue = parseInt(input.value);
            currentValue += change;
            if (currentValue < 1) currentValue = 1;
            if (currentValue > maxQuantity) currentValue = maxQuantity;
            input.value = currentValue;
        }
        </script>


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