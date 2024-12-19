<?php

namespace App\Models;

use CodeIgniter\Model;

class BooksModel extends Model
{
    protected $table = 'books';
    protected $primaryKey = 'book_id';
    protected $allowedFields = ['title', 'publisher_name', 'description', 'cover_image', 'category_id'];

    public function getBooksByCategory($categoryId = null)
    {
        $this->select('books.book_id, books.title, categories.category_name')
            ->join('categories', 'categories.category_id = books.category_id');

        if ($categoryId) {
            $this->where('books.category_id', $categoryId);
        }

        return $this->findAll();
    }
}
