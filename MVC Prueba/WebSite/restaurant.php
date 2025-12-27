<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurante - Hotel Cielo</title>
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
                <a href="restaurant.php" class="active">Restaurante</a>
                <a href="bar.php">Bar</a>
                <a href="events.php">Eventos</a>
                <a href="login.php" class="login-btn">Iniciar Sesión</a>
            </div>
        </nav>
    </header>

    <main class="menu-page">
        <section class="menu-section">
            <h2>Menú del Restaurante</h2>
            <!-- PHP: Iterar sobre las categorías del menú
            <?php
            $query = "SELECT * FROM Menu_Comedor ORDER BY food_type";
            $result = mysqli_query($conn, $query);
            while($row = mysqli_fetch_assoc($result)) {
                // Mostrar cada elemento del menú
            }
            ?> -->
            <div class="menu-grid">
                <div class="menu-category">
                    <h3>Desayunos</h3>
                    <div class="menu-items">
                        <div class="menu-item">
                            <img src="https://via.placeholder.com/150" alt="Desayuno Continental">
                            <h4>Desayuno Continental</h4>
                            <p>Pan fresco, mantequilla, mermelada, café y jugo</p>
                            <span class="price">$15.00</span>
                            <button class="add-to-cart">Agregar al Carrito</button>
                        </div>
                        <!-- Más items aquí -->
                    </div>
                </div>

                <div class="menu-category">
                    <h3>Almuerzos</h3>
                    <div class="menu-items">
                        <div class="menu-item">
                            <img src="https://via.placeholder.com/150" alt="Menú Ejecutivo">
                            <h4>Menú Ejecutivo</h4>
                            <p>Entrada, plato principal, postre y bebida</p>
                            <span class="price">$25.00</span>
                            <button class="add-to-cart">Agregar al Carrito</button>
                        </div>
                        <!-- Más items aquí -->
                    </div>
                </div>

                <div class="menu-category">
                    <h3>Cenas</h3>
                    <div class="menu-items">
                        <div class="menu-item">
                            <img src="https://via.placeholder.com/150" alt="Cena Gourmet">
                            <h4>Cena Gourmet</h4>
                            <p>Especialidad del chef con maridaje de vinos</p>
                            <span class="price">$35.00</span>
                            <button class="add-to-cart">Agregar al Carrito</button>
                        </div>
                        <!-- Más items aquí -->
                    </div>
                </div>
            </div>
        </section>

        <!-- PHP: Sección del carrito
        <?php if(isset($_SESSION['user_id'])) { ?>
            Mostrar carrito y total
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