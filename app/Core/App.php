<?php
namespace App\Core;

class App {
    private $routes;

    public function __construct(array $routes) {
        $this->routes = $routes;
    }

    public function run() {
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
        $script = $_SERVER['SCRIPT_NAME'] ?? '';
        $base = rtrim(str_replace('\\', '/', str_replace('/index.php', '', $script)), '/');
        if ($base && strpos($path, $base) === 0) {
            $path = substr($path, strlen($base));
        }
        $path = rtrim($path, '/');
        if ($path === '/index.php' || $path === '/public' || $path === '/public/index.php') {
            $path = '';
        }
        if ($path === '') {
            $path = '/';
        }

        $handler = $this->routes[$method][$path] ?? null;
        if (!$handler) {
            http_response_code(404);
            View::render('errors/404', [
                'title' => 'Page Not Found',
            ]);
            return;
        }

        [$class, $action] = $handler;
        $controller = new $class();
        call_user_func([$controller, $action]);
    }
}
