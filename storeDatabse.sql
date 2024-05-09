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
    item_id INT AUTO_INCREMENT PRIMARY KEY,
    item_name VARCHAR(255) NOT NULL,
    item_price VARCHAR(255) NOT NULL,
    item_weight VARCHAR(255) NOT NULL,
    item_quantity INT NOT NULL,
    item_category VARCHAR(255) NOT NULL,
    item_image  VARCHAR(255)
);


CREATE TABLE cart (
  id int(255) NOT NULL,
  name varchar(255) NOT NULL,
  price varchar(255) NOT NULL,
  weight varchar(255) NOT NULL,
  quantity int(255) NOT NULL,
  image varchar(255) NOT NULL,
  category varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE messages (
  Name varchar(250) NOT NULL,
  Email varchar(250) NOT NULL,
  Subject varchar(250) NOT NULL,
  Message longtext NOT NULL
) ;

CREATE TABLE orders_history (
  order_id INT AUTO_INCREMENT,
  customer_id INT,
  name VARCHAR(255),
  number VARCHAR(255),
  email VARCHAR(255),
  street_name VARCHAR(255),
  apartment_number VARCHAR(255),
  city VARCHAR(255),
  state VARCHAR(255),
  zipcode VARCHAR(255),
  total_product VARCHAR(255),
  total_price VARCHAR(255),
  total_weight VARCHAR(255),
  PRIMARY KEY (order_id)
);