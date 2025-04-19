CREATE DATABASE IF NOT EXISTS crud_search_system;
USE crud_search_system;

CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO products (name, description, price) VALUES
('Laptop', 'High performance laptop with 16GB RAM', 999.99),
('Smartphone', 'Latest smartphone with 5G support', 699.99),
('Headphones', 'Noise cancelling wireless headphones', 249.99),
('Smartwatch', 'Fitness tracking smartwatch', 199.99);