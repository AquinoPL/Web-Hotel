USE hotelCielo;
DELIMITER $$

CREATE PROCEDURE InsertarPlatillo(
    IN f_name VARCHAR(255),
    IN f_availability BOOLEAN,
    IN f_price DECIMAL(10, 2),
    IN f_description TEXT,
    IN f_type ENUM('desayuno', 'almuerzo', 'cena')
)
BEGIN
    DECLARE num INT;

    SELECT COUNT(food_name) INTO num 
    FROM Menu_Comedor 
    WHERE food_name = f_name;

    IF num < 1 THEN
        INSERT INTO Menu_Comedor (food_name, food_availability, food_price, food_description, food_type)
        VALUES (f_name, f_availability, f_price, f_description, f_type);
    END IF;
END$$

DELIMITER ;