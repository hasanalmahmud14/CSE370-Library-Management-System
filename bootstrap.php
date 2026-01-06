<?php
session_start();

ini_set('display_errors', '1');
error_reporting(E_ALL);

spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    $base_dir = __DIR__ . '/app/';
    if (strncmp($prefix, $class, strlen($prefix)) !== 0) {
        return;
    }
    $relative = substr($class, strlen($prefix));
    $file = $base_dir . str_replace('\\', '/', $relative) . '.php';
    if (file_exists($file)) {
        require $file;
    }
});

function config($key, $default = null) {
    static $cache = [];
    $segments = explode('.', $key);
    $file = array_shift($segments);
    if (!isset($cache[$file])) {
        $path = __DIR__ . '/config/' . $file . '.php';
        $cache[$file] = file_exists($path) ? require $path : [];
    }
    $value = $cache[$file];
    foreach ($segments as $segment) {
        if (!is_array($value) || !array_key_exists($segment, $value)) {
            return $default;
        }
        $value = $value[$segment];
    }
    return $value;
}

function base_path() {
    $script = $_SERVER['SCRIPT_NAME'] ?? '';
    $base = rtrim(str_replace('\\', '/', str_replace('/index.php', '', $script)), '/');
    return $base;
}

function url($path) {
    $path = $path == '' ? '/' : ($path[0] === '/' ? $path : '/' . $path);
    $base = base_path();
    return $base ? $base . $path : $path;
}

function asset($path) {
    return url('assets/' . ltrim($path, '/'));
}

function is_user() {
    return isset($_SESSION['user_id']);
}

function is_admin() {
    return isset($_SESSION['admin_id']);
}

function csrf_field() {
    $token = App\Core\Csrf::token();
    return '<input type="hidden" name="csrf" value="' . htmlspecialchars($token, ENT_QUOTES, 'UTF-8') . '">';
}
