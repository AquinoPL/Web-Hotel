USE hotelCielo;
DELIMITER $$

CREATE PROCEDURE RecuperarPlatillo(IN f_id INT)
BEGIN
    SELECT * 
    FROM Menu_Comedor
    WHERE food_id = f_id;
END$$

DELIMITER ;