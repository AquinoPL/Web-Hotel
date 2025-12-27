
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
    <link rel="stylesheet" href="css/hero2.css">
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
    <section class="hero">
            <h1>¡GRACIAS POR SU CONFIANZA!</h1>
            <p>Esperamos tenga una experiencia Inolvidable</p>
            <br>
            <p>RESERVA REALIZADA CORRECTAMENTE</p>
        </section>
    </main>
</body>
</html>
<?php
session_start();

$conn = new mysqli('srv1006.hstgr.io', 'u472469844_est31', '#Bd00031', 'u472469844_est31');

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recuperar los datos del formulario
$typedoc = $_POST['typedoc'] ?? '';
$doc = $_POST['doc'] ?? '';
$name = $_POST['name'] ?? '';
$lastname = $_POST['lastname'] ?? '';
$phonenumber = $_POST['phonenumber'] ?? '';
$email = $_POST['email'] ?? '';

// Validación básica
if (empty($typedoc) || empty($doc) || empty($name) || empty($lastname) || empty($email)) {
    die("Todos los campos son requeridos.");
}

// Escapar los datos para evitar inyecciones SQL
$typedoc = $conn->real_escape_string($typedoc);
$doc = $conn->real_escape_string($doc);
$name = $conn->real_escape_string($name);
$lastname = $conn->real_escape_string($lastname);
$phonenumber = $conn->real_escape_string($phonenumber);
$email = $conn->real_escape_string($email);

// Insertar en la tabla 'Usuarios'
$sql_usuario = "INSERT INTO Usuarios (user_typedoc, user_doc, user_name, user_lastname, user_phonenumber, user_email)
                VALUES ('$typedoc', '$doc', '$name', '$lastname', '$phonenumber', '$email')";
if ($conn->query($sql_usuario) === TRUE) {
    $user_id = $conn->insert_id;

    // Recuperar datos de la sesión
    $checkIn = $_SESSION['checkIn'] ?? '';
    $checkOut = $_SESSION['checkOut'] ?? '';
    $guests = $_SESSION['guests'] ?? 0;
    $selectedRooms = $_SESSION['selectedRooms'];

    // Validar que haya habitaciones seleccionadas
    if (!empty($selectedRooms) && is_array($selectedRooms)) {
        echo "<div class='container'>";
        echo "<div class='success'><h3>Reserva Completada Exitosamente</h3></div>";

        foreach ($selectedRooms as $room) {
            $room_id = $room['room_id'];

            // Insertar una reservación por cada habitación
            $sql_reservacion = "INSERT INTO Reservaciones (date_init, date_finish, user_id, room_id, reservation_statement, number_of_guests)
                                VALUES ('$checkIn', '$checkOut', $user_id, $room_id, 'Reservación realizada', $guests)";
            if ($conn->query($sql_reservacion) === TRUE) {
                echo "<p>Reservación creada para la habitación: $room_id</p>";

                // Actualizar el estado de la habitación a "No Disponible"
                $sql_update_room = "UPDATE Habitaciones SET room_availability = 'No Disponible' WHERE room_id = $room_id";

            } else {
                echo "<p class='error'>Error al crear reservación para la habitación ID: $room_id - " . $conn->error . "</p>";
            }
        }

        // Mostrar las tablas con los datos insertados
        // Tabla 'Usuarios'
        $sql_usuario_view = "SELECT * FROM Usuarios WHERE user_id = $user_id";
        $result_usuario = $conn->query($sql_usuario_view);
        if ($result_usuario->num_rows > 0) {
            echo "<h4>Usuario Nuevo</h4>";
            echo "<table><tr><th>ID</th><th>Tipo Doc</th><th>Documento</th><th>Nombre</th><th>Apellido</th><th>Teléfono</th><th>Correo</th></tr>";
            while ($row = $result_usuario->fetch_assoc()) {
                echo "<tr><td>{$row['user_id']}</td><td>{$row['user_typedoc']}</td><td>{$row['user_doc']}</td><td>{$row['user_name']}</td><td>{$row['user_lastname']}</td><td>{$row['user_phonenumber']}</td><td>{$row['user_email']}</td></tr>";
            }
            echo "</table>";
        }

        // Tabla 'Reservaciones'
        $sql_reservacion_view = "SELECT * FROM Reservaciones WHERE user_id = $user_id";
        $result_reservacion = $conn->query($sql_reservacion_view);
        if ($result_reservacion->num_rows > 0) {
            echo "<h4>Reservación Nueva</h4>";
            echo "<table><tr><th>ID</th><th>Fecha Entrada</th><th>Fecha Salida</th><th>Room ID</th><th>Estado</th><th>Huéspedes</th></tr>";
            while ($row = $result_reservacion->fetch_assoc()) {
                echo "<tr><td>{$row['reservation_id']}</td><td>{$row['date_init']}</td><td>{$row['date_finish']}</td><td>{$row['room_id']}</td><td>{$row['reservation_statement']}</td><td>{$row['number_of_guests']}</td></tr>";
            }
            echo "</table>";
        }
        echo "</div>";
    } else {
        echo "<p class='error'>No se seleccionaron habitaciones.</p>";
    }
} else {
    echo "<p class='error'>Error al registrar usuario: " . $conn->error . "</p>";
}

$conn->close();
?>
