USE hotelCielo;
DELIMITER $$

CREATE PROCEDURE RecuperarEmpleado(IN e_dni INT)
BEGIN
    SELECT * 
    FROM Empleados
    WHERE employee_dni = e_dni;
END$$

DELIMITER ;

