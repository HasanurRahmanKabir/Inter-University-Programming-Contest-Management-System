# 🏆 Inter University Programming Contest Management System

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white)
![License](https://img.shields.io/badge/License-Academic-blue?style=for-the-badge)

A centralized, secure and highly scalable web-based platform for managing Inter University Programming Contests. This system covers the complete lifecycle of a contest from dynamic website management and team registration to payment verification, team approval and on-site logistics tracking.

---

## 📑 Table of Contents
- [📌 Overview](#-overview)
- [✨ Key Features](#-key-features)
- [🌐 Live Demo & Access](#-live-demo--access)
- [👥 User Roles & Access](#-user-roles--access)
- [🏗️ System Architecture](#️-system-architecture)
- [🛠️ Technology Stack](#️-technology-stack)
- [🔐 Security & Optimization](#-security--optimization)
- [⚙️ Installation & Setup](#️-installation--setup)
- [👨‍💻 Contributors](#-contributors)
- [📜 License](#-license)

---

## 📌 Overview
Organizing large scale programming contests manually leads to scattered data, difficult payment verification and high administrative overhead. This platform modernizes the workflow by providing a **100% Fully Dynamic & Centralized Digital Ecosystem** where Administrators, Coaches and Volunteers collaborate in real time. 

**Every single element of this website is fully dynamic.** From the logo and hero banner to the text, images, schedules and footer everything is controlled and updated directly from the Admin Panel. No code changes are required to manage the platforms content. Designed with scalability in mind, the system significantly reduces human error, guarantees data integrity and provides a highly responsive user interface.

---

## ✨ Key Features

### 🚀 100% Fully Dynamic Website (Admin Managed)
- **A to Z Dynamic Content:** The entire frontend is database driven. Administrators can dynamically update the websites Header, Logos, Hero Banner, About Section, Prize Pool, Event Schedule, Sponsors, Galleries and Footer directly from the Admin Panel.
- **Dynamic Registration Timer:** The countdown timer automatically calculates and displays real time deadlines based on the contest start and end dates set in the admin dashboard.
- **Dynamic Notice & Rule Board:** Publish, edit or delete targeted announcements and contest rules instantly to the homepage.

### 📝 Registration, Authentication & Finance
- **OTP-Based Password Recovery:** A secure, automated 6-digit OTP email system for Coaches and Volunteers to reset their passwords safely.
- **Coach-Led Team Registration:** Secure, structured form handling allowing coaches to register teams and manage member profiles.
- **Integrated Payment Verification:** Built-in workflow for processing bKash, Nagad and Rocket transaction IDs.

### 📊 Logistics & Administration
- **Sponsor & Gallery Management:** Easily upload partner logos and past contest memories.
- **Volunteer Logistics Dashboard:** Dedicated portal for volunteers to track and update kit distribution on-site.
- **Excel Data Export:** One click data export for administrative reporting.

### 🎨 Modern UI/UX
- **Dark Mode UI:** Built-in Dark Mode using vanilla CSS variables, allowing users to switch themes instantly.
- **Mobile-First Navigation:** Specialized bottom navigation bar for mobile devices, ensuring ease of use on smaller screens.

---

## 🌐 Live Demo & Access

Experience the fully functional application live:

- **Public Website:** [https://iupc-website.infinityfree.me/](https://iupc-website.infinityfree.me/)
- **Admin Panel:** [https://iupc-website.infinityfree.me/admin/login](https://iupc-website.infinityfree.me/admin/login)

**Demo Admin Credentials:**
- **Email:** `superadmin@gmail.com`
- **Password:** `12345678`

---

## 👥 User Roles & Access

| Role | Responsibilities |
|---|---|
| **🛡️ Super Admin** | Create and manage Admin accounts, control system level access. |
| **🧑‍💼 Admin** | Create contests, verify payments, approve teams, manage website content (CMS), assign volunteers. |
| **🎓 Coach** | Register teams, submit participant data and payment proofs, track real time approval status. |
| **🧢 Volunteer** | View assigned teams, update and monitor on-site kit distribution status. |

---

## 🏗️ System Architecture
The platform strictly follows the **MVC (Model–View–Controller)** architectural pattern ensuring separation of concerns, high scalability and clean maintainability.

---

## 🛠️ Technology Stack

**Backend:**
- **PHP** (>= 8.5)
- **Laravel** (12.x)
- **MySQL** (Database)

**Frontend:**
- HTML5, CSS3, JavaScript (Vanilla)
- **Bootstrap 5.3.0**
- FontAwesome Icons

**Tools:** Composer, XAMPP, VS Code

---

## 🔐 Security & Optimization

As an industry standard application, the system incorporates enterprise grade security and performance techniques:

- **Role Based Access Control (RBAC):** Strict middleware based route protection across all dashboards.
- **Advanced Caching (`Cache::remember`):** Heavy homepage queries are natively cached, reducing database load by ~90%. This makes the application heavily optimized for both Free Shared Hosting and Paid VPS environments.
- **Fault-Tolerant Database Transactions:** Complex operations (e.g., team registration with photo uploads) are wrapped in `DB::transaction()` with `try-catch` blocks. This ensures data consistency and automatically deletes orphaned uploaded files if a server crash occurs.
- **Session Stability (Keep-Alive):** Background token refreshing prevents `419 Page Expired` issues during long administrative sessions.
- **XSS & SQLi Prevention:** Complete reliance on Laravel's Eloquent ORM and Blade templating to sanitize inputs/outputs.
- **Bcrypt Password Hashing & CSRF Protection.**

---

## ⚙️ Installation & Setup

### 📋 Prerequisites
- PHP >= 8.5
- Composer
- MySQL Database

### 🚀 Setup Steps

1. **Clone the repository**
   ```bash
   git clone https://github.com/HasanurRahmanKabir/Inter-University-Programming-Contest-Management-System.git
   cd Inter-University-Programming-Contest-Management-System
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

4. **Configure environment variables**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   *Edit `.env` and configure your `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD`.*  
   *Make sure to also configure your `MAIL_MAILER`, `MAIL_HOST`, `MAIL_PORT`, `MAIL_USERNAME`, `MAIL_PASSWORD`, and `MAIL_FROM_ADDRESS` so that the OTP Password Recovery system works properly.*

4. **Run Database Migrations**
   ```bash
   php artisan migrate
   ```

5. **Start the local server**
   ```bash
   php artisan serve
   ```
   **Access the application:** [http://127.0.0.1:8000](http://127.0.0.1:8000)

> ⚠️ **Production Warning:** Always ensure `APP_DEBUG=false` in your `.env` file before deploying to a live server to prevent the exposure of sensitive credentials.

---

## 👨‍💻 Contributors
- **Hasanur Rahman Anik**
- **Md. Abrar Faiyz Chowdhury**
- **Shabnur Akter**
- **Nure Jannat Nina**

**Department of Computer Science & Engineering**  
*State University of Bangladesh*

---

## 📜 License
This project is developed for academic and educational purposes.
