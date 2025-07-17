CREATE DATABASE IF NOT EXISTS library_db;

USE library_db;

-- Create the visitors table
CREATE TABLE IF NOT EXISTS `visitors` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(255) NOT NULL,
  `address` TEXT NOT NULL,
  `phone_number` VARCHAR(20) NOT NULL,
  `visit_date` DATE NOT NULL
);

-- Sample data insertion (optional)
INSERT INTO `visitors` (name, address, phone_number, visit_date) 
VALUES 
  ('John Doe', '123 Main St, Springfield', '555-1234', '2025-07-15'),
  ('Jane Smith', '456 Elm St, Springfield', '555-5678', '2025-07-16');
