<?php
// Ensure this file is in the same directory as your styles.css file
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Ventas del Restaurante</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $fecha_inicio = $_POST['fecha_inicio'];
            $fecha_fin = $_POST['fecha_fin'];

            if ($fecha_inicio && $fecha_fin) {
                $conexion = new mysqli("srv1006.hstgr.io", "u472469844_est31", "#Bd00031", "u472469844_est31");

                if ($conexion->connect_error) {
                    die("<div class='alert alert-danger'><i class='fas fa-exclamation-triangle'></i> Error de conexión: " . $conexion->connect_error . "</div>");
                }

                $query = $conexion->prepare("CALL MontoVentasRestaurante(?, ?)");
                $query->bind_param("ss", $fecha_inicio, $fecha_fin);
                $query->execute();
                $resultado = $query->get_result();

                echo "<h1><i class='fas fa-utensils'></i> Reporte de Ventas del Restaurante</h1>";
                echo "<div class='report-result'>";

                if ($fila = $resultado->fetch_assoc()) {
                    echo "<div class='summary-card'>
                            <p>Total de ventas en el restaurante</p>
                            <p class='date-range'>Desde <span>{$fecha_inicio}</span> hasta <span>{$fecha_fin}</span></p>
                            <p class='total-sales'>S/ {$fila['TotalVentas']}</p>
                          </div>";
                } else {
                    echo "<div class='alert alert-info'><i class='fas fa-info-circle'></i> No se encontraron ventas en el rango de fechas proporcionado.</div>";
                }

                echo "</div>";

                $query->close();
                $conexion->close();
            } else {
                echo "<div class='alert alert-danger'><i class='fas fa-exclamation-triangle'></i> Por favor ingresa ambas fechas.</div>";
            }
        } else {
        ?>
            <h1><i class="fas fa-utensils"></i> Reporte de Ventas del Restaurante</h1>
            <form method="POST" action="" class="tab-content active">
                <div class="form-group">
                    <label for="fecha_inicio">Fecha de Inicio:</label>
                    <input type="date" name="fecha_inicio" id="fecha_inicio" required>
                </div>
                <div class="form-group">
                    <label for="fecha_fin">Fecha de Fin:</label>
                    <input type="date" name="fecha_fin" id="fecha_fin" required>
                </div>
                <button type="submit">Generar Reporte</button>
            </form>
        <?php
        }
        ?>
    </div>
</body>
</html>