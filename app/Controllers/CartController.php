<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Csrf;
use App\Core\Session;
use App\Middleware\Auth;
use App\Models\Book;

class CartController extends Controller {
    public function index() {
        Auth::requireUser();
        $cart = $_SESSION['cart'] ?? [];
        $bookIds = array_keys($cart);
        $books = Book::findByIds($bookIds);

        $items = [];
        foreach ($books as $book) {
            $id = $book['Book_id'];
            $items[] = [
                'id' => $id,
                'name' => $book['Name'],
                'author' => $book['Author'],
                'qty' => $cart[$id] ?? 1,
            ];
        }
        $this->render('cart/index', [
            'title' => 'Your Cart',
            'items' => $items,
        ]);
    }

    public function add() {
        Auth::requireUser();

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !Csrf::validate($_POST['csrf'] ?? '')) {
            Session::flash('error', 'Invalid session token.');
            $this->redirect('/books');
        }

        $bookId = $_POST['book_id'] ?? $_GET['id'] ?? null;
        if ($bookId === null) {
            Session::flash('error', 'No book selected.');
            $this->redirect('/books');
        }

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        $bookId = (string) $bookId;
        $_SESSION['cart'][$bookId] = ($_SESSION['cart'][$bookId] ?? 0) + 1;
        Session::flash('success', 'Book added to cart.');
        $this->redirect('/cart');
    }

    public function remove() {
        Auth::requireUser();

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !Csrf::validate($_POST['csrf'] ?? '')) {
            Session::flash('error', 'Invalid session token.');
            $this->redirect('/cart');
        }

        $bookId = $_POST['book_id'] ?? $_GET['id'] ?? null;
        if ($bookId === null) {
            Session::flash('error', 'No book selected.');
            $this->redirect('/cart');
        }

        $bookId = (string) $bookId;
        if (isset($_SESSION['cart'][$bookId])) {
            unset($_SESSION['cart'][$bookId]);
        }
        Session::flash('info', 'Book removed from cart.');
        $this->redirect('/cart');
    }

    public function checkout() {
        Auth::requireUser();
        $cart = $_SESSION['cart'] ?? [];
        if (empty($cart)) {
            Session::flash('info', 'Your cart is empty.');
            $this->redirect('/cart');
        }

        $bookIds = array_keys($cart);
        $books = Book::findByIds($bookIds);
        $items = [];
        foreach ($books as $book) {
            $id = $book['Book_id'];
            $items[] = [
                'id' => $id,
                'name' => $book['Name'],
                'author' => $book['Author'],
                'qty' => $cart[$id] ?? 1,
            ];
        }

        $this->render('cart/checkout', [
            'title' => 'Checkout',
            'items' => $items,
        ]);
    }

    public function purchase() {
        Auth::requireUser();
        if (!Csrf::validate($_POST['csrf'] ?? '')) {
            Session::flash('error', 'Invalid session token.');
            $this->redirect('/cart');
        }

        $cart = $_SESSION['cart'] ?? [];
        if (empty($cart)) {
            Session::flash('info', 'Your cart is empty.');
            $this->redirect('/cart');
        }

        foreach ($cart as $bookId => $qty) {
            Book::decrementAvailability($bookId, (int) $qty);
        }

        unset($_SESSION['cart']);
        Session::flash('success', 'Payment successful. Enjoy your books.');
        $this->redirect('/cart/success');
    }

    public function success() {
        Auth::requireUser();
        $this->render('cart/success', [
            'title' => 'Payment Successful',
        ]);
    }
}
