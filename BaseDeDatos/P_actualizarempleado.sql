USE hotelCielo;
DELIMITER $$
CREATE PROCEDURE ActualizarEmpleado(
    IN e_dni VARCHAR(8),
    IN e_name VARCHAR(255),
    IN e_lastname VARCHAR(255),
    IN e_phonenumber VARCHAR(255),
    IN e_email VARCHAR(255),
    IN e_salary DECIMAL(10,2),
    IN e_job VARCHAR(255),
    IN e_workspace VARCHAR(255),
    IN h_name VARCHAR(30)
)
BEGIN
    DECLARE num INT;
	DECLARE cen INT;
    
    
    SELECT COUNT(employee_id) INTO num 
    FROM Empleados 
    WHERE employee_dni = e_dni;
    
    SELECT employee_id INTO cen 
    FROM Empleados
    WHERE employee_dni = e_dni;

    IF num > 0 THEN
        UPDATE Empleados
        SET employee_name = e_name,
            employee_lastname = e_lastname,
            employee_phonenumber = e_phonenumber,
            employee_email = e_email,
            employee_salary = e_salary,
            employee_job = e_job,
            employee_workspace = e_workspace,
            hotel_name = h_name
        WHERE employee_id = cen;
    END IF;
END$$

DELIMITER ;