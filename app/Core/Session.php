<?php
namespace App\Core;

class Session {
    public static function get($key, $default = null) {
        return $_SESSION[$key] ?? $default;
    }

    public static function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    public static function forget($key) {
        unset($_SESSION[$key]);
    }

    public static function flash($key, $value = null) {
        if ($value !== null) {
            $_SESSION['_flash'][$key] = $value;
            return;
        }
        if (isset($_SESSION['_flash'][$key])) {
            $value = $_SESSION['_flash'][$key];
            unset($_SESSION['_flash'][$key]);
            return $value;
        }
        return null;
    }
}
