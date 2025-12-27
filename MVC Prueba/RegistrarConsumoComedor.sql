USE u472469844_est31;

DELIMITER $$

CREATE PROCEDURE RegistrarConsumoComedor(
    IN p_reservation_id INT,
    IN p_food_id INT,
    IN p_quantity INT
)
BEGIN
    DECLARE current_availability BOOLEAN;
    DECLARE current_stock INT;

    -- Obtener la disponibilidad y la cantidad disponible del plato
    SELECT food_availability, food_price
    INTO current_availability, current_stock
    FROM Menu_Comedor
    WHERE food_id = p_food_id;

    -- Verificar si el plato está disponible
    IF current_availability = TRUE THEN
        -- Registrar el consumo en la tabla Consumos_Comedor
        INSERT INTO Consumos_Comedor (reservation_id, food_id, quantity, date_consumo)
        VALUES (p_reservation_id, p_food_id, p_quantity, NOW());
    ELSE
        -- Si el plato no está disponible, mostrar un mensaje de error
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'El plato seleccionado no está disponible';
    END IF;
END $$

DELIMITER ;
