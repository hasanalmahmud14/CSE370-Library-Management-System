<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Csrf;
use App\Core\Session;
use App\Models\User;

class AuthController extends Controller {
    public function showLogin() {
        $this->render('auth/login', [
            'title' => 'User Login',
        ]);
    }

    public function login() {
        if (!Csrf::validate($_POST['csrf'] ?? '')) {
            Session::flash('error', 'Invalid session token.');
            $this->redirect('/login');
        }

        $userId = trim($_POST['UserID'] ?? '');
        $password = $_POST['Password'] ?? '';

        $user = User::findByUserId($userId);
        $passwordOk = false;
        if ($user) {
            $info = password_get_info($user['Password']);
            if (!empty($info['algo'])) {
                $passwordOk = password_verify($password, $user['Password']);
            } else {
                $passwordOk = hash_equals($user['Password'], $password);
            }
        }
        if ($user && $passwordOk) {
            session_regenerate_id(true);
            $_SESSION['user_id'] = $user['User_ID'];
            $_SESSION['user_name'] = $user['Name'];
            $this->redirect('/profile');
        }

        Session::flash('error', 'Invalid user ID or password.');
        $this->redirect('/login');
    }

    public function showRegister() {
        $this->render('auth/register', [
            'title' => 'User Registration',
        ]);
    }

    public function register() {
        if (!Csrf::validate($_POST['csrf'] ?? '')) {
            Session::flash('error', 'Invalid session token.');
            $this->redirect('/register');
        }

        $username = trim($_POST['Username'] ?? '');
        $userId = trim($_POST['UserID'] ?? '');
        $email = trim($_POST['Email'] ?? '');
        $password = $_POST['Password'] ?? '';

        if ($username === '' || $userId === '' || $email === '' || $password === '') {
            Session::flash('error', 'All fields are required.');
            $this->redirect('/register');
        }

        if (User::existsByUserId($userId)) {
            Session::flash('error', 'User ID already exists.');
            $this->redirect('/register');
        }

        $hash = password_hash($password, PASSWORD_BCRYPT);
        if (User::create($username, $userId, $email, $hash)) {
            Session::flash('success', 'Registration successful. Please log in.');
            $this->redirect('/login');
        }

        Session::flash('error', 'Registration failed.');
        $this->redirect('/register');
    }

    public function logout() {
        session_unset();
        session_destroy();
        $this->redirect('/');
    }
}
