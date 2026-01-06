<?php
namespace App\Core;

class View {
    public static function render($view, array $data = []) {
        $viewFile = __DIR__ . '/../Views/' . $view . '.php';
        if (!file_exists($viewFile)) {
            throw new \RuntimeException('View not found: ' . $view);
        }
        extract($data, EXTR_SKIP);
        require __DIR__ . '/../Views/layout.php';
    }
}
