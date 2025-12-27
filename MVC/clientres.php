<?php
session_start();

$conn = new mysqli('srv1006.hstgr.io', 'u472469844_est31', '#Bd00031', 'u472469844_est31');

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si hay habitaciones seleccionadas
if (!isset($_SESSION['selectedRooms']) || empty($_SESSION['selectedRooms'])) {
    header('Location: reservations.php'); // Redirigir si no hay habitaciones seleccionadas
    exit;
}

// Recuperar las fechas y el número de habitaciones desde la sesión
$checkIn = $_SESSION['checkIn'] ?? '';
$checkOut = $_SESSION['checkOut'] ?? '';
$guests = $_SESSION['guests'] ?? 0;
$selectedRooms = $_SESSION['selectedRooms'];

// Consultar información detallada de las habitaciones seleccionadas
$totalPrice = 0;
$roomsDetails = [];

foreach ($selectedRooms as $room) {
    $roomId = $room['room_id'];

    $sql = "SELECT h.room_id, c.category_type AS type, h.room_price AS price, h.room_capacity AS capacity, h.room_floor AS floor
            FROM Habitaciones h
            INNER JOIN Categoria c ON h.category_id = c.category_id
            WHERE h.room_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $roomId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $roomDetails = $result->fetch_assoc();
        $roomsDetails[] = $roomDetails;
        $totalPrice += $roomDetails['price'];
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmar Reservación - Hotel Cielo</title>
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/forms.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/rooms.css">
    <link rel="stylesheet" href="css/selected.css">
    <link rel="stylesheet" href="css/tables.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<header>
        <nav class="navbar">
            <div class="logo">Hotel Cielo</div>
            <div class="nav-links">
                <a href="index.php">Inicio</a>
                <a href="reservations.php" class="active">Reservaciones</a>
                <a href="restaurante/restaurant.php">Restaurante</a>
                <a href="bar/bar.php">Bar</a>
                <a href="REPORTES/indexxx.php">Reportes</a>
                <a href="login.php" class="login-btn">Iniciar Sesión</a>
            </div>
        </nav>
    </header>

    <main>
        <section class="room-catalog">
            <h2>Resumen de la Reserva</h2>
            <p><strong>Fecha de Entrada:</strong> <?php echo htmlspecialchars($checkIn); ?></p>
            <p><strong>Fecha de Salida:</strong> <?php echo htmlspecialchars($checkOut); ?></p>
            <p><strong>Número de Habitaciones:</strong> <?php echo $guests; ?></p>

            <h3>Habitaciones Seleccionadas</h3>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Tipo</th>
            <th>Capacidad</th>
            <th>Piso</th>
            <th>Precio (USD)</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($roomsDetails as $index => $room): ?>
        <tr>
            <td><?php echo htmlspecialchars($room['room_id']); ?></td>
            <td><?php echo htmlspecialchars($room['type']); ?></td>
            <td><?php echo htmlspecialchars($room['capacity']); ?></td>
            <td><?php echo htmlspecialchars($room['floor']); ?></td>
            <td><?php echo htmlspecialchars($room['price']); ?> USD</td>
            <td>
                <!-- Botón para modificar habitación -->
                <form method="POST" action="reservations.php">
                    <input type="hidden" name="roomIndex" value="<?php echo $index; ?>">
                    <button type="submit" name="modifyRoom" class="btn-warning">Modificar</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

            
            <h3>Precio Total</h3>
            <p><?php echo $totalPrice; ?> USD</p>

            <!-- Formulario para ingresar los datos del usuario -->
            <h3>Datos del Usuario</h3>
            <form method="POST" action="validacion.php">
                <div class="form-group">
                    <label for="typedoc">Tipo de Documento:</label>
                    <input type="text" name="typedoc" id="typedoc" required>
                </div>
                <div class="form-group">
                    <label for="doc">Número de Documento:</label>
                    <input type="text" name="doc" id="doc" required>
                </div>
                <div class="form-group">
                    <label for="name">Nombre:</label>
                    <input type="text" name="name" id="name" required>
                </div>
                <div class="form-group">
                    <label for="lastname">Apellido:</label>
                    <input type="text" name="lastname" id="lastname" required>
                </div>
                <div class="form-group">
                    <label for="phonenumber">Teléfono:</label>
                    <input type="text" name="phonenumber" id="phonenumber">
                </div>
                <div class="form-group">
                    <label for="email">Correo Electrónico:</label>
                    <input type="email" name="email" id="email">
                </div>
                
                <h3>Pago de Reserva</h3>
                <p><strong>Total a Pagar:</strong> <?php echo $totalPrice; ?> USD</p>

                <button type="submit" class="btn btn-success">Confirmar y Pagar</button>
            </form>
        </section>
    </main>

    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h4>Contacto</h4>
                <p><i class="fas fa-phone"></i> +51 948 125 670</p>
                <p><i class="fas fa-envelope"></i> contacto@hotelcielo.com</p>
            </div>
            <div class="footer-section">
                <h4>Dirección</h4>
                <p>Calle Ficticia 123, Lima, Perú</p>
            </div>
        </div>
    </footer>
</body>
</html>
