<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Csrf;
use App\Core\Session;
use App\Middleware\AdminAuth;
use App\Models\Admin;

class AdminAuthController extends Controller {
    public function showLogin() {
        $this->render('admin/login', [
            'title' => 'Admin Login',
        ]);
    }

    public function login() {
        if (!Csrf::validate($_POST['csrf'] ?? '')) {
            Session::flash('error', 'Invalid session token.');
            $this->redirect('/admin/login');
        }

        $adminId = trim($_POST['Admin_id'] ?? '');
        $password = $_POST['Password'] ?? '';

        $admin = Admin::findByAdminId($adminId);
        $passwordOk = false;
        if ($admin) {
            $info = password_get_info($admin['Password']);
            if (!empty($info['algo'])) {
                $passwordOk = password_verify($password, $admin['Password']);
            } else {
                $passwordOk = hash_equals($admin['Password'], $password);
            }
        }
        if ($admin && $passwordOk) {
            session_regenerate_id(true);
            $_SESSION['admin_id'] = $admin['Admin_id'];
            $_SESSION['admin_name'] = $admin['Type'] ?? $admin['Admin_id'];
            $this->redirect('/admin');
        }

        Session::flash('error', 'Invalid admin ID or password.');
        $this->redirect('/admin/login');
    }

    public function showRegister() {
        $this->render('admin/register', [
            'title' => 'Admin Registration',
        ]);
    }

    public function register() {
        if (!Csrf::validate($_POST['csrf'] ?? '')) {
            Session::flash('error', 'Invalid session token.');
            $this->redirect('/admin/register');
        }

        $name = trim($_POST['Adminname'] ?? '');
        $adminId = trim($_POST['Admin_id'] ?? '');
        $email = trim($_POST['Email'] ?? '');
        $password = $_POST['Password'] ?? '';

        if ($name === '' || $adminId === '' || $email === '' || $password === '') {
            Session::flash('error', 'All fields are required.');
            $this->redirect('/admin/register');
        }

        if (Admin::existsByAdminId($adminId)) {
            Session::flash('error', 'Admin ID already exists.');
            $this->redirect('/admin/register');
        }

        $hash = password_hash($password, PASSWORD_BCRYPT);
        if (Admin::create($name, $adminId, $email, $hash)) {
            Session::flash('success', 'Admin account created. Please log in.');
            $this->redirect('/admin/login');
        }

        Session::flash('error', 'Registration failed.');
        $this->redirect('/admin/register');
    }

    public function dashboard() {
        AdminAuth::requireAdmin();
        $this->render('admin/dashboard', [
            'title' => 'Admin Dashboard',
        ]);
    }
}
