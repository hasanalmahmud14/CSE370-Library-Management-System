<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Middleware\AdminAuth;
use App\Models\Book;
use App\Models\User;

class AdminController extends Controller {
    public function books() {
        AdminAuth::requireAdmin();
        $books = Book::all();
        $this->render('admin/books', [
            'title' => 'Manage Books',
            'books' => $books,
        ]);
    }

    public function createBook() {
        AdminAuth::requireAdmin();
        $this->render('admin/book_form', [
            'title' => 'Add Book',
            'book' => null,
            'action' => url('/admin/books/store'),
            'submitLabel' => 'Add Book',
        ]);
    }

    public function storeBook() {
        AdminAuth::requireAdmin();
        if (!\App\Core\Csrf::validate($_POST['csrf'] ?? '')) {
            \App\Core\Session::flash('error', 'Invalid session token.');
            $this->redirect('/admin/books');
        }

        $data = $this->bookPayload();
        if ($data['Book_id'] === '' || $data['Name'] === '' || $data['Author'] === '') {
            \App\Core\Session::flash('error', 'Book ID, Name, and Author are required.');
            $this->redirect('/admin/books/create');
        }

        if (Book::create($data)) {
            \App\Core\Session::flash('success', 'Book added.');
            $this->redirect('/admin/books');
        }

        \App\Core\Session::flash('error', 'Failed to add book.');
        $this->redirect('/admin/books/create');
    }

    public function editBook() {
        AdminAuth::requireAdmin();
        $bookId = $_GET['id'] ?? null;
        if ($bookId === null) {
            \App\Core\Session::flash('error', 'Book not found.');
            $this->redirect('/admin/books');
        }
        $book = Book::find($bookId);
        if (!$book) {
            \App\Core\Session::flash('error', 'Book not found.');
            $this->redirect('/admin/books');
        }
        $this->render('admin/book_form', [
            'title' => 'Edit Book',
            'book' => $book,
            'action' => url('/admin/books/update?id=' . urlencode($bookId)),
            'submitLabel' => 'Update Book',
        ]);
    }

    public function updateBook() {
        AdminAuth::requireAdmin();
        if (!\App\Core\Csrf::validate($_POST['csrf'] ?? '')) {
            \App\Core\Session::flash('error', 'Invalid session token.');
            $this->redirect('/admin/books');
        }

        $bookId = $_GET['id'] ?? null;
        if ($bookId === null) {
            \App\Core\Session::flash('error', 'Book not found.');
            $this->redirect('/admin/books');
        }

        $data = $this->bookPayload();
        if ($data['Name'] === '' || $data['Author'] === '') {
            \App\Core\Session::flash('error', 'Name and Author are required.');
            $this->redirect('/admin/books/edit?id=' . urlencode($bookId));
        }

        if (Book::update($bookId, $data)) {
            \App\Core\Session::flash('success', 'Book updated.');
            $this->redirect('/admin/books');
        }

        \App\Core\Session::flash('error', 'Failed to update book.');
        $this->redirect('/admin/books/edit?id=' . urlencode($bookId));
    }

    public function deleteBook() {
        AdminAuth::requireAdmin();
        if (!\App\Core\Csrf::validate($_POST['csrf'] ?? '')) {
            \App\Core\Session::flash('error', 'Invalid session token.');
            $this->redirect('/admin/books');
        }

        $bookId = $_POST['id'] ?? null;
        if ($bookId === null) {
            \App\Core\Session::flash('error', 'Book not found.');
            $this->redirect('/admin/books');
        }

        if (Book::delete($bookId)) {
            \App\Core\Session::flash('info', 'Book deleted.');
            $this->redirect('/admin/books');
        }

        \App\Core\Session::flash('error', 'Failed to delete book.');
        $this->redirect('/admin/books');
    }

    public function users() {
        AdminAuth::requireAdmin();
        $users = User::all();
        $this->render('admin/users', [
            'title' => 'Manage Users',
            'users' => $users,
        ]);
    }

    private function bookPayload() {
        return [
            'Book_id' => trim($_POST['Book_id'] ?? ''),
            'Name' => trim($_POST['Name'] ?? ''),
            'Author' => trim($_POST['Author'] ?? ''),
            'Availability' => trim($_POST['Availability'] ?? ''),
            'Quantity' => trim($_POST['Quantity'] ?? ''),
            'Rent' => trim($_POST['Rent'] ?? ''),
            'Price' => trim($_POST['Price'] ?? ''),
            'Branch' => trim($_POST['Branch'] ?? ''),
            'Edition' => trim($_POST['Edition'] ?? ''),
            'Publisher' => trim($_POST['Publisher'] ?? ''),
            'Details' => trim($_POST['Details'] ?? ''),
        ];
    }
}
