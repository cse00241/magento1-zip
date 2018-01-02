
CREATE TABLE customers (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
email VARCHAR(30),
firstname VARCHAR(30),
gender VARCHAR(50),
lastname VARCHAR(30),
password VARCHAR(255)
);

CREATE TABLE customers_address (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
email VARCHAR(30),
address_city VARCHAR(255),
address_country_code VARCHAR(10),
address_firstname VARCHAR(50),
address_lastname VARCHAR(50),
address_postalcode INT(10),
address_street VARCHAR(100),
address_telephone VARCHAR(50),
address_default_belling INT(2),
address_default_shipping INT(2)
);