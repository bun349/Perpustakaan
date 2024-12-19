<?php

namespace App\Controllers;

use App\Models\BorrowingModel;
use App\Models\BooksModel;
use App\Models\UsersModel;

class BorrowingController extends BaseController
{
    public function index()
    {
        // Ambil semua buku dari database
        $booksModel = new BooksModel();
        $data['books'] = $booksModel->findAll();
        
        // Ambil user_id dari session
        $data['user_id'] = session()->get('user_id');
        
        // Pastikan user sudah login
        if (!$data['user_id']) {
            return redirect()->to('/login')->with('error', 'You must be logged in to borrow books');
        }

        return view('borrowings/index', $data);
    }

    public function borrow($book_id)
    {
        // Ambil user_id dari session
        $user_id = session()->get('user_id');
        
        // Pastikan user sudah login
        if (!$user_id) {
            return redirect()->to('/login')->with('error', 'You must be logged in to borrow books');
        }

        // Ambil buku berdasarkan book_id
        $bookModel = new BooksModel();
        $book = $bookModel->find($book_id);

        if ($book) {
            // Simpan data peminjaman ke database
            $borrowingModel = new BorrowingModel();
            $data = [
                'user_id' => $user_id,
                'book_id' => $book_id,
                'borrow_date' => date('Y-m-d H:i:s'),
            ];

            $borrowingModel->save($data);
            $book_image = $book['cover_image'];

            return redirect()->to('/borrowings')->with('message', 'Buku berhasil dipinjam!');
        }

        return redirect()->to('/borrowings')->with('error', 'Buku tidak ditemukan!');
    }

    public function adminHistory()
    {
        // Pastikan yang mengakses adalah admin
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/')->with('error', 'Akses ditolak');
        }

        // Ambil semua data peminjaman
        $borrowingModel = new BorrowingModel();
        $data['borrowings'] = $borrowingModel->findAll();

        // Tambahkan detail buku dan pengguna
        $userModel = new UsersModel();
        $bookModel = new BooksModel();
        foreach ($data['borrowings'] as &$borrowing) {
            $user = $userModel->find($borrowing['user_id']);
            $borrowing['user_email'] = $user['email'];
            $book = $bookModel->find($borrowing['book_id']);
            $borrowing['book_title'] = $book['title'];
        }

        // Tampilkan ke view khusus admin
        return view('admin/history', $data);
    }


    public function returnBook($borrowing_id)
    {
        $borrowingModel = new BorrowingModel();
        $borrowing = $borrowingModel->find($borrowing_id);

        if ($borrowing) {
            // Perbarui tanggal pengembalian buku
            $data = [
                'return_date' => date('Y-m-d H:i:s'), // Menambahkan tanggal pengembalian
            ];

            // Update data peminjaman dengan return_date yang baru
            $borrowingModel->update($borrowing_id, $data);

            // Periksa role pengguna yang sedang login
            if (session()->get('role') === 'admin') {
                return redirect()->to('/admin/history')->with('message', 'Buku berhasil dikembalikan!');
            } else {
                return redirect()->to('/borrowings/history')->with('message', 'Buku berhasil dikembalikan!');
            }
        }

        // Jika peminjaman tidak ditemukan, arahkan kembali dengan pesan error
        if (session()->get('role') === 'admin') {
            return redirect()->to('/admin/history')->with('error', 'Peminjaman tidak ditemukan!');
        } else {
            return redirect()->to('/borrowings/history')->with('error', 'Peminjaman tidak ditemukan!');
        }
    }


    public function history()
    {
        // Ambil user_id dari session
        $user_id = session()->get('user_id');

        // Pastikan user sudah login
        if (!$user_id) {
            return redirect()->to('/login')->with('error', 'You must be logged in to view borrow history');
        }

        // Ambil riwayat peminjaman berdasarkan user_id
        $borrowingModel = new BorrowingModel();
        $data['borrowings'] = $borrowingModel->where('user_id', $user_id)->findAll();

        // Tambahkan detail buku
        $bookModel = new BooksModel();
        foreach ($data['borrowings'] as &$borrowing) {
            $book = $bookModel->find($borrowing['book_id']);
            $borrowing['book_title'] = $book['title'];
        }

        // Tampilkan ke view khusus untuk user
        return view('borrowings/history', $data);
    }

}
