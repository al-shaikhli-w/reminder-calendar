CREATE TABLE appointments (
      id INT AUTO_INCREMENT PRIMARY KEY,
      user_id INT NULL,
      title VARCHAR(255) NOT NULL,
      appointment_date DATETIME NOT NULL,
      reminder_time INT NOT NULL,
      email VARCHAR(255) NOT NULL,
      created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
      updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
