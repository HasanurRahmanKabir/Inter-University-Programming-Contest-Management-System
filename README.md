🏆 Inter University Programming Contest Management System

A centralized, secure and scalable web based platform for managing Inter University Programming Contests, covering the complete lifecycle from contest creation and team registration to payment verification and on site logistics management.

📑 Table of Contents

📌 Overview

❗ Problem Statement

💡 Solution Summary

🚀 Key Features

👥 User Roles & Responsibilities

🏗️ System Architecture

🛠️ Technology Stack

🔐 Security Implementation

🗄️ Database Design Overview

🔄 Workflow Description

⚙️ Installation & Setup

🔮 Future Enhancements

👨‍💻 Contributors

📜 License

📌 Overview

The Inter University Programming Contest Management System is a web application developed to modernize and automate the organizational workflow of large scale academic programming contests.

The platform eliminates dependency on spreadsheets, manual verification and scattered communication by providing a centralized system where administrators, coaches and volunteers collaboratively manage contest operations in a structured and secure manner.

Inter University Programming Contest Management System ensures data integrity, operational transparency and efficient logistics handling through role based access control and a robust backend architecture.

❗ Problem Statement

Organizing Inter University Programming Contests using traditional manual methods leads to:

Data duplication and inconsistency

Difficult payment verification

Inefficient team validation

Lack of centralized tracking

High administrative overhead

As contest scale increases, these issues directly affect reliability, transparency and overall event quality.

💡 Solution Summary

Inter University Programming Contest Management System introduces a centralized digital platform that:

Digitizes team registration through verified coaches

Provides structured payment verification

Enables real time logistics tracking

Applies role based access control

Stores all contest data in a secure relational database

The system significantly reduces human error, administrative effort and operational complexity.

🚀 Key Features

Multi role authentication system

Coach led team registration

Secure payment verification (bKash, Nagad, Rocket)

Contest creation and scheduling

Team approval and status tracking

Volunteer logistics dashboard

Kit distribution monitoring

Notice and rule management

Sponsor and gallery management

Data export (Excel)

👥 User Roles & Responsibilities
🛡️ Super Admin

Create and manage Admin accounts

Control system level access

🧑‍💼 Admin

Create contests

Verify payments

Approve teams

Manage notices, sponsors, gallery and rules

Add volunteers

🎓 Coach

Register teams

Provide participant details

Submit payment transaction ID

View team status

🧢 Volunteer

View assigned teams

Update kit distribution status

🏗️ System Architecture

The platform follows the Model–View–Controller (MVC) architectural pattern:

Model → Database interaction

View → User interface

Controller → Business logic

This architecture ensures separation of concerns, scalability and maintainability.

🛠️ Technology Stack
🔧 Backend

PHP (Laravel Framework)

🎨 Frontend

HTML5

CSS3

Bootstrap 5

JavaScript

🗄️ Database

MySQL

🧰 Development Tools

VS Code

XAMPP

phpMyAdmin

🔐 Security Implementation

Role Based Access Control (RBAC)

Bcrypt password hashing

CSRF protection

SQL Injection prevention

Input validation

🗄️ Database Design Overview

The system uses a relational database containing tables such as:

super_admin_infos

admin_infos

team_registration_infos

payment_infos

contest_infos

notices

volunteer_infos

kit_statuses

rules

galleries

sponsor_infos

All relationships are maintained using foreign keys to ensure data consistency and integrity.

🔄 Workflow Description

Admin creates contest

Coach registers team

Coach submits payment information

Admin verifies payment

Admin approves team

Volunteer distributes kits

Volunteer updates kit status

⚙️ Installation & Setup
📋 Prerequisites

PHP >= 8.2.12

Composer

MySQL

XAMPP or similar server

🧪 Setup Steps
git clone (https://github.com/HasanurRahmanKabir/Inter-University-Programming-Contest-Management-System)
cd Inter-University-Programming-Contest-Management-System
composer install
cp .env.example .env
php artisan key:generate


Configure database credentials in .env

php artisan migrate
php artisan serve


🔗 Access the application:

http://127.0.0.1:8000

🔮 Future Enhancements

Online judge integration

Real time scoreboard

Certificate generation (PDF)

Email & SMS notifications

Two factor authentication

Mobile application

👨‍💻 Contributors

Hasanur Rahman Anik

Md. Abrar Faiyz Chowdhury

Shabnur Akter

Nure Jannat Nina

Department of Computer Science & Engineering
State University of Bangladesh

📜 License

This project is developed for academic and educational purposes.
