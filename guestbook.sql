-- Create database for Guestbook
CREATE DATABASE IF NOT EXISTS guestbook;
USE guestbook;

-- Table for Guestbook
CREATE TABLE IF NOT EXISTS entries (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Sample data for Guestbook
INSERT INTO entries (name, message) VALUES 
('Alice', 'Hello, this is a great guestbook!'),
('Bob', 'Just dropping by to say hi.');
