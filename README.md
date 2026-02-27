# N-Comics Platform

Welcome to the **N-Comics Platform** source code repository. N-Comics is a modern, Webtoon-style comic reading platform built on Laravel 11/12, featuring a robust Admin portal and a sleek "Soft Dark Navy/Cyan" public user interface utilizing PDF.js for vertical continuous scrolling.

---

## 💻 System Requirements

Before installing, please ensure your Windows environment has the following prerequisites installed and running:

* **PHP** (>= 8.2)
* **Composer** (v2+)
* **Node.js** (v18+) & **NPM**
* **MySQL** Server (XAMPP, Laragon, or standalone)
* **Git** (optional, for version control)

---

## 🚀 One-Click Installation (Windows)

We have provided an automated setup script that will configure the entire application for you from scratch!

### 1. Database Setup
First, ensure your local MySQL server is running. Create an empty database for the project. The default name expected in `.env` is `comic_platform`.
- Open your MySQL client (e.g., phpMyAdmin, HeidiSQL, or MySQL CLI).
- Run: `CREATE DATABASE comic_platform;`

### 2. Run the Installer
Navigate into the root of this project folder using your File Explorer.
Simply **Double-Click** the `install.bat` file. 

The script will automatically perform the following steps:
1. Install PHP dependencies (`composer install`)
2. Copy `.env.example` to `.env` if it doesn't exist
3. Generate your Laravel App Key
4. Create public storage symlinks
5. Run database migrations and seed the default admin account
6. Install NPM packages (`npm install`)
7. Compile frontend assets (`npm run build`)
8. Clear cache and optimize
9. Secure local storage folders and permissions

*Note: You may be prompted to allow permissions during the `icacls` step.*

### 3. Start the Server
At the end of the `install.bat` process, it will ask if you want to start the development server immediately. Press `Y` to start it, or run the following command manually whenever you want to work on or view the app:

```bash
php artisan serve
```

Access the application via your web browser:
**http://127.0.0.1:8000**

---

## 🔒 Default Admin Account

The installation process generates an administrator account by default via Database Seeders. You can use these credentials to log in to the admin panel at `/login`:

* **Email:** `admin@ncomics.com`
* **Password:** `admin123`
* **Role:** Administrator

---

## 🛠 Features Included

* **Continuous Vertical PDF Reader:** Upload comic episodes as PDF files, which are rendered page-by-page dynamically with no manual page turning required.
* **Modern Aesthetic:** Theme styled intricately using standard structural utility HTML (TailwindCSS - Soft Dark Navy & Neon Cyan). Includes responsive Navigation components and glow-in-the-dark CSS animations.
* **Complete Admin CRM:** Create comics, assign authors and descriptions, and safely upload episode data.
* **Auto-Increment Episodes:** All standard uploads automatically acquire episode numbers bound perfectly by advanced Database Transactions.
* **All Comics Grid & Search UI:** Find comics via the built-in search filter query.

Enjoy building with N-Comics!
