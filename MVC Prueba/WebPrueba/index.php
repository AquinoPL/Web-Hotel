<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Cielo</title>
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/hero.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="logo">Hotel Cielo</div>
            <div class="nav-links">
                <a href="index.php" class="active">Inicio</a>
                <a href="reservations.php">Reservaciones</a>
                <a href="restaurant/restaurant.php">Restaurante</a>
                <a href="bar/bar.php">Bar</a>
                <a href="events.php">Eventos</a>
                <a href="login.php" class="login-btn">Iniciar Sesión</a>
            </div>
        </nav>
    </header>

    <main>
        <section class="hero">
            <h1>Bienvenidos a Hotel Cielo</h1>
            <p>Su destino perfecto para una experiencia inolvidable</p>
            <a href="reservations.php" class="cta-button">
                <span>Reservar Ahora</span>
                <i class="fas fa-arrow-right"></i>
            </a>
        </section>

        <section class="services">
            <h2>Nuestros Servicios</h2>
            <div class="services-grid">
                <div class="service-card">
                    <i class="fas fa-bed"></i>
                    <h3>Habitaciones</h3>
                    <p>Habitaciones lujosas y confortables</p>
                </div>
                <div class="service-card">
                    <i class="fas fa-utensils"></i>
                    <h3>Restaurante</h3>
                    <p>Gastronomía de primera clase</p>
                </div>
                <div class="service-card">
                    <i class="fas fa-glass-martini-alt"></i>
                    <h3><a href="bar/bar.php">Bar</a></h3>
                    <p>Bebidas y cócteles exclusivos</p>
                </div>
                <div class="service-card">
                    <i class="fas fa-calendar-alt"></i>
                    <h3>Eventos</h3>
                    <p>Salones para todo tipo de eventos</p>
                </div>
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
</body>
</html>