<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku Baru</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="<?= base_url('css/create.css') ?>">
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
        <div class="wrapper">
            <div class="containerBuku">
                <h1>Tambah Buku Baru</h1>
                <br>
                <?php if (session()->getFlashdata('errors')): ?>
                    <div class="error-messages">
                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                            <p><?= esc($error) ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('/buku/store') ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>

                    <div class="form-group">
                        <label for="title">Judul:</label>
                        <input type="text" id="title" name="title" value="<?= old('title') ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="publisher_name">Publisher:</label>
                        <input type="text" id="publisher_name" name="publisher_name" value="<?= old('publisher_name') ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Deskripsi:</label>
                        <textarea id="description" name="description" rows="4" required><?= old('description') ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="cover_image">Gambar:</label>
                        <input type="file" id="cover_image" name="cover_image" accept="image/*" required>
                    </div>

                    <!-- Dropdown untuk memilih kategori -->
                    <div class="form-group">
                        <label for="category_id">Kategori:</label>
                        <select id="category_id" name="category_id" required>
                            <option value="">Pilih Kategori</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= esc($category['category_id']) ?>" <?= old('category_id') == $category['category_id'] ? 'selected' : '' ?>>
                                    <?= esc($category['category_name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <br>

                    <button type="submit" class="submit-btn">Simpan Buku</button>
                </form>

                <a href="<?= base_url('/kategori') ?>" class="back-link">Kembali ke Daftar Buku</a>
            </div>
        </div>
    </main>
    <footer>
        ©2024 PT. Byte Back
    </footer>
</body>

</html>
