USE u472469844_est31;

DELIMITER $$

CREATE PROCEDURE BuscarMenuPorNombre (
    IN p_food_name VARCHAR(255)
)
BEGIN
    DECLARE v_food_id INT;

    -- Buscar el food_id en la tabla Menu_Comedor por el nombre del plato
    SELECT food_id INTO v_food_id
    FROM Menu_Comedor
    WHERE food_name = p_food_name
    LIMIT 1;

    -- Devolver el food_id encontrado o NULL si no se encuentra
    IF v_food_id IS NOT NULL THEN
        SELECT v_food_id AS food_id;
    ELSE
        SELECT NULL AS food_id;  -- Si no se encuentra el plato
    END IF;
END $$

DELIMITER ;
