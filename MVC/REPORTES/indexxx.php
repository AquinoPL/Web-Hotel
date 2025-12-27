<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes del Hotel</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/bar.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/forms.css">
    <link rel="stylesheet" href="../css/rooms.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/selected.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href= "styles.css">
</head>
<body>
<header>
        <nav class="navbar">
            <div class="logo">Hotel Cielo</div>
            <div class="nav-links">
                <a href="../index.php">Inicio</a>
                <a href="../reservations.php">Reservaciones</a>
                <a href="../restaurant.php" class="active">Restaurante</a>
                <a href="../bar/bar.php">Bar</a>
                <a href="indexxx.php">Reportes</a>
                <a href="../login.php" class="login-btn">Iniciar Sesión</a>
            </div>
        </nav>
    </header>
    <div class="container">
        <h1><i class="fas fa-chart-line"></i> Reportes del Hotel</h1>
        
        <div class="tabs" id="reportTabs">
            <div class="tab active" data-tab="guests"><i class="fas fa-users"></i> Huéspedes</div>
            <div class="tab" data-tab="rooms"><i class="fas fa-bed"></i> Habitaciones</div>
            <div class="tab" data-tab="restaurant"><i class="fas fa-utensils"></i> Restaurante</div>
            <div class="tab" data-tab="products"><i class="fas fa-shopping-cart"></i> Productos</div>
            <div class="tab" data-tab="drinks"><i class="fas fa-glass-martini-alt"></i> Bebidas</div>
        </div>

        <div class="tab-content active" id="guestsTab">
            <h2><i class="fas fa-users"></i> Listado de Huéspedes</h2>
            <form id="guestsForm">
                <div class="form-group">
                    <label for="guests_fecha_inicio">Fecha de Inicio</label>
                    <input type="date" id="guests_fecha_inicio" name="fecha_inicio" required>
                </div>
                <div class="form-group">
                    <label for="guests_fecha_fin">Fecha de Fin</label>
                    <input type="date" id="guests_fecha_fin" name="fecha_fin" required>
                </div>
                <button type="submit">Consultar</button>
            </form>
        </div>

        <div class="tab-content" id="roomsTab">
            <h2><i class="fas fa-bed"></i> Ranking de Habitaciones</h2>
            <form id="roomsForm">
                <div class="form-group">
                    <label for="rooms_fecha_inicio">Fecha de Inicio</label>
                    <input type="date" id="rooms_fecha_inicio" name="fecha_inicio" required>
                </div>
                <div class="form-group">
                    <label for="rooms_fecha_fin">Fecha de Fin</label>
                    <input type="date" id="rooms_fecha_fin" name="fecha_fin" required>
                </div>
                <button type="submit">Consultar</button>
            </form>
        </div>

        <div class="tab-content" id="restaurantTab">
            <h2><i class="fas fa-utensils"></i> Ventas del Restaurante</h2>
            <form id="restaurantForm">
                <div class="form-group">
                    <label for="restaurant_fecha_inicio">Fecha de Inicio</label>
                    <input type="date" id="restaurant_fecha_inicio" name="fecha_inicio" required>
                </div>
                <div class="form-group">
                    <label for="restaurant_fecha_fin">Fecha de Fin</label>
                    <input type="date" id="restaurant_fecha_fin" name="fecha_fin" required>
                </div>
                <button type="submit">Consultar</button>
            </form>
        </div>

        <div class="tab-content" id="productsTab">
            <h2><i class="fas fa-shopping-cart"></i> Ranking de Productos del Restaurante</h2>
            <form id="productsForm">
                <div class="form-group">
                    <label for="products_mes">Mes</label>
                    <input type="number" id="products_mes" name="mes" min="1" max="12" required>
                </div>
                <div class="form-group">
                    <label for="products_anio">Año</label>
                    <input type="number" id="products_anio" name="anio" min="2000" max="2100" required>
                </div>
                <button type="submit">Consultar</button>
            </form>
        </div>

        <div class="tab-content" id="drinksTab">
            <h2><i class="fas fa-glass-martini-alt"></i> Ranking de Bebidas del Bar</h2>
            <form id="drinksForm">
                <div class="form-group">
                    <label for="drinks_mes">Mes</label>
                    <input type="number" id="drinks_mes" name="mes" min="1" max="12" required>
                </div>
                <div class="form-group">
                    <label for="drinks_anio">Año</label>
                    <input type="number" id="drinks_anio" name="anio" min="2000" max="2100" required>
                </div>
                <button type="submit">Consultar</button>
            </form>
        </div>

        <div id="reportResult"></div>
    </div>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('.tab');
            const tabContents = document.querySelectorAll('.tab-content');
            const forms = document.querySelectorAll('form');
            const reportResult = document.getElementById('reportResult');

            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    tabs.forEach(t => t.classList.remove('active'));
                    tabContents.forEach(tc => tc.classList.remove('active'));
                    this.classList.add('active');
                    document.getElementById(this.getAttribute('data-tab') + 'Tab').classList.add('active');
                });
            });

            forms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const formData = new FormData(this);
                    const reportType = this.id.replace('Form', '');
                    
                    let phpFile;
                    switch(reportType) {
                        case 'guests':
                            phpFile = 'reporte_huespedes.php';
                            break;
                        case 'rooms':
                            phpFile = 'reporte_habitaciones.php';
                            break;
                        case 'restaurant':
                            phpFile = 'reporte_ventas_restaurante.php';
                            break;
                        case 'products':
                            phpFile = 'ranking_productos_restaurante.php';
                            break;
                        case 'drinks':
                            phpFile = 'ranking_bebidas_bar.php';
                            break;
                    }

                    reportResult.innerHTML = '<div class="text-center"><div class="spinner-border" role="status"><span class="visually-hidden">Cargando...</span></div></div>';

                    fetch(phpFile, {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                        return response.text();
                    })
                    .then(data => {
                        console.log("Respuesta recibida:", data);
                        if (data.trim() === '') {
                            throw new Error('La respuesta está vacía');
                        }
                        reportResult.innerHTML = data;
                    })
                    .catch(error => {
                        console.error("Error completo:", error);
                        reportResult.innerHTML = `
                            <div class="alert alert-danger">
                                <i class="fas fa-exclamation-triangle"></i> Error al cargar el reporte: ${error.message}<br>
                                Por favor, verifica la conexión y el archivo PHP: ${phpFile}
                            </div>`;
                    });
                });
            });
        });
    </script>
</body>
</html>