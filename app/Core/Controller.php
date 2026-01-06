<?php
namespace App\Core;

class Controller {
    protected function render($view, array $data = []) {
        View::render($view, $data);
    }

    protected function redirect($path) {
        header('Location: ' . url($path));
        exit();
    }
}
