INSERT INTO Hotel (hotel_name, hotel_location, hotel_description, hotel_rooms, hotel_floors) VALUES
('Hotel Cielo', 'Avenida Miraflores S/N, Tacna, Peru', 'Un hermoso hotel 3-estrellas con increibles vistas de la ciudad', 150, 10);

INSERT INTO Empleados (employee_dni, employee_name, employee_lastname, employee_phonenumber, employee_email, employee_salary, employee_job, employee_workspace, hotel_name) VALUES
('77128190','Carlos','Gonzales','912324123','carlos.gonzales@hotelcielo.com',2000.00,'Recepcionista','Recepción','Hotel Cielo'),
('45271648','Andrea','Salas','988766544','andrea.salas@hotelcielo.com',1500.00,'Limpieza','Hotel','Hotel Cielo'),
('91474362','Luis','Mendoza','912412411','luis.mendoza@hotelcielo.com',2000.00,'Recepcionista','Recepcion','Hotel Cielo'),
('06379546','Sophia','Johnson','912341322','sophia.johnson@hotelcielo.com',3000.00,'Gerente General','Zona Administrativa','Hotel Cielo');


INSERT INTO Categoria (category_type, category_beds, category_descripcion, category_maxcapacity) VALUES
('Simple', 1, 'Amplia Habitación Personal con Todas las Comodidades', '1 Persona'),
('Doble', 2, 'Habitación con Todas las Comodidades con Camas Simples', '2 Personas'),
('Triple', 3, 'Amplia Habitación con Todas las Comodidades para un Grupo Pequeño', '3 Personas'),
('Matrimonial', 1, 'Habitación para Parejas con todas las Comodidades', '2 Personas'),
('Familiar', 2, 'Amplia Habitación para uso Familiar', '4 Personas'),
('Suite', 3, 'Cómoda Habitación con 2 Cuartos y 1 Salon + Cocina', '6 Personas'),
('Suite Deluxe', 5, 'Amplia Habitación ideal para Grupos Grandes con 3 Cuartos, Salon, Cocina y Balcón', '6 Personas');

INSERT INTO Habitaciones (room_floor, room_capacity, room_price, room_availability, category_id) VALUES
(1,1,300.00,'No Disponible',1), (2,1,300.00,'No Disponible',1), (3,1,300.00,'No Disponible',1),
(1,1,300.00,'No Disponible',1), (2,1,300.00,'No Disponible',1), (3,1,300.00,'No Disponible',1),
(1,1,300.00,'No Disponible',1), (2,2,400.00,'No Disponible',2), (3,2,400.00,'No Disponible',2),
(1,2,400.00,'No Disponible',2), (2,2,400.00,'No Disponible',4), (3,2,400.00,'No Disponible',4),
(1,2,400.00,'No Disponible',2), (2,2,400.00,'No Disponible',4), (3,3,500.00,'No Disponible',3),
(1,3,500.00,'No Disponible',3), (2,3,500.00,'No Disponible',3), (3,3,500.00,'No Disponible',3),
(1,3,500.00,'No Disponible',3), (2,3,500.00,'No Disponible',3), (3,3,500.00,'Disponible',3),
(1,4,600.00,'Disponible',5), (2,4,600.00,'Disponible',5), (3,4,600.00,'Disponible',5),
(1,4,600.00,'Disponible',5), (2,4,600.00,'Disponible',5), (3,4,600.00,'Disponible',5),
(1,6,800.00,'Disponible',6), (2,6,800.00,'Disponible',1), (3,6,800.00,'Disponible',7);
 
 INSERT INTO Productos (product_price, product_quantity, product_name, product_description) VALUES
 (30.00, 50, 'Cerveza Corona', 'Cerveza Helada de 240ml'),
 (15.00, 30, 'Pisco Sour', 'Coctel preparado con pisco, limon, huevo y angostura'),
 (4.00, 75, 'Coca Cola', 'Bebida gaseosa personal'),
 (3.00, 90, 'Agua Mineral', 'Botella personal de agua mineral'),
 (8.00, 35, 'Café Americano', 'Cafe caliente tradicional'),
 (10.00, 20, 'Jugo de Naranja', 'Jugo natural sabor a naranja'),
 (3.50, 60, 'Chips', 'Papas fritas cortadas en rodajas');
 
 INSERT INTO Menu_Comedor (food_name, food_availability, food_price, food_description, food_type) VALUES
 ('Desayuno Americano 01', TRUE, 25, 'Desayuno que incluye Café o Mate, Jugo de Naranja o Piña, Pan y Huevos Revueltos','desayuno'),
 ('Menu Ejecutivo 01', TRUE, 60, 'Entrada: Ceviche. Plato Principal: Chicharron de Pescado. Bebida: Limonada Frozen', 'almuerzo'),
 ('Menu Infantil 01', TRUE, 40, 'Plato Principal: Pollo Frito. Bebida: Gaseosa o Limonada. Postre: Helado','almuerzo'),
 ('Almuerzo Tradicional 01', TRUE, 80, 'Entrada: Ensalada de Palta. Plato Principal: Lomo Saltado. Postre: Pastel de Chocolate','almuerzo');
 
 INSERT INTO Promociones (promotion_type, promotion_description, promotion_availability, promotion_price) VALUES
 ('Descuento', 'Descuento del 20% para estadías de más de 5 noches', TRUE, 20),
 ('Oferta Semanal','Reserva de Hotel con un 10% de descuento con desayuno incluido', TRUE, 10),
 ('Oferta Navideña', 'Descuento del 40% Para estadías de más de una Semana, incluye desayuno y almuerzos', TRUE, 15);
 
INSERT INTO Usuarios (user_typedoc, user_doc, user_name, user_lastname, user_phonenumber, user_email) VALUES
('DNI', '12345678', 'Carlos', 'Rodriguez', '+51955555555', 'carlos.rodriguez@gmail.com'),
('Pasaporte', 'AB123456', 'Emma', 'Smith', '+1234567890', 'emma.smith@gmail.com'),
('DNI', '87654321', 'Ana', 'Gómez', '+51944444444', 'ana.gomez@gmail.com'),
('DNI', '23456789', 'Luis', 'Torres', '+51933333333', 'luis.torres@gmail.com'),
('Pasaporte', 'CD789012', 'John', 'Doe', '+1987654321', 'john.doe@gmail.com'),
('DNI', '34567890', 'Maria', 'López', '+51922222222', 'maria.lopez@gmail.com'),
('Pasaporte', 'EF345678', 'Sophie', 'Martin', '+33123456789', 'sophie.martin@gmail.com'),
('DNI', '45678901', 'Pedro', 'Díaz', '+51911111111', 'pedro.diaz@gmail.com'),
('DNI', '56789012', 'Carmen', 'Vargas', '+51900000000', 'carmen.vargas@gmail.com'),
('Pasaporte', 'GH901234', 'Hans', 'Müller', '+49987654321', 'hans.muller@gmail.com'),
('Pasaporte','AS102938', 'Alberto', 'Mendoza','+51123123321','albert.mendoza@gmail.com'),
('DNI', '67890123', 'Lucia', 'Ramos', '+51988888888', 'lucia.ramos@gmail.com'),
('Pasaporte', 'IJ567890', 'Thomas', 'Brown', '+447890123456', 'thomas.brown@gmail.com'),
('DNI', '78901234', 'Javier', 'Ortiz', '+51977777777', 'javier.ortiz@gmail.com'),
('Pasaporte', 'KL789012', 'Elena', 'Garcia', '+34678901234', 'elena.garcia@gmail.com'),
('DNI', '89012345', 'Andres', 'Morales', '+51966666666', 'andres.morales@gmail.com'),
('Pasaporte', 'MN890123', 'Sarah', 'Taylor', '+61412345678', 'sarah.taylor@gmail.com'),
('DNI', '90123456', 'Diego', 'Perez', '+51955555554', 'diego.perez@gmail.com'),
('DNI', '01234567', 'Marta', 'Hernandez', '+51944444443', 'marta.hernandez@gmail.com'),
('Pasaporte', 'OP123456', 'Tania', 'Lopez', '+525512345678', 'david.lopez@gmail.com');

INSERT INTO Huespedes (huesped_typedoc, huesped_doc, huesped_name, huesped_lastname, user_id) VALUES
('DNI', '12345679', 'Laura', 'Rodriguez', 1), ('DNI', '87654325', 'Mia', 'Gómez', 3),
('DNI', '87654321', 'Pablo', 'Gómez', 3), ('DNI', '87654322', 'Pablo', 'Gómez', 3),
('DNI', '87654323', 'Sofia', 'Gómez', 3), ('DNI', '87654324', 'Lucas', 'Gómez', 3),
('DNI', '87654325', 'Mia', 'Gómez', 3), ('Pasaporte', 'CD789013', 'Jane', 'Doe', 5),
('DNI', '34567891', 'Jorge', 'López', 6), ('DNI', '45678902', 'Carmen', 'Díaz', 8),
('DNI', '56789013', 'Roberto', 'Vargas', 9), ('Pasaporte', 'GH901234', 'Jose', 'Müller', 10),
('Pasaporte', 'GH901235', 'Greta', 'Müller', 10), ('Pasaporte', 'GH901236', 'Klaus', 'Müller', 10),
('Pasaporte', 'GH901237', 'Heidi', 'Müller', 10), ('DNI', '43215678', 'Alejandro', 'Ramos', 12), 
('DNI', '43212345', 'Carlos', 'Ramos', 12), ('DNI', '43219876', 'Santiago', 'Ramos', 12), 
('Pasaporte', 'JK123456', 'Jane', 'Brown', 13), ('Pasaporte', 'JK654321', 'Michael', 'Brown', 13), 
('Pasaporte', 'JK789012', 'Sophia', 'Brown', 13), ('Pasaporte', 'JK210987', 'William', 'Brown', 13), 
('Pasaporte', 'JK345678', 'Emily', 'Brown', 13), ('DNI', '56789012', 'Carlos', 'Ortiz', 14),
('DNI', '67890123', 'Paula', 'Garcia', 15), ('DNI', '78901234', 'Miguel', 'Garcia', 15), 
('DNI', '89012345', 'Diego', 'Morales', 16), ('DNI', '90123456', 'Sofia', 'Vargas', 16), 
('DNI', '01234567', 'Manuel', 'Vargas', 17), ('Pasaporte', 'GH901234', 'Pedro', 'Aquino', 20);

INSERT INTO Reservaciones (date_init, date_finish, room_id, user_id, reservation_statement, reservation_lunch, number_of_guests, reservation_status) VALUES
('2024-10-15', '2024-10-17', 1, 1, 'Vacaciones familiares', TRUE, 2, 'completada'),
('2024-11-01', '2024-11-04', 2, 2, 'Viaje de negocios', FALSE, 1, 'completada'),
('2024-12-01', '2024-12-06', 3, 3, 'Vacaciones en familia', TRUE, 5, 'activa'),
('2024-11-10', '2024-11-12', 4, 4, 'Fin de semana de relax', FALSE, 1, 'cancelada'),
('2024-12-10', '2024-12-17', 5, 5, 'Luna de miel', TRUE, 2, 'completada'),
('2024-11-20', '2024-11-23', 6, 6, 'Evento familiar', FALSE, 2, 'activa'),
('2024-12-05', '2024-12-09', 7, 7, 'Vacaciones solitarias', TRUE, 1, 'activa'),
('2024-11-25', '2024-12-01', 8, 8, 'Viaje cultural', FALSE, 2, 'completada'),
('2025-06-15', '2025-06-30', 14, 9, 'Vacaciones largas', FALSE, 2, 'activa'),
('2024-12-15', '2024-12-20', 9, 10, 'Vacaciones familiares', TRUE, 5, 'completada'),
('2024-11-05', '2024-11-08', 10, 11, 'Viaje de negocios', FALSE, 1, 'activa'),
('2024-12-20', '2024-12-25', 11, 12, 'Vacaciones en familia', TRUE, 4, 'completada'),
('2024-11-30', '2024-12-03', 12, 13, 'Visita turística', FALSE, 6, 'activa'),
('2024-12-10', '2024-12-15', 13, 14, 'Escapada romántica', TRUE, 2, 'completada'),
('2025-01-05', '2025-01-12', 15, 15, 'Reunión familiar', FALSE, 4, 'activa'),
('2024-12-25', '2024-12-30', 16, 16, 'Navidad en familia', TRUE, 3, 'completada'),
('2024-11-18', '2024-11-20', 17, 17, 'Visita cultural', FALSE, 2, 'activa'),
('2024-12-01', '2024-12-05', 18, 18, 'Vacaciones de invierno', TRUE, 1, 'activa'),
('2025-01-10', '2025-01-15', 19, 19, 'Viaje de trabajo', FALSE, 1, 'completada'),
('2024-12-22', '2024-12-29', 20, 20, 'Vacaciones largas', TRUE, 2, 'completada');

INSERT INTO Consumos_Comedor (reservation_id, food_id, quantity, date_consumo) VALUES
(1, 1, 2, '2024-10-15'),
(2, 2, 1, '2024-11-02'), 
(3, 3, 3, '2024-12-02'), 
(5, 4, 2, '2024-12-11'),
(6, 4, 3, '2024-12-11'),
(7, 3, 1, '2024-11-02'),
(8, 2, 1, '2024-10-15');

INSERT INTO Consumos_Bar (reservation_id, product_id, quantity, date_consumo) VALUES
(1, 1, 4, '2024-10-15'), 
(2, 3, 2, '2024-11-02'), 
(3, 2, 5, '2024-12-02'),
(5, 6, 3, '2024-12-11'); 

INSERT INTO Comprobantes (proof_number, proof_type, proof_roomid, proof_promotionid, proof_reservationid, proof_subprice, proof_igv, proof_finalprice, proof_description, proof_date, hotel_name) VALUES
('001-000001', 'Factura', 1, NULL, 1, 1200.00, 216.00, 1416.00, 'Pago por la estancia y consumos del comedor y bar', '2024-10-17', 'Hotel Cielo'),
('001-000002', 'Factura', 2, NULL, 2, 300.00, 54.00, 354.00, 'Pago por la estancia y consumos del comedor y bar', '2024-11-04', 'Hotel Cielo'),
('001-000003', 'Factura', 3, NULL, 3, 1500.00, 270.00, 1770.00, 'Pago por la estancia y consumos del comedor y bar', '2024-12-06', 'Hotel Cielo'),
('001-000004', 'Factura', 4, NULL, 4, 600.00, 108.00, 708.00, 'Pago por la estancia y consumos del comedor y bar', '2024-11-12', 'Hotel Cielo'),
('001-000005', 'Factura', 5, NULL, 5, 1600.00, 288.00, 1888.00, 'Pago por la estancia y consumos del comedor y bar', '2024-12-17', 'Hotel Cielo'),
('001-000006', 'Boleta', 6, NULL, 6, 800.00, 144.00, 944.00, 'Pago por la estancia', '2024-11-23', 'Hotel Cielo'),
('001-000007', 'Boleta', 7, NULL, 7, 500.00, 90.00, 590.00, 'Pago por la estancia', '2024-12-09', 'Hotel Cielo'),
('001-000008', 'Boleta', 8, NULL, 8, 900.00, 162.00, 1062.00, 'Pago por la estancia', '2024-12-01', 'Hotel Cielo');

INSERT INTO Metodo_Pago (method_type) VALUES
('Tarjeta de Crédito'),
('Tarjeta de Débito'),
('Efectivo'),
('Transferencia Bancaria'),
('Paypal');

INSERT INTO Pagos (payment_price, payment_IGV, payment_finalprice, payment_status, reservation_id, method_id) VALUES
(1200.00, 216.00, 1416.00, 'Completado', 1, 1),
(300.00, 54.00, 354.00, 'Completado', 2, 2),
(1500.00, 270.00, 1770.00, 'Completado', 3, 3),
(600.00, 108.00, 708.00, 'Cancelado', 4, 4),
(1600.00, 288.00, 1888.00, 'Completado', 5, 1),
(800.00, 144.00, 944.00, 'Completado', 6, 2),
(500.00, 90.00, 590.00, 'Completado', 7, 3),
(900.00, 162.00, 1062.00, 'Completado', 8, 5);