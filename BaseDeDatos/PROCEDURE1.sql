use hotelCielo;

DELIMITER //
CREATE PROCEDURE ReservarHabitacion(
    IN p_user_typedoc VARCHAR(30),
    IN p_user_doc VARCHAR(10),
    IN p_user_name VARCHAR(255),
    IN p_user_lastname VARCHAR(255),
    IN p_user_phonenumber VARCHAR(255),
    IN p_user_email VARCHAR(255),
    IN p_fecha_inicio DATE,
    IN p_fecha_fin DATE,
    IN p_num_huespedes INT,
    IN p_num_camas INT,
    IN p_desayuno_inicio DATE,
    IN p_desayuno_fin DATE,
    IN p_huespedes JSON
)
BEGIN
    DECLARE v_user_id INT;
    DECLARE v_room_id INT;
    DECLARE v_reservation_id INT;
    DECLARE v_food_id INT;
    DECLARE i INT DEFAULT 0;
    
    START TRANSACTION;
    
    SET v_user_id = ObtenerOCrearUsuario(p_user_typedoc, p_user_doc, p_user_name, p_user_lastname, p_user_phonenumber, p_user_email);
    
    SET v_room_id = ObtenerHabitacionDisponible(p_num_huespedes, p_num_camas, p_fecha_inicio, p_fecha_fin);
    
    IF v_room_id IS NULL THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'No hay habitaciones con lo especificado';
    END IF;
    
    INSERT INTO Reservaciones (date_init, date_finish, room_id, user_id, reservation_statement, reservation_lunch, number_of_guests, reservation_status)
    VALUES (p_fecha_inicio, p_fecha_fin, v_room_id, v_user_id, 'Reserva con desayuno', FALSE, p_num_huespedes, 'activa');
    
    SET v_reservation_id = LAST_INSERT_ID();
    
    WHILE i < JSON_LENGTH(p_huespedes) DO
        INSERT INTO Huespedes (huesped_typedoc, huesped_doc, huesped_name, huesped_lastname, user_id)
        VALUES (
            JSON_UNQUOTE(JSON_EXTRACT(p_huespedes, CONCAT('$[', i, '].typedoc'))),
            JSON_UNQUOTE(JSON_EXTRACT(p_huespedes, CONCAT('$[', i, '].doc'))),
            JSON_UNQUOTE(JSON_EXTRACT(p_huespedes, CONCAT('$[', i, '].name'))),
            JSON_UNQUOTE(JSON_EXTRACT(p_huespedes, CONCAT('$[', i, '].lastname'))),
            v_user_id
        );
        SET i = i + 1;
    END WHILE;
    
    SELECT food_id INTO v_food_id FROM Menu_Comedor
    WHERE food_type = 'desayuno'
    LIMIT 1;
    
    WHILE p_desayuno_inicio <= p_desayuno_fin DO
        INSERT INTO Consumos_Comedor (reservation_id, food_id, quantity, date_consumo)
        VALUES (v_reservation_id, v_food_id, p_num_huespedes, p_desayuno_inicio);
        
        SET p_desayuno_inicio = DATE_ADD(p_desayuno_inicio, INTERVAL 1 DAY);
    END WHILE;
    
    COMMIT;
    
    SELECT 'Reserva realizada' AS mensaje, v_reservation_id AS id_reserva;
END //
DELIMITER ;

-- FUNCIONES DE APOYO
DELIMITER //
CREATE FUNCTION ObtenerOCrearUsuario(
    p_user_typedoc VARCHAR(30),
    p_user_doc VARCHAR(10),
    p_user_name VARCHAR(255),
    p_user_lastname VARCHAR(255),
    p_user_phonenumber VARCHAR(255),
    p_user_email VARCHAR(255)
) RETURNS INT
DETERMINISTIC
BEGIN
    DECLARE v_user_id INT;
    SELECT user_id INTO v_user_id FROM Usuarios
    WHERE user_typedoc = p_user_typedoc AND user_doc = p_user_doc
    LIMIT 1;
    
    IF v_user_id IS NULL THEN
        INSERT INTO Usuarios (user_typedoc, user_doc, user_name, user_lastname, user_phonenumber, user_email)
        VALUES (p_user_typedoc, p_user_doc, p_user_name, p_user_lastname, p_user_phonenumber, p_user_email);
        SET v_user_id = LAST_INSERT_ID();
    ELSE
        UPDATE Usuarios
        SET user_name = p_user_name,
            user_lastname = p_user_lastname,
            user_phonenumber = p_user_phonenumber,
            user_email = p_user_email
        WHERE user_id = v_user_id;
    END IF;
    
    RETURN v_user_id;
END //

CREATE FUNCTION ObtenerHabitacionDisponible(
    p_num_huespedes INT,
    p_num_camas INT,
    p_fecha_inicio DATE,
    p_fecha_fin DATE
) RETURNS INT
DETERMINISTIC
BEGIN
    DECLARE v_room_id INT;
    
    SELECT h.room_id INTO v_room_id FROM Habitaciones h
    JOIN Categoria c ON h.category_id = c.category_id
    WHERE c.category_beds >= p_num_camas AND h.room_capacity >= p_num_huespedes AND h.room_id NOT IN (SELECT room_id FROM Reservaciones WHERE (date_init <= p_fecha_fin AND date_finish >= p_fecha_inicio))
    LIMIT 1;
    RETURN v_room_id;
END //
DELIMITER ;

-- EJEMPLO PLANTEADO RESERVA 
CALL ReservarHabitacion(
    'DNI', '1485345678', 'Gon', 'Pérez', '+51962254957', 'panperez@gmail.com',
    '2024-07-26', '2024-07-30', 3, 2, '2024-07-27', '2024-07-29',
    '[
        {"typedoc": "DNI", "doc": "00516196", "name": "Pancho", "lastname": "Pérez"},
        {"typedoc": "DNI", "doc": "29590128", "name": "María", "lastname": "Gonzales"},
        {"typedoc": "DNI", "doc": "84920657", "name": "Panchito", "lastname": "Pérez"}
    ]'
);


SELECT *
FROM reservaciones
WHERE reservation_id = LAST_INSERT_ID();
