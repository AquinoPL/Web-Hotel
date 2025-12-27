<?php
// Ensure this file is in the same directory as your styles.css file
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ranking de Productos del Restaurante</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $mes = $_POST['mes'];
            $anio = $_POST['anio'];

            if ($mes && $anio) {
                $conexion = new mysqli("srv1006.hstgr.io", "u472469844_est31", "#Bd00031", "u472469844_est31");

                if ($conexion->connect_error) {
                    die("<div class='alert alert-danger'><i class='fas fa-exclamation-triangle'></i> Error de conexión: " . $conexion->connect_error . "</div>");
                }

                $query = $conexion->prepare("CALL RankingProductosRestaurante(?, ?)");
                $query->bind_param("ii", $mes, $anio);
                $query->execute();
                $resultado = $query->get_result();

                echo "<h1><i class='fas fa-utensils'></i> Ranking de Productos del Restaurante</h1>";
                echo "<div class='report-result'>";
                echo "<table>";
                echo "<thead><tr><th>Producto</th><th>Cantidad Vendida</th></tr></thead>";
                echo "<tbody>";

                while ($fila = $resultado->fetch_assoc()) {
                    echo "<tr><td>{$fila['food_name']}</td><td>{$fila['TotalCantidad']}</td></tr>";
                }

                echo "</tbody></table>";
                echo "</div>";

                $query->close();
                $conexion->close();
            } else {
                echo "<div class='alert alert-danger'><i class='fas fa-exclamation-triangle'></i> Por favor ingresa mes y año.</div>";
            }
        } else {
        ?>
            <h1><i class="fas fa-utensils"></i> Ranking de Productos del Restaurante</h1>
            <form method="POST" action="" class="tab-content active">
                <div class="form-group">
                    <label for="mes">Mes:</label>
                    <input type="number" name="mes" id="mes" min="1" max="12" required>
                </div>
                <div class="form-group">
                    <label for="anio">Año:</label>
                    <input type="number" name="anio" id="anio" min="2000" max="2100" required>
                </div>
                <button type="submit">Generar Reporte</button>
            </form>
        <?php
        }
        ?>
    </div>
</body>
</html>