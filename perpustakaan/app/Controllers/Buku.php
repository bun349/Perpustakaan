<?php

namespace App\Controllers;

use App\Models\BooksModel;
use App\Models\CategoriesModel;

class Buku extends BaseController
{
    public function home()
    {
        $booksModel = new BooksModel();
        $categoryModel = new CategoriesModel();

        $data['books'] = $booksModel->findAll();
        $data['categories'] = $categoryModel->findAll(); // Simpan hasil query ke $data

        // Periksa role pengguna
        $userRole = session()->get('role'); // Asumsikan role disimpan di session

        if ($userRole === 'admin') {
            return view('home_admin', $data); // View khusus admin
        } else {
            return view('home_user', $data); // View khusus user
        }
    }

    public function detail($id)
    {
        $booksModel = new BooksModel();
        $data['buku'] = $booksModel->find($id);
        $categoryModel = new CategoriesModel();
        $data['categories'] = $categoryModel->findAll();

        $userRole = session()->get('role');

        if ($userRole === 'admin') {
            return view('detail_admin', $data); // View khusus admin
        } else {
            return view('detail_user', $data); // View khusus user
        }
    }

    public function kategori($categoryName = null)
    {
        $categoriesModel = new \App\Models\CategoriesModel();
        $booksModel = new \App\Models\BooksModel();

        // Ambil semua kategori untuk navigasi
        $data['categories'] = $categoriesModel->findAll();

        if ($categoryName) {
            // Cari ID kategori berdasarkan nama kategori
            $category = $categoriesModel->where('category_name', $categoryName)->first();
            if (!$category) {
                throw new \CodeIgniter\Exceptions\PageNotFoundException("Kategori '$categoryName' tidak ditemukan.");
            }

            // Ambil buku berdasarkan category_id
            $categoryId = $category['category_id'];
            $data['categoryName'] = $category['category_name'];
            $data['books'] = $booksModel->where('category_id', $categoryId)->findAll();
        } else {
            // Jika kategori tidak dipilih, tampilkan semua buku
            $data['categoryName'] = 'Semua Kategori';
            $data['books'] = $booksModel->findAll();
        }

        // PERBAIKAN: Query untuk menghitung jumlah buku berdasarkan kategori
        $db = \Config\Database::connect();
        $query = $db->query("
            SELECT c.category_name, COUNT(b.book_id) as total_books
            FROM categories c
            LEFT JOIN books b ON c.category_id = b.category_id
            GROUP BY c.category_name
        ");
        $data['bookCounts'] = $query->getResultArray(); // Ambil hasil query

        // Hitung total semua buku di semua kategori
        $data['totalBooks'] = array_sum(array_column($data['bookCounts'], 'total_books'));

        // Pencarian buku
        $searchQuery = $this->request->getGet('q');
        if ($searchQuery) {
            $data['books'] = $booksModel->like('title', $searchQuery)->findAll();
        }
        $data['q'] = $searchQuery;

        return view('kategori', $data);
    }




    public function create()
    {
        $categoryModel = new CategoriesModel();
        // Ambil semua kategori dari database
        $data['categories'] = $categoryModel->findAll();

        // Tampilkan view form create dan kirimkan data kategori
        return view('create_buku', $data);
    }

    public function store()
    {
        $booksModel = new BooksModel();
        $validation = \Config\Services::validation();
        $categoryModel = new CategoriesModel();

        // Ambil kategori yang ada
        $data['categories'] = $categoryModel->findAll();

        // Validasi input untuk publisher_name dan kategori
        $validation->setRules([
            'title' => 'required|max_length[255]',
            'publisher_name' => 'required|max_length[100]',
            'description' => 'required',
            'cover_image' => 'uploaded[cover_image]|max_size[cover_image,1024]|is_image[cover_image]|mime_in[cover_image,image/jpg,image/jpeg,image/png]',
            'category_id' => 'required|is_natural_no_zero' // PERUBAHAN: Validasi kategori
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Ambil data dari input
        $title = $this->request->getPost('title');
        $publisher_name = $this->request->getPost('publisher_name');
        $description = $this->request->getPost('description');
        $category_id = $this->request->getPost('category_id'); // PERUBAHAN: Ambil category_id dari input form

        // Mengelola file gambar
        $file = $this->request->getFile('cover_image');
        if ($file->isValid() && !$file->hasMoved()) {
            $fileName = $file->getRandomName();
            $file->move(FCPATH . 'uploads', $fileName); // Menyimpan file di public/uploads
        }

        // Menyimpan data buku dengan kategori
        $booksModel->save([
            'title' => $title,
            'publisher_name' => $publisher_name,
            'description' => $description,
            'cover_image' => $fileName,
            'category_id' => $category_id // PERUBAHAN: Simpan category_id ke database
        ]);

        // Ambil nama kategori berdasarkan category_id yang dipilih
        $category = $categoryModel->find($category_id);
        $categoryName = $category ? $category['category_name'] : 'default-category'; // Jika kategori ditemukan

        // Redirect ke halaman kategori yang sesuai
        return redirect()->to('/kategori/' . esc(url_title($categoryName, '-', true)))->with('success', 'Buku berhasil ditambahkan!');
    }



    public function edit($id)
    {
        $booksModel = new BooksModel();
        $categoryModel = new CategoriesModel();

        $data['categories'] = $categoryModel->findAll();
        $data['buku'] = $booksModel->find($id); // Mendapatkan data buku berdasarkan ID

        if (!$data['buku']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Buku dengan ID $id tidak ditemukan.");
        }

        return view('edit_buku', $data); // Menampilkan form edit dengan data buku
    }

    // Menyimpan perubahan data buku ke database    
    public function update($id)
    {
        $booksModel = new BooksModel();
        $categoryModel = new CategoriesModel();

        // Ambil data kategori untuk dropdown
        $data['categories'] = $categoryModel->findAll();
        $book = $booksModel->find($id); // Ambil buku berdasarkan ID

        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'title' => 'required|max_length[255]',
            'publisher_name' => 'required|max_length[100]',
            'description' => 'required',
            'cover_image' => 'is_image[cover_image]|mime_in[cover_image,image/jpg,image/jpeg,image/png]'
        ]);

        // Jika validasi gagal
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Ambil data dari form
        $title = $this->request->getPost('title');
        $publisher_name = $this->request->getPost('publisher_name');
        $description = $this->request->getPost('description');

        // Proses gambar jika ada perubahan
        $file = $this->request->getFile('cover_image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $fileName = $file->getRandomName();
            $file->move(FCPATH . 'uploads', $fileName); // Simpan di public/uploads
        } else {
            // Jika tidak ada gambar baru, gunakan gambar lama
            $fileName = $this->request->getPost('existing_cover_image');
        }

        // Menyimpan perubahan data buku
        $booksModel->update($id, [
            'title' => $title,
            'publisher_name' => $publisher_name,
            'description' => $description,
            'cover_image' => $fileName,
        ]);

        // Mengambil category_id dari buku yang sedang diperbarui
        $categoryId = $book['category_id'];

        // Ambil nama kategori dari tabel categories berdasarkan category_id
        $category = $categoryModel->find($categoryId); // Mengambil kategori berdasarkan ID
        $categoryName = $category ? $category['category_name'] : 'default-category'; // Jika kategori ditemukan

        // Redirect ke halaman kategori yang sesuai
        return redirect()->to('/kategori/' . esc(url_title($categoryName, '-', true)))->with('success', 'Buku berhasil diperbarui!');
    }



    // Menghapus data buku berdasarkan ID
    public function delete($id)
    {
        $categoryModel = new CategoriesModel();

        // Ambil data kategori untuk dropdown
        $data['categories'] = $categoryModel->findAll();
        $booksModel = new BooksModel();
        $buku = $booksModel->find($id); // Ambil data buku berdasarkan ID

        if (!$buku) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Buku dengan ID $id tidak ditemukan.");
        }

        // Hapus gambar dari folder public/uploads
        unlink(FCPATH . 'uploads/' . $buku['cover_image']);

        // Hapus data buku dari database
        $booksModel->delete($id);

        $categoryId = $buku['category_id'];

        // Ambil nama kategori dari tabel categories berdasarkan category_id
        $category = $categoryModel->find($categoryId); // Mengambil kategori berdasarkan ID
        $categoryName = $category ? $category['category_name'] : 'default-category'; // Jika kategori ditemukan

        // Redirect ke halaman kategori yang sesuai
        return redirect()->to('/kategori/' . esc(url_title($categoryName, '-', true)))->with('success', 'Buku berhasil dihapus!');
    }

    public function listBuku($categoryId = null)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('v_books'); // Menggunakan view 'v_books'

        // Filter berdasarkan kategori jika ada
        if ($categoryId) {
            $builder->where('category_id', $categoryId);
        }

        // Ambil data buku berdasarkan kategori
        $data['books'] = $builder->get()->getResultArray();

        // Ambil data kategori untuk navigasi
        $categoryModel = new CategoriesModel();
        $data['categories'] = $categoryModel->findAll();

        // Jika ada categoryId, ambil nama kategori untuk ditampilkan
        if ($categoryId) {
            $category = $categoryModel->find($categoryId);
            $data['categoryName'] = $category ? $category['category_name'] : 'Kategori Tidak Ditemukan';
        } else {
            $data['categoryName'] = 'Semua Kategori';
        }

        // Menampilkan view list_buku dengan data buku dan kategori
        return view('list_buku', $data);
    }
}
