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
    <?php include('content/header.php'); ?>

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
                    <h3>Bar</h3>
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

    <?php include('content/footer.php'); ?>
    <script src="script.js"></script>
</body>
</html>