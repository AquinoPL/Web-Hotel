CREATE DATABASE u472469844_est31;
use u472469844_est31;

CREATE TABLE Hotel (
    hotel_name VARCHAR(30) PRIMARY KEY,
    hotel_location VARCHAR(255),
    hotel_description TEXT,
    hotel_rooms INT,
    hotel_floors INT
);

CREATE TABLE Empleados (
    employee_id INT AUTO_INCREMENT PRIMARY KEY,
    employee_dni VARCHAR(8) NOT NULL,
    employee_name VARCHAR(255) NOT NULL,
    employee_lastname VARCHAR(255) NOT NULL,
    employee_phonenumber VARCHAR(255),
    employee_email VARCHAR(255),
    employee_salary DECIMAL(10,2) NOT NULL,
    employee_job VARCHAR(255),
    employee_workspace VARCHAR(255),
    hotel_name VARCHAR(30),
    FOREIGN KEY (hotel_name) REFERENCES Hotel(hotel_name)
);

CREATE TABLE Categoria (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    category_type VARCHAR (255) NOT NULL,
    category_beds INT NOT NULL,
    category_descripcion TEXT,
    category_maxcapacity VARCHAR(255),
    category_image VARCHAR(255)
);

CREATE TABLE Habitaciones (
    room_id INT AUTO_INCREMENT PRIMARY KEY,
    room_floor INT NOT NULL,
    room_capacity INT NOT NULL,
    room_price DECIMAL(10, 2) NOT NULL,
    room_availability ENUM('Disponible','Reservada','No Disponible') DEFAULT 'Disponible',
    category_id INT,
    FOREIGN KEY (category_id) REFERENCES Categoria(category_id)
);

CREATE TABLE Productos(
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    product_price DECIMAL(10, 2) NOT NULL,
    product_quantity INT NOT NULL,
    product_name VARCHAR(255) NOT NULL,
    product_description TEXT,
    product_image VARCHAR(255)
);

CREATE TABLE Menu_Comedor (
    food_id INT AUTO_INCREMENT PRIMARY KEY,
    food_name VARCHAR(255) NOT NULL,
    food_availability BOOLEAN NOT NULL,
    food_price DECIMAL(10, 2) NOT NULL,
    food_description TEXT,
    food_type ENUM('desayuno', 'almuerzo', 'cena') DEFAULT NULL,
    food_image VARCHAR(255)
);

CREATE TABLE Promociones (
    promotion_id INT AUTO_INCREMENT PRIMARY KEY,
    promotion_type VARCHAR(255) NOT NULL,
    promotion_description TEXT,
    promotion_availability BOOLEAN NOT NULL,
    promotion_price DECIMAL(10, 2) NOT NULL
);

CREATE TABLE Usuarios (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    user_typedoc VARCHAR(30) NOT NULL,
    user_doc VARCHAR(10) NOT NULL,
    user_name VARCHAR(255) NOT NULL,
    user_lastname VARCHAR(255) NOT NULL,
    user_phonenumber VARCHAR(255),
    user_email VARCHAR(255)
);

CREATE TABLE Huespedes (
    huesped_id INT AUTO_INCREMENT PRIMARY KEY,
    huesped_typedoc VARCHAR(30) NOT NULL,
    huesped_doc VARCHAR(10) NOT NULL,
    huesped_name VARCHAR(255) NOT NULL,
    huesped_lastname VARCHAR(255) NOT NULL,
    user_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES Usuarios(user_id)
);

CREATE TABLE Reservaciones (
    reservation_id INT AUTO_INCREMENT PRIMARY KEY,
    date_init DATE NOT NULL,
    date_finish DATE NOT NULL,
    room_id INT,
    user_id INT,
    reservation_statement VARCHAR(255),
    reservation_lunch BOOLEAN DEFAULT FALSE,
    number_of_guests INT NOT NULL,
    reservation_status ENUM('activa', 'cancelada', 'completada') DEFAULT 'activa',
    FOREIGN KEY (room_id) REFERENCES Habitaciones(room_id),
    FOREIGN KEY (user_id) REFERENCES Usuarios(user_id)
);

CREATE TABLE Consumos_Comedor (
    consumo_comedor_id INT AUTO_INCREMENT PRIMARY KEY,
    reservation_id INT NOT NULL,
    food_id INT NOT NULL,
    quantity INT NOT NULL,
    date_consumo DATETIME NOT NULL,
    FOREIGN KEY (reservation_id) REFERENCES Reservaciones(reservation_id),
    FOREIGN KEY (food_id) REFERENCES Menu_Comedor(food_id)
);

CREATE TABLE Consumos_Bar (
    consumo_bar_id INT AUTO_INCREMENT PRIMARY KEY,
    reservation_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    date_consumo DATETIME NOT NULL,
    FOREIGN KEY (reservation_id) REFERENCES Reservaciones(reservation_id),
    FOREIGN KEY (product_id) REFERENCES Productos(product_id)
);

CREATE TABLE Comprobantes (
    proof_id INT AUTO_INCREMENT PRIMARY KEY,
    proof_number VARCHAR(255) NOT NULL,
    proof_type VARCHAR(255) NOT NULL,
    proof_roomid INT,
    proof_promotionid INT,
    proof_reservationid INT,
    proof_subprice DECIMAL(10, 2) NOT NULL,
    proof_igv DECIMAL(10,2) NOT NULL,
    proof_finalprice DECIMAL(10, 2) NOT NULL,
    proof_description TEXT,
    proof_date DATE NOT NULL,
    hotel_name VARCHAR(30),
    FOREIGN KEY (proof_promotionid) REFERENCES Promociones(promotion_id),
    FOREIGN KEY (proof_reservationid) REFERENCES Reservaciones(reservation_id),
    FOREIGN KEY (hotel_name) REFERENCES Hotel(hotel_name)
);

CREATE TABLE Metodo_Pago (
    method_id INT AUTO_INCREMENT PRIMARY KEY,
    method_type VARCHAR(255) NOT NULL
);

CREATE TABLE Pagos (
    payment_id INT AUTO_INCREMENT PRIMARY KEY,
    payment_price DECIMAL(10,2) NOT NULL,
    payment_IGV DECIMAL (10,2) NOT NULL,
    payment_finalprice DECIMAL (10,2) NOT NULL,
    payment_status VARCHAR(255) NOT NULL,
    reservation_id INT,
    method_id INT,
    FOREIGN KEY (method_id) REFERENCES Metodo_Pago(method_id),
    FOREIGN KEY (reservation_id) REFERENCES Reservaciones(reservation_id)
);