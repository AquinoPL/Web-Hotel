use hotelCielo;
DELIMITER $$
CREATE FUNCTION totalClientes(fecha_consulta DATE) RETURNS INT
DETERMINISTIC
BEGIN
    DECLARE total_clientes INT;

    SELECT SUM(number_of_guests) INTO total_clientes
    FROM Reservaciones r
    WHERE fecha_consulta BETWEEN r.date_init AND r.date_finish
    AND r.reservation_status = 'activa';

    RETURN total_clientes;
END$$
DELIMITER ;

-- PARA DEVOLVER UN VALOR HACEMOS UN SCRIPT IGUAL A ESTE:
-- SELECT totalClientes('YYYY-MM-DD') AS TotalDeClientes