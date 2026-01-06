<?php
namespace App\Middleware;

use App\Core\Session;

class AdminAuth {
    public static function requireAdmin() {
        if (!isset($_SESSION['admin_id'])) {
            Session::flash('error', 'Please log in as admin.');
            header('Location: ' . url('/admin/login'));
            exit();
        }
    }
}
