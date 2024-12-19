<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// Authentication Routes
$routes->get('login', 'Auth::login');                   // Display the login form
$routes->post('login', 'Auth::authenticate');           // Handle login form submission
$routes->get('logout', 'Auth::logout');                 // Logout the user and clear session
$routes->get('register', 'Auth::register');       // Display the registration form
$routes->post('register', 'Auth::store');

$routes->get('/', 'Buku::home', ['filter' => 'auth']);
$routes->get('/kategori', 'Buku::kategori', ['filter' => 'auth']);
$routes->get('/kategori/(:any)', 'Buku::kategori/$1', ['filter' => 'auth']);
$routes->get('/buku/detail/(:num)', 'Buku::detail/$1', ['filter' => 'auth']);
$routes->get('buku/list_buku/(:segment)', 'Buku::listBuku/$1', ['filter' => 'auth']); // Menampilkan buku berdasarkan kategori
$routes->get('buku/list_buku', 'Buku::listBuku', ['filter' => 'auth']); // Menampilkan semua buku


$routes->get('/buku/create', 'Buku::create', ['filter' => 'auth']); // Route untuk halaman form create
$routes->post('/buku/store', 'Buku::store', ['filter' => 'auth']); // Route untuk menyimpan buku baru

// Rute untuk halaman edit buku dan menghapus buku
$routes->get('/buku/edit/(:num)', 'Buku::edit/$1', ['filter' => 'auth']); // Form edit buku
$routes->post('/buku/update/(:num)', 'Buku::update/$1', ['filter' => 'auth']); // Menyimpan perubahan buku
$routes->get('/buku/delete/(:num)', 'Buku::delete/$1', ['filter' => 'auth']); // Menghapus buku

// Borrowing routes
$routes->get('/borrowings', 'BorrowingController::index');            // Menampilkan semua data borrowings
$routes->get('/borrowings/borrow/(:num)/(:num)', 'BorrowingController::borrow/$1/$2');

$routes->post('/borrowings/create', 'BorrowingController::create');   // Membuat borrowing baru
$routes->get('admin/history', 'BorrowingController::adminHistory', ['filter' => 'admin']);
$routes->get('borrowings/history', 'BorrowingController::history', ['filter' => 'auth']);
$routes->get('borrowings/return/(:num)', 'BorrowingController::returnBook/$1', ['filter' => 'auth']);



