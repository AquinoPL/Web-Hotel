USE hotelCielo;
DELIMITER $$
CREATE PROCEDURE InsertarEmpleado(
	IN e_dni VARCHAR(8),
    IN e_name VARCHAR(255),
    IN e_lastname VARCHAR(255),
    IN e_phonenumber VARCHAR(255),
    IN e_email VARCHAR(255),
    IN e_salary DECIMAL(10,2),
    IN e_job VARCHAR(255),
    IN e_workspace VARCHAR(255),
    IN hotel_name VARCHAR(30)
)
BEGIN
	DECLARE num INT;
    
    SELECT COUNT(employee_dni) INTO num FROM Empleados e
	WHERE e.employee_dni=e_dni;
    
    IF num < 1 then
		INSERT INTO Empleados (employee_dni, employee_name, employee_lastname, 
								employee_phonenumber, employee_email, employee_salary, employee_job, 
								employee_workspace, hotel_name)
		VALUES (e_dni, e_name, e_lastname, 
        e_phonenumber, e_email, e_salary, 
        e_job, e_workspace, hotel_name);
    END IF;
    
END$$
DELIMITER ;

-- CALL InsertarEmpleado();