<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventos - Hotel Cielo</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- PHP: Incluir header común
    <?php include 'includes/header.php'; ?> -->
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="logo">Hotel Cielo</div>
            <div class="nav-links">
                <a href="index.php">Inicio</a>
                <a href="reservations.php">Reservaciones</a>
                <a href="restaurant.php">Restaurante</a>
                <a href="bar.php">Bar</a>
                <a href="events.php" class="active">Eventos</a>
                <a href="login.php" class="login-btn">Iniciar Sesión</a>
            </div>
        </nav>
    </header>

    <main class="events-page">
        <section class="events-section">
            <h2>Salones para Eventos</h2>
            <!-- PHP: Verificar disponibilidad de salones
            <?php
            $query = "SELECT * FROM Salones WHERE availability = true";
            $result = mysqli_query($conn, $query);
            while($row = mysqli_fetch_assoc($result)) {
                // Mostrar salones disponibles
            }
            ?> -->
            <div class="events-grid">
                <div class="event-venue">
                    <img src="https://via.placeholder.com/300" alt="Salón Principal">
                    <div class="venue-info">
                        <h3>Salón Principal</h3>
                        <p>Capacidad: 200 personas</p>
                        <p>Ideal para bodas y eventos corporativos</p>
                        <ul class="venue-features">
                            <li><i class="fas fa-wifi"></i> WiFi de alta velocidad</li>
                            <li><i class="fas fa-music"></i> Sistema de sonido</li>
                            <li><i class="fas fa-tv"></i> Proyector y pantalla</li>
                            <li><i class="fas fa-snowflake"></i> Aire acondicionado</li>
                        </ul>
                        <button class="reserve-btn">Reservar Salón</button>
                    </div>
                </div>

                <div class="event-venue">
                    <img src="https://via.placeholder.com/300" alt="Salón Ejecutivo">
                    <div class="venue-info">
                        <h3>Salón Ejecutivo</h3>
                        <p>Capacidad: 50 personas</p>
                        <p>Perfecto para reuniones empresariales</p>
                        <ul class="venue-features">
                            <li><i class="fas fa-wifi"></i> WiFi de alta velocidad</li>
                            <li><i class="fas fa-coffee"></i> Servicio de café</li>
                            <li><i class="fas fa-tv"></i> Equipos audiovisuales</li>
                            <li><i class="fas fa-snowflake"></i> Aire acondicionado</li>
                        </ul>
                        <button class="reserve-btn">Reservar Salón</button>
                    </div>
                </div>
            </div>
        </section>

        <!-- PHP: Formulario de reserva de eventos
        <?php if(isset($_SESSION['user_id'])) { ?>
            Mostrar formulario de reserva
        <?php } else { ?>
            Mensaje para iniciar sesión
        <?php } ?> -->
    </main>

    <footer>
        <!-- PHP: Incluir footer común
        <?php include 'includes/footer.php'; ?> -->
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
        <div class="footer-bottom">
            <p>&copy; 2024 Hotel Cielo. Todos los derechos reservados.</p>
        </div>
    </footer>
    <script src="script.js"></script>
</body>
</html>