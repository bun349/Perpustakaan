<?php
namespace App\Models;

use CodeIgniter\Model;

class BorrowingModel extends Model
{
    protected $table = 'borrowings'; // Nama tabel yang menyimpan data peminjaman
    protected $primaryKey = 'id'; // Primary key tabel borrowings
    protected $allowedFields = ['user_id', 'book_id', 'borrow_date', 'return_date']; // Kolom yang dapat diisi

    // Jika perlu, Anda bisa menambahkan rule validasi atau function lain di sini.
}
