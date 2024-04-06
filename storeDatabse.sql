CREATE DATABASE store_database;
USE  store_database;


CREATE TABLE customer_info (
    customer_id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    phone VARCHAR(255) NOT NULL,    
    street_name VARCHAR(255) NOT NULL,
    apartment_number VARCHAR(255),
    city VARCHAR(255) NOT NULL,
    state VARCHAR(255) NOT NULL,
    zipcode VARCHAR(255) NOT NULL
);

CREATE TABLE employee_info (
    employee_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE store_inventory (
    item_id INT PRIMARY KEY,
    item_name VARCHAR(255) NOT NULL,
    item_category VARCHAR(255) NOT NULL,
    item_quantity INT NOT NULL,
    item_price DECIMAL(10, 2) NOT NULL,
    item_weight DECIMAL(10, 2) NOT NULL
);

CREATE TABLE orders_history (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT,
    items VARCHAR(255) NOT NULL,
    total_weight DECIMAL(10, 2) NOT NULL,
    total_cost DECIMAL(10, 2) NOT NULL,
    address VARCHAR(255) NOT NULL,
    date_time DATETIME NOT NULL,
    FOREIGN KEY (customer_id) REFERENCES customer_info(customer_id)
);