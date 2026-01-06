<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Middleware\Auth;

class ProfileController extends Controller {
    public function index() {
        Auth::requireUser();
        $this->render('profile/index', [
            'title' => 'Your Profile',
            'userName' => $_SESSION['user_name'] ?? 'Reader',
        ]);
    }
}
