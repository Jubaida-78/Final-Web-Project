CREATE DATABASE user_management_system;
USE user_management_system;
CREATE TABLE users(
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100)NOT NULL,
    email VARCHAR(100)UNIQUE NOT NULL,
    password VARCHAR(255)NOT NULL,
    profile_image VARCHAR(255),
    verification_code VARCHAR(255),
    is_verified INT DEFAULT 0,
    reset_token VARCHAR(255),
    dark_mode INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE activity_logs(
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    activity VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE payments(
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    amount DECIMAL(10,2),
    payment_status VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);