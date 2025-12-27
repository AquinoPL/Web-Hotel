USE u472469844_est31;

DELIMITER $$

CREATE PROCEDURE BuscarReservacionPorDocumento (
    IN p_documento VARCHAR(10)
)
BEGIN
    DECLARE v_user_id INT;
    DECLARE v_reservation_id INT;

    -- Buscar el user_id en la tabla Usuarios
    SELECT user_id INTO v_user_id
    FROM Usuarios
    WHERE user_doc = p_documento
    LIMIT 1;

    -- Si no se encuentra en Usuarios, buscar en Huespedes
    IF v_user_id IS NULL THEN
        SELECT user_id INTO v_user_id
        FROM Huespedes
        WHERE huesped_doc = p_documento
        LIMIT 1;
    END IF;

    -- Si encontramos un user_id, buscamos la reserva en Reservaciones
    IF v_user_id IS NOT NULL THEN
        SELECT reservation_id INTO v_reservation_id
        FROM Reservaciones
        WHERE user_id = v_user_id
        LIMIT 1;

        -- Devolvemos el reservation_id encontrado
        SELECT v_reservation_id AS reservation_id;
    ELSE
        SELECT NULL AS reservation_id;  -- Si no se encontró el documento
    END IF;
END $$

DELIMITER ;