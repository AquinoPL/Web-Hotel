USE u472469844_est31;

DELIMITER $$

CREATE PROCEDURE BuscarProductoPorNombre (
    IN p_product_name VARCHAR(255)
)
BEGIN
    DECLARE v_product_id INT;

    -- Buscar el product_id en la tabla Productos por el nombre del producto
    SELECT product_id INTO v_product_id
    FROM Productos
    WHERE product_name = p_product_name
    LIMIT 1;

    -- Devolver el product_id encontrado o NULL si no se encuentra
    IF v_product_id IS NOT NULL THEN
        SELECT v_product_id AS product_id;
    ELSE
        SELECT NULL AS product_id;  -- Si no se encuentra el producto
    END IF;
END $$

DELIMITER ;
