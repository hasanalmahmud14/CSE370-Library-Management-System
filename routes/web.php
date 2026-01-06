<?php
use App\Controllers\HomeController;
use App\Controllers\AuthController;
use App\Controllers\AdminAuthController;
use App\Controllers\AdminController;
use App\Controllers\BooksController;
use App\Controllers\ProfileController;
use App\Controllers\CartController;

return [
    'GET' => [
        '/' => [HomeController::class, 'index'],
        '/index.php' => [HomeController::class, 'index'],
        '/login' => [AuthController::class, 'showLogin'],
        '/register' => [AuthController::class, 'showRegister'],
        '/admin/login' => [AdminAuthController::class, 'showLogin'],
        '/admin/register' => [AdminAuthController::class, 'showRegister'],
        '/admin' => [AdminAuthController::class, 'dashboard'],
        '/admin/books' => [AdminController::class, 'books'],
        '/admin/books/create' => [AdminController::class, 'createBook'],
        '/admin/books/edit' => [AdminController::class, 'editBook'],
        '/admin/users' => [AdminController::class, 'users'],
        '/books' => [BooksController::class, 'index'],
        '/profile' => [ProfileController::class, 'index'],
        '/cart' => [CartController::class, 'index'],
        '/cart/checkout' => [CartController::class, 'checkout'],
        '/cart/success' => [CartController::class, 'success'],
        '/cart/add' => [CartController::class, 'add'],
        '/cart/remove' => [CartController::class, 'remove'],
        '/logout' => [AuthController::class, 'logout'],

        // Legacy routes
        '/user_login.php' => [AuthController::class, 'showLogin'],
        '/user_registration.php' => [AuthController::class, 'showRegister'],
        '/admin_login.php' => [AdminAuthController::class, 'showLogin'],
        '/admin_registration.php' => [AdminAuthController::class, 'showRegister'],
        '/books.php' => [BooksController::class, 'index'],
        '/profile.php' => [ProfileController::class, 'index'],
        '/cart.php' => [CartController::class, 'index'],
        '/logout.php' => [AuthController::class, 'logout'],
    ],
    'POST' => [
        '/login' => [AuthController::class, 'login'],
        '/register' => [AuthController::class, 'register'],
        '/admin/login' => [AdminAuthController::class, 'login'],
        '/admin/register' => [AdminAuthController::class, 'register'],
        '/admin/books/store' => [AdminController::class, 'storeBook'],
        '/admin/books/update' => [AdminController::class, 'updateBook'],
        '/admin/books/delete' => [AdminController::class, 'deleteBook'],
        '/cart/purchase' => [CartController::class, 'purchase'],
        '/cart/add' => [CartController::class, 'add'],
        '/cart/remove' => [CartController::class, 'remove'],

        // Legacy form posts
        '/user_login.php' => [AuthController::class, 'login'],
        '/user_registration.php' => [AuthController::class, 'register'],
        '/admin_login.php' => [AdminAuthController::class, 'login'],
        '/admin_registration.php' => [AdminAuthController::class, 'register'],
    ],
];
