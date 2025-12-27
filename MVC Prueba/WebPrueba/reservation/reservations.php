<?php
session_start();

$conn = new mysqli('srv1006.hstgr.io', 'u472469844_est31', '#Bd00031', 'u472469844_est31');

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Guardar fechas y huéspedes en la sesión
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['checkIn'], $_POST['checkOut'], $_POST['guests'])) {
    $_SESSION['checkIn'] = $_POST['checkIn'];
    $_SESSION['checkOut'] = $_POST['checkOut'];
    $_SESSION['guests'] = $_POST['guests'];
}

// Inicializar habitaciones seleccionadas
if (!isset($_SESSION['selectedRooms'])) {
    $_SESSION['selectedRooms'] = [];
}

// Reservar habitación
if (isset($_POST['reserveRoom'])) {
    $selectedRooms = [
        'room_id' => $_POST['room_id'],
        'type' => $_POST['category_type'],
        'price' => $_POST['room_price']
    ];
    $_SESSION['selectedRooms'][] = $selectedRooms;
}

// Eliminar habitación
if (isset($_POST['deleteRoom'])) {
    $roomIndexToDelete = $_POST['roomIndex'];
    unset($_SESSION['selectedRooms'][$roomIndexToDelete]);
    $_SESSION['selectedRooms'] = array_values($_SESSION['selectedRooms']);
}

// Mostrar habitaciones por categoría seleccionada
if (isset($_POST['viewRooms'])) {
    $categoryId = $_POST['category_id'];

    $sql = "SELECT h.room_id, c.category_type, h.room_price, h.room_availability 
            FROM Habitaciones h 
            INNER JOIN Categoria c ON h.category_id = c.category_id
            WHERE h.category_id = ? AND h.room_availability = 1";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $categoryId);
    $stmt->execute();
    $roomsResult = $stmt->get_result();

    // Almacenar los resultados en una variable para usarlos más adelante
    $roomsList = $roomsResult->fetch_all(MYSQLI_ASSOC);
}
?>

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
        <!-- Formulario de búsqueda -->
        <section class="reservation-form">
            <h2>Buscar Habitaciones</h2>
            <form id="searchForm" method="POST" action="">
                <div class="form-group">
                    <label for="checkIn">Fecha de Entrada:</label>
                    <input type="date" name="checkIn" id="checkIn" value="<?php echo $_SESSION['checkIn'] ?? ''; ?>" required>
                </div>
                <div class="form-group">
                    <label for="checkOut">Fecha de Salida:</label>
                    <input type="date" name="checkOut" id="checkOut" value="<?php echo $_SESSION['checkOut'] ?? ''; ?>" required>
                </div>
                <div class="form-group">
                    <label for="guests">Número de Habitaciones:</label>
                    <input type="number" name="guests" id="guests" min="1" value="<?php echo $_SESSION['guests'] ?? '1'; ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Buscar</button>
            </form>
        </section>

        <!-- Habitaciones seleccionadas -->
        <section id="selectedRooms">
            <h3>Habitaciones Seleccionadas</h3>
            <?php if (!empty($_SESSION['selectedRooms'])) : ?>
                <table border="1">
                    <tr>
                        <th>ID de Habitación</th>
                        <th>Tipo de Habitación</th>
                        <th>Precio (USD)</th>
                        <th>Acciones</th>
                    </tr>
                    <?php foreach ($_SESSION['selectedRooms'] as $index => $room) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($room['room_id']); ?></td>
                            <td><?php echo htmlspecialchars($room['type']); ?></td>
                            <td><?php echo htmlspecialchars($room['price']); ?></td>
                            <td>
                                <form method="POST" action="">
                                    <input type="hidden" name="roomIndex" value="<?php echo $index; ?>">
                                    <button type="submit" name="deleteRoom" class="btn btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
                <!-- Botón Confirmar Reserva -->
                <form method="POST" action="clientres.php" style="margin-top: 20px;">
                    <button type="submit" class="btn btn-success">Confirmar Reserva</button>
                </form>
            <?php else : ?>
                <p>No hay habitaciones seleccionadas.</p>
            <?php endif; ?>
        </section>

        <!-- Listado de habitaciones disponibles por categoría -->
        <?php if (isset($roomsList) && !empty($roomsList)) : ?>
            <section id="selectedRooms">
                <h2>Habitaciones disponibles de la categoría seleccionada</h2>
                <table border="1">
                        <tr>
                            <th>ID de Habitación</th>
                            <th>Precio (USD)</th>
                            <th>Acciones</th>
                        </tr>
                    <tbody>
                        <?php foreach ($roomsList as $room) : ?>
                            <tr>
                                <td><?php echo htmlspecialchars($room['room_id']); ?></td>
                                <td><?php echo htmlspecialchars($room['room_price']); ?></td>
                                <td>
                                    <form method="POST" action="">
                                        <input type="hidden" name="room_id" value="<?php echo $room['room_id']; ?>">
                                        <input type="hidden" name="category_type" value="<?php echo htmlspecialchars($room['category_type']); ?>">
                                        <input type="hidden" name="room_price" value="<?php echo $room['room_price']; ?>">
                                        <button type="submit" name="reserveRoom" class="btn btn-primary">Seleccionar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </section>
        <?php endif; ?>

        <!-- Catálogo de habitaciones -->
        <section id="roomCatalog" class="room-catalog">
            <h2>Habitaciones Disponibles</h2>
            <div class="room-grid">
                <?php
                $showRooms = false;
                $sql = "SELECT c.category_id, c.category_type, c.category_descripcion, h.room_price, c.image
                        FROM Habitaciones h 
                        INNER JOIN Categoria c ON h.category_id = c.category_id
                        GROUP BY c.category_id";

                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['checkIn'], $_POST['checkOut'], $_POST['guests'])) {
                    $checkIn = $_POST['checkIn'];
                    $checkOut = $_POST['checkOut'];
                    if (strtotime($checkIn) < strtotime($checkOut)) {
                        $showRooms = true;
                    } else {
                        echo "<p style='color: red;'>La fecha de entrada debe ser anterior a la de salida.</p>";
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
                            $imagePath = $row['image'] ?: 'https://via.placeholder.com/300x200';
                            echo "<div class='room-card'>
                                    <div class='room-info'>
                                        <img src='{$imagePath}' alt='Imagen de la habitación'>
                                        <h3>{$row['category_type']}</h3>
                                        <p>{$row['category_descripcion']}</p>
                                        <p>Precio desde: {$row['room_price']} USD</p>
                                    </div>
                                    <form method='POST' action=''>
                                        <input type='hidden' name='category_id' value='{$row['category_id']}'>
                                        <button type='submit' name='viewRooms' class='btn btn-primary'>Ver Habitaciones</button>
                                    </form>
                                  </div>";
                        }
                    }
                }
                ?>
            </div>
        </section>
    </main>
</body>
</html>
