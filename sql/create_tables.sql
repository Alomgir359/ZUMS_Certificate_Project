CREATE TABLE students_info (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_name VARCHAR(100),
    student_id VARCHAR(50),
    department VARCHAR(100),
    degree VARCHAR(100),
    major VARCHAR(100),
    semester VARCHAR(50),
    cgpa DECIMAL(3,2)
);


CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'normal') DEFAULT 'normal'
);




INSERT INTO users (username, password, role)
VALUES ('admin', MD5('admin123'), 'admin');
