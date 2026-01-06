<?php
namespace App\Middleware;

use App\Core\Session;

class Auth {
    public static function requireUser() {
        if (!isset($_SESSION['user_id'])) {
            Session::flash('error', 'Please log in to continue.');
            header('Location: ' . url('/login'));
            exit();
        }
    }
}
