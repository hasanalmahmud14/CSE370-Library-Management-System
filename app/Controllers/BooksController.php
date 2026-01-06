<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Middleware\Auth;
use App\Models\Book;

class BooksController extends Controller {
    public function index() {
        Auth::requireUser();
        $books = Book::all();
        $this->render('books/index', [
            'title' => 'Books',
            'books' => $books,
        ]);
    }
}
