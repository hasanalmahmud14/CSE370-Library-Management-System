<?php
namespace App\Models;

use App\Core\Database;

class Admin {
    public static function findByAdminId($adminId) {
        $db = Database::connection();
        $stmt = $db->prepare('SELECT Admin_id, Password, Type FROM admin WHERE Admin_id = ?');
        $stmt->execute([$adminId]);
        return $stmt->fetch();
    }

    public static function existsByAdminId($adminId) {
        $db = Database::connection();
        $stmt = $db->prepare('SELECT Admin_id FROM admin WHERE Admin_id = ?');
        $stmt->execute([$adminId]);
        return (bool) $stmt->fetch();
    }

    public static function create($adminName, $adminId, $email, $hashedPassword) {
        $db = Database::connection();
        $stmt = $db->prepare('INSERT INTO admin (Type, Admin_id, Email, Password) VALUES (?, ?, ?, ?)');
        return $stmt->execute([$adminName, $adminId, $email, $hashedPassword]);
    }
}
