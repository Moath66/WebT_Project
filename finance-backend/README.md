# 💰 Personal Finance Tracker

A modern web-based finance tracker that lets users manage income and expense transactions. Built with **Vue.js (Frontend)**, **PHP (Backend)**, and **MySQL (Database)**.

---

## 📁 Project Structure

⚙️ Setup + Run Instructions
🧩 Backend (PHP + MySQL)
Install XAMPP (if not already):

Download XAMPP

Install and run Apache and MySQL modules.

Create the Database:

Open phpMyAdmin

Create a new database named:

finance_tracker

Create the transactions table:

CREATE TABLE transactions (
id INT AUTO_INCREMENT PRIMARY KEY,
type VARCHAR(20) NOT NULL,
amount DECIMAL(10,2) NOT NULL,
category VARCHAR(100) NOT NULL,
date DATE NOT NULL,
note TEXT
);

Set Up Backend Code:

Copy the folder finance-backend into:

C:/xampp/htdocs/personal-finance-tracker/finance-backend

In each .php file, make sure DB config is set:

$host = "localhost";
$db_name = "finance_tracker";
$username = "root";
$password = ""; // default for XAMPP

Test API:

http://localhost/personal-finance-tracker/finance-backend/api/transactions/get.php

💻 Frontend (Vue.js)
Install Node.js (if not installed):

Download Node.js

Install Project Dependencies:

cd personal-finance-tracker_CODE1
npm install

Run Vue App:
npm run serve

Access Application:

Open browser and visit:
http://localhost:8080

🛠 Axios Configuration (Important)
Make sure main.js includes this:

import axios from "axios";
axios.defaults.headers.post["Content-Type"] = "application/json";

Also, use this API base path in your calls:

http://localhost/personal-finance-tracker/finance-backend/api/transactions/


