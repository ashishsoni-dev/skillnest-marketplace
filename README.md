# SkillNest Marketplace

A full stack freelance marketplace web application inspired by platforms like Fiverr.  
Built using core PHP, MySQL, JavaScript, HTML, and CSS without frameworks.

---

## Live Demo

🔗 https://phpmarketplaceapp.page.gd/

> Note: This project was primarily focused on backend architecture, workflow logic, authentication, and marketplace functionality rather than advanced frontend/UI design. Most features require account signup/login to fully access and test the system.

---

## Features

- User authentication system
- Buyer and seller roles
- Gig creation and browsing
- AJAX live search
- Order management system
- Review and rating system
- Responsive marketplace UI
- Session-based authentication
- Image upload handling
- Role-based dashboard system

---

## Tech Stack

- PHP
- MySQL
- JavaScript
- HTML5
- CSS3

---

## Project Structure

```bash
Marketplace-app/
├── css/
├── js/
├── pages/
├── php/
├── index.php
├── README.md
└── marketplace_db.sql
```

---

## Setup Instructions

### 1. Clone the repository

```bash
git clone https://github.com/your-username/skillnest-marketplace.git
```

---

### 2. Move project to your server directory

Example for XAMPP:

```bash
htdocs/
```

---

### 3. Create the uploads folder manually

The uploads directory is not included in this repository.

Create this folder inside the project root:

```bash
uploads/
```

This folder is required for gig image uploads.

---

### 4. Create a MySQL database

Example database name:

```bash
marketplace_db
```

---

### 5. Import the SQL file

Import:

```bash
marketplace_db.sql
```

using phpMyAdmin or MySQL CLI.

---

### 6. Configure database credentials

Open:

```bash
php/db.php
```

Update:

```php
$host
$user
$password
$dbname
```

according to your local or hosting database configuration.

---

### 7. Start the project

Run using:

- XAMPP
- WAMP
- Local PHP server
- Any PHP hosting service

---

## Main Functionalities

### Authentication
- Login
- Signup
- Logout
- Session handling

### Seller Features
- Create gigs
- Manage gigs
- View seller orders

### Buyer Features
- Browse gigs
- Search gigs
- Place orders
- Submit reviews

### UI Features
- Responsive card layout
- Active navbar states
- AJAX search loading states
- Empty state handling
- Success and error alerts

---

## Notes

- Built without frameworks to strengthen core backend and frontend fundamentals.
- Focused on real-world marketplace flow and UI consistency.
- Upload images are stored locally inside the uploads directory.

---

## Author

Ashish
