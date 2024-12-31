CREATE DATABASE IF NOT EXISTS example_database;

USE example_database;

CREATE TABLE IF NOT EXISTS cars (
    id INT AUTO_INCREMENT PRIMARY KEY,
    make VARCHAR(100) NOT NULL,        
    model VARCHAR(100) NOT NULL,       
    year INT NOT NULL,                 
    price DECIMAL(10, 2) NOT NULL,     
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
