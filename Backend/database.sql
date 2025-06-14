-- Create database
CREATE DATABASE IF NOT EXISTS personal_finance;
USE personal_finance;

-- Create transactions table
CREATE TABLE IF NOT EXISTS transactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    date DATE NOT NULL,
    category VARCHAR(100) NOT NULL,
    type ENUM('income', 'expense') NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    note TEXT
);

-- Insert sample data
INSERT INTO transactions (date, category, type, amount, note) VALUES
('2024-03-01', 'Salary', 'income', 5000.00, 'Monthly salary'),
('2024-03-02', 'Rent', 'expense', 1200.00, 'Monthly rent payment'),
('2024-03-03', 'Groceries', 'expense', 150.50, 'Weekly groceries'),
('2024-03-04', 'Freelance', 'income', 800.00, 'Website development project'),
('2024-03-05', 'Utilities', 'expense', 200.00, 'Electricity and water bills'); 