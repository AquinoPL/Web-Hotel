USE hotelCielo;
DELIMITER $$
CREATE PROCEDURE RegistrarCompraBar(
    IN product_id INT,
    IN quantity INT,
    IN date_consumo DATETIME
)
BEGIN
	DECLARE reserva_id INT;
    
    SELECT reservation_id INTO reserva_id FROM Reservaciones
	ORDER BY reservation_id DESC
	LIMIT 1;
    
    INSERT INTO Consumos_Bar (reservation_id, product_id, quantity, date_consumo)
	VALUES (reserva_id, product_id, quantity, date_consumo);
END$$
DELIMITER ;

-- CALL RegistrarCompraBar( 3, 1, '2024-07-28');