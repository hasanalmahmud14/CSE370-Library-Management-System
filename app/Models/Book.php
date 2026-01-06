<?php
namespace App\Models;

use App\Core\Database;

class Book {
    public static function all() {
        $db = Database::connection();
        $stmt = $db->query('SELECT Book_id, Name, Author, Availability FROM book');
        return $stmt->fetchAll();
    }

    public static function find($bookId) {
        $db = Database::connection();
        $stmt = $db->prepare('SELECT * FROM book WHERE Book_id = ?');
        $stmt->execute([$bookId]);
        return $stmt->fetch();
    }

    public static function create(array $data) {
        $db = Database::connection();
        $stmt = $db->prepare(
            'INSERT INTO book (Book_id, Name, Author, Availability, Quantity, Rent, Price, Branch, Edition, Publisher, Details)
             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'
        );
        return $stmt->execute([
            $data['Book_id'],
            $data['Name'],
            $data['Author'],
            $data['Availability'],
            $data['Quantity'],
            $data['Rent'],
            $data['Price'],
            $data['Branch'],
            $data['Edition'],
            $data['Publisher'],
            $data['Details'],
        ]);
    }

    public static function update($bookId, array $data) {
        $db = Database::connection();
        $stmt = $db->prepare(
            'UPDATE book
             SET Name = ?, Author = ?, Availability = ?, Quantity = ?, Rent = ?, Price = ?, Branch = ?, Edition = ?, Publisher = ?, Details = ?
             WHERE Book_id = ?'
        );
        return $stmt->execute([
            $data['Name'],
            $data['Author'],
            $data['Availability'],
            $data['Quantity'],
            $data['Rent'],
            $data['Price'],
            $data['Branch'],
            $data['Edition'],
            $data['Publisher'],
            $data['Details'],
            $bookId,
        ]);
    }

    public static function delete($bookId) {
        $db = Database::connection();
        $stmt = $db->prepare('DELETE FROM book WHERE Book_id = ?');
        return $stmt->execute([$bookId]);
    }

    public static function decrementAvailability($bookId, $qty) {
        $db = Database::connection();
        $stmt = $db->prepare(
            'UPDATE book SET Availability = GREATEST(Availability - ?, 0) WHERE Book_id = ?'
        );
        return $stmt->execute([$qty, $bookId]);
    }

    public static function findByIds(array $ids) {
        if (empty($ids)) {
            return [];
        }
        $db = Database::connection();
        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        $stmt = $db->prepare("SELECT Book_id, Name, Author, Availability FROM book WHERE Book_id IN ($placeholders)");
        $stmt->execute($ids);
        return $stmt->fetchAll();
    }
}
