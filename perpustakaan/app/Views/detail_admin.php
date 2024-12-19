<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku Page</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" /
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=edit" />
    <link rel="stylesheet" href="<?= base_url('css/Buku.css') ?>">
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
                    <li class="dropdown">
                        <a style="font-size: 20px;" href="/kategori" class="dropdown-toggle">Kategori</a>
                        <ul class="dropdown-menu">
                            <!-- Dropdown untuk kategori spesifik -->
                            <?php foreach ($categories as $category): ?>
                                <li>
                                    <a href="/kategori/<?= esc(url_title($category['category_name'], '-', true)) ?>">
                                        <?= esc($category['category_name']) ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
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
        <section class="book-details">
            <div class="book-cover">
                <img src="/uploads/<?= esc($buku['cover_image']) ?>" alt="<?= esc($buku['title']) ?>" class="buku-img">
                <div class="book-actions">
                    <a href="/buku/edit/<?= $buku['book_id']; ?>">
                        <span style="border: none;" class="material-symbols-outlined">edit</span>
                    </a>
                    <button onclick="confirmDelete(<?= esc($buku['book_id']) ?>)">
                        <span style="border: none;" class="material-symbols-outlined">delete</span>
                    </button>
                </div>
            </div>
            <div class="book-info">
                <h1 class="title"><?= esc($buku['title']) ?></h1>
                <h3 class="author"><?= esc($buku['publisher_name']) ?></h3>
                <p class="description">
                    <?= esc($buku['description']) ?>
                </p>
            </div>
        </section>
    </main>
    <footer>
        ©2024 PT. Byte Back
    </footer>

    <script src="<?= base_url('js/script.s') ?>"></script>
</body>

</html>