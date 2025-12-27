<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservaciones - Hotel Cielo</title>
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/forms.css">
    <link rel="stylesheet" href="css/rooms.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/selected.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <?php
    $conn = new mysqli('srv1006.hstgr.io', 'u472469844_est31', '#Bd00031', 'u472469844_est31');

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }
    ?>
    
    <?php
    session_start();
    if (!isset($_SESSION['selectedRooms'])) {
        $_SESSION['selectedRooms'] = [];
    }

    if (isset($_POST['reserveRoom'])) {
        $selectedRoom = [
            'type' => $_POST['category_type'],
            'price' => $_POST['room_price']
        ];
        $_SESSION['selectedRooms'][] = $selectedRoom;
    }

    // Handle room deletion
    if (isset($_POST['deleteRoom'])) {
        $roomIndexToDelete = $_POST['roomIndex'];
        unset($_SESSION['selectedRooms'][$roomIndexToDelete]);
        // Reindex the array to avoid gaps
        $_SESSION['selectedRooms'] = array_values($_SESSION['selectedRooms']);
    }
    ?>

    <header>
        <nav class="navbar">
            <div class="logo">Hotel Cielo</div>
            <div class="nav-links">
                <a href="index.php">Inicio</a>
                <a href="reservations.php" class="active">Reservaciones</a>
                <a href="restaurant.php">Restaurante</a>
                <a href="bar.php">Bar</a>
                <a href="events.php">Eventos</a>
                <a href="login.php" class="login-btn">Iniciar Sesión</a>
            </div>
        </nav>
    </header>

    <main>
        <section class="reservation-form">
            <h2>Buscar Habitaciones</h2>
            <form id="searchForm" method="POST" action="">
                <div class="form-group">
                    <label for="checkIn">Fecha de Entrada:</label>
                    <input type="date" name="checkIn" id="checkIn">
                </div>
                <div class="form-group">
                    <label for="checkOut">Fecha de Salida:</label>
                    <input type="date" name="checkOut" id="checkOut">
                </div>
                <div class="form-group">
                    <label for="guests">Número de Habitaciones:</label>
                    <input type="number" name="guests" id="guests" min="1" value="2">
                </div>
                
                <?php
                $sqlGuests = "SELECT h.huesped_id, h.huesped_name, h.huesped_lastname 
                FROM Huespedes h
                INNER JOIN Usuarios u ON h.user_id = u.user_id
                ORDER BY h.huesped_lastname, h.huesped_name
                LIMIT 1";
                $resultGuests = $conn->query($sqlGuests);
  
                if ($guest = $resultGuests->fetch_assoc()) {
                    echo "<div class='form-group'>
                            <label for='guests'>Titular:</label>
                            <input type='text' name='titular' id='titular' 
                                    value='{$guest['huesped_name']} {$guest['huesped_lastname']}' 
                                    readonly>
                            <input type='hidden' name='titular_id' value='{$guest['huesped_id']}'>
                            </div>";
                }
                ?>
                <br>
                 <div class="form-group">
                    <label>Método de Pago por Noche:</label>
                    <div>
                        <input type="radio" id="web_payment" name="payment_method" value="web" required>
                        <label for="web_payment">Pago web</label>
                        
                        <input type="radio" id="hotel_payment" name="payment_method" value="hotel" required>
                        <label for="hotel_payment">Pago en hotel</label>
                    </div>
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Confirmar Reserva</button>
            </form>
        </section>




        <!-- Tabla de habitaciones seleccionadas -->
        <section id="selectedRooms">
            <h3>Habitaciones Seleccionadas</h3>
            <?php
            if (!empty($_SESSION['selectedRooms'])) {
                echo "<table border='1'>
                        <tr>
                            <th>Tipo de Habitación</th>
                            
                            <th>Precio (USD)</th>
                            <th>Acciones</th>
                        </tr>";
                foreach ($_SESSION['selectedRooms'] as $index => $room) {
                    echo "<tr>
                            <td>{$room['type']}</td>
                            <td>{$room['price']}</td>
                            <td>
                                <form method='POST' action=''>
                                    <input type='hidden' name='roomIndex' value='{$index}'>
                                    <button type='submit' name='deleteRoom' class='btn btn-danger'>Eliminar</button>
                                </form>
                            </td>
                          </tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No hay habitaciones seleccionadas.</p>";
            }
            ?>
        </section>

        <!-- Resultados dinámicos -->
       <!-- Resultados dinámicos -->
<section id="roomCatalog" class="room-catalog">
    <h2>Habitaciones Disponibles</h2>
    <div class="room-grid">
        <?php
        $showRooms = false;
        $sql = "SELECT h.room_id, c.category_type, c.category_beds, c.category_descripcion, 
                       c.category_maxcapacity, h.room_price, h.room_availability, c.category_image
                FROM Habitaciones h 
                INNER JOIN Categoria c ON h.category_id = c.category_id
                GROUP BY c.category_id";
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['checkIn'], $_POST['checkOut'], $_POST['guests'])) {
            $checkIn = $_POST['checkIn'];
            $checkOut = $_POST['checkOut'];
            $guests = (int)$_POST['guests'];

            if (strtotime($checkIn) >= strtotime($checkOut)) {
                echo "<p style='color: red;'>La fecha de entrada debe ser anterior a la de salida.</p>";
            } else {
                $showRooms = true;
            }
        } else {
            $showRooms = true;
        }

        if ($showRooms) {
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $imagePath = !empty($row['image']) ? $row['image'] : 'https://via.placeholder.com/300x200';
                    echo "<div class='room-card'>
                            <div class='room-info'>
                                <a href='detalle_habitacion.php?id={$row['room_id']}'>
                                    <img src='{$imagePath}' alt='Imagen de la habitación'>
                                </a>
                                <h3>{$row['category_type']}</h3>
                                <p>{$row['category_descripcion']}</p>
                                <span><strong>Capacidad:</strong> {$row['category_maxcapacity']}</span>
                                <span><strong>Precio:</strong> {$row['room_price']} USD</span>
                                <form method='POST' action=''>
                                    <input type='hidden' name='category_type' value='{$row['category_type']}'>
                                    <input type='hidden' name='room_price' value='{$row['room_price']}'>
                                    <button type='submit' name='reserveRoom' class='btn btn-primary'>Reservar</button>
                                </form>
                            </div>
                          </div>";
                }
            } else {
                echo "<p>No hay habitaciones disponibles.</p>";
            }

            $stmt->close();
        }

        $conn->close();
        ?>
    </div>
</section>


    </main>

    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h4>Contacto</h4>
                <p><i class="fas fa-phone"></i> +51 948 125 670</p>
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
        <div class="footer-bottom">
            <p>&copy; 2024 Hotel Cielo. Todos los derechos reservados.</p>
        </div>
    </footer>
</body>
</html>