<?php
namespace App\Models;

use App\Core\Database;

class User {
    public static function all() {
        $db = Database::connection();
        $stmt = $db->query('SELECT User_ID, Name, Email, U_type, Book_Id FROM user');
        return $stmt->fetchAll();
    }

    public static function findByUserId($userId) {
        $db = Database::connection();
        $stmt = $db->prepare('SELECT User_ID, Name, Password, Email FROM user WHERE User_ID = ?');
        $stmt->execute([$userId]);
        return $stmt->fetch();
    }

    public static function existsByUserId($userId) {
        $db = Database::connection();
        $stmt = $db->prepare('SELECT User_ID FROM user WHERE User_ID = ?');
        $stmt->execute([$userId]);
        return (bool) $stmt->fetch();
    }

    public static function create($username, $userId, $email, $hashedPassword) {
        $db = Database::connection();
        $stmt = $db->prepare('INSERT INTO user (Name, User_ID, Email, Password) VALUES (?, ?, ?, ?)');
        return $stmt->execute([$username, $userId, $email, $hashedPassword]);
    }
}
