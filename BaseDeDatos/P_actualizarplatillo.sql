USE hotelCielo;
DELIMITER $$

CREATE PROCEDURE ActualizarPlatillo(
    IN f_id INT,
    IN f_name VARCHAR(255),
    IN f_availability BOOLEAN,
    IN f_price DECIMAL(10, 2),
    IN f_description TEXT,
    IN f_type ENUM('desayuno', 'almuerzo', 'cena')
)
BEGIN
    DECLARE num INT;

    SELECT COUNT(food_id) INTO num 
    FROM Menu_Comedor 
    WHERE food_id = f_id;

    IF num > 0 THEN
        UPDATE Menu_Comedor
        SET food_name = f_name,
            food_availability = f_availability,
            food_price = f_price,
            food_description = f_description,
            food_type = f_type
        WHERE food_id = f_id;
    END IF;
END$$

DELIMITER ;