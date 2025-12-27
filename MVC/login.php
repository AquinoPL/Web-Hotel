<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Hotel Cielo</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
                <a href="events.php">Eventos</a>
                <a href="login.php" class="login-btn active">Iniciar Sesión</a>
            </div>
        </nav>
    </header>

    <main>
        <section class="login-section">
            <div class="login-container">
                <h2>Iniciar Sesión</h2>
                <form id="loginForm" class="login-form">
                    <div class="form-group">
                        <label for="username">Usuario:</label>
                        <input type="text" id="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña:</label>
                        <input type="password" id="password" required>
                    </div>
                    <button type="submit" class="submit-btn">Ingresar</button>
                </form>
            </div>
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
        <div class="footer-bottom">
            <p>&copy; 2024 Hotel Cielo. Todos los derechos reservados.</p>
        </div>
    </footer>
    <script src="script.js"></script>
</body>
</html>