# Online Library Management System

Modern PHP library app with MVC structure, user/admin auth, cart, and admin book management.

## Features
- User login/registration with sessions and CSRF protection
- Browse books and add to cart
- Dummy checkout flow with availability deduction
- Admin login with dashboard
- Admin CRUD for books and user list view

## Tech Stack
- PHP 8+
- MySQL/MariaDB
- PDO

## Project Structure
- `public/` front controller and assets
- `app/` controllers, models, views, middleware
- `routes/` route definitions
- `config/` app and database settings
- `database/` schema/migrations

## Setup (XAMPP)
1. Place the project at `C:\xampp\htdocs\lia`
2. Set Apache document root to `C:\xampp\htdocs\lia\public` (recommended)
3. Start Apache + MySQL
4. Create the database `library_management`
5. Ensure tables exist (or import your existing schema)
6. Update `config/database.php` if needed
7. Open `http://localhost/lia/public/`

## Database Notes
This project is aligned with the following existing tables:

### `user` table
- `User_ID`, `Name`, `Email`, `Password`, `U_type`, `Book_Id`

### `admin` table
- `Admin_id`, `Password`, `Email`, `Type`

### `book` table
- `Book_id`, `Name`, `Author`, `Availability`, `Quantity`, `Rent`, `Price`, `Branch`, `Edition`, `Publisher`, `Details`

If your schema differs, update `app/Models/User.php`, `app/Models/Admin.php`, and `app/Models/Book.php`.

## Routes (Key)
- `/` home
- `/login`, `/register`
- `/books`, `/cart`, `/cart/checkout`
- `/admin`, `/admin/books`, `/admin/books/create`

## Admin Book Management
Use `/admin/books` to add, edit, or delete books.

## Checkout (Dummy)
Checkout is a dummy flow. Clicking **Pay Now**:
- Shows success page
- Decrements `Availability` in the `book` table

## License
MIT
