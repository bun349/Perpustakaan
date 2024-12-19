<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Buku</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="<?= base_url('css/list_buku.css') ?>">

    <script>
        // Fungsi untuk konfirmasi penghapusan
        function confirmDelete(id) {
            if (confirm("Apakah Anda yakin ingin menghapus buku ini?")) {
                window.location.href = "/buku/delete/" + id;
            }
        }
    </script>
</head>

<body>
    <header>
        <div class="container">
            <div class="logo">
                <a href="/" class="italic">Buku.com</a>
            </div>
            <nav>
                <ul>
                    <li><a style="font-size: 20px;" href="/">Home</a></li>
                    <li>
                        <input type="text" id="searchBar" placeholder="Search" class="search-bar">
                    </li>
                </ul>
            </nav>
            <div class="auth">
                <span class="username-dropdown">
                    <?= esc(session()->get('username')) ?> <!-- Menampilkan username -->
                    <span class="material-symbols-outlined">person</span>
                    <div class="dropdown-content">
                        <p><?= esc(session()->get('email')) ?></p> <!-- Menampilkan email -->
                        <a href="/logout">Logout</a> <!-- Link untuk logout -->
                    </div>
                </span
        </div>
    </header>
    <main>

        <h1 style="font-size: 30px; color: #7469B6;" class="italic">Daftar Buku</h1>
        <!-- Menampilkan buku dalam tabel -->
        <?php if (!empty($books)): ?>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul Buku</th>
                        <th>Kategori</th>
                        <th>Deskripsi</th>
                        <th>Cover</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($books as $index => $book): ?>
                        <tr>
                            <td><?= $index + 1; ?></td>
                            <td><?= esc($book['title']); ?></td>
                            <td><?= esc($book['category_name']); ?></td>
                            <td><?= esc($book['description']); ?></td>
                            <td>
                                <img src="<?= base_url('uploads/' . esc($book['cover_image'])); ?>" alt="Cover Image" class="cover-image">
                            </td>
                            <td class="actions">
                                <a href="/buku/edit/<?= esc($book['book_id']); ?>" class="edit-button">Edit</a>
                                <button onclick="confirmDelete(<?= esc($book['book_id']) ?>)" class="delete-button">Delete</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="no-data">Tidak ada buku yang ditemukan.</p>
        <?php endif; ?>
    </main>
    <footer>
        ©2024 PT. Byte Back
    </footer>
</body>

</html>