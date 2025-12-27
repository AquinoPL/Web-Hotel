use hotelCielo;
DELIMITER $$
CREATE FUNCTION totalVentas(fecha_consulta DATE) RETURNS DECIMAL(10, 2) 
DETERMINISTIC
BEGIN
    DECLARE total DECIMAL(10, 2);

    SELECT IFNULL(SUM(cc.quantity * mc.food_price), 0)
    INTO total
    FROM Consumos_Comedor cc
    JOIN Menu_Comedor mc ON cc.food_id = mc.food_id
    WHERE DATE(cc.date_consumo) = fecha_consulta;

    RETURN total;
END;$$
DELIMITER ;

-- PARA DEVOLVER UN VALOR HACEMOS UN SCRIPT IGUAL A ESTE:
-- SELECT totalVentas('YYYY-MM-DD') AS TotalDeVentas;