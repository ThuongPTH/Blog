-- Tạo bảng users
CREATE TABLE users (
    userId INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    stars INT DEFAULT 100
);

-- Tạo bảng transfers (lịch sử chuyển sao)
CREATE TABLE transfers (
    transId INT AUTO_INCREMENT PRIMARY KEY,
    sender_id INT,
    receiver_id INT,
    stars INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tạo bảng posts (tin đăng)
CREATE TABLE posts (
    postId INT AUTO_INCREMENT PRIMARY KEY,
    userId INT,
    title VARCHAR(255) NOT NULL,
    content TEXT,
    is_public BOOLEAN DEFAULT true,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
