USE u472469844_est31;

DELIMITER $$

CREATE PROCEDURE RegistrarConsumoBar(
    IN p_reservation_id INT,
    IN p_product_id INT,
    IN p_quantity INT
)
BEGIN
    DECLARE current_stock INT;

    -- Obtener la cantidad disponible del producto
    SELECT product_quantity
    INTO current_stock
    FROM Productos
    WHERE product_id = p_product_id;

    -- Verificar si hay suficiente stock
    IF current_stock >= p_quantity THEN
        -- Registrar el consumo en la tabla Consumos_Bar
        INSERT INTO Consumos_Bar (reservation_id, product_id, quantity, date_consumo)
        VALUES (p_reservation_id, p_product_id, p_quantity, NOW());

        -- Actualizar la cantidad de producto disponible
        UPDATE Productos
        SET product_quantity = product_quantity - p_quantity
        WHERE product_id = p_product_id;
    ELSE
        -- Si no hay suficiente stock, mostrar un mensaje de error
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'No hay suficiente stock para este producto';
    END IF;
END$$

DELIMITER ;
