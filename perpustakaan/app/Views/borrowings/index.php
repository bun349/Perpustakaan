<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Peminjaman</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="<?= base_url('css/pinjam.css') ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <!-- Font Style-->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Po
    ppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <div class="container">
            <div class="logo">
                <a href="/" class="italic">Buku.com</a>
            </div>

            <nav>
                <ul>
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
    <h1>Daftar Buku</h1>
    <section>
        <div class="book-row">
            <?php if (!empty($books)): ?>
                <?php foreach ($books as $book): ?>
                    <div class="book">
                    <img src="/uploads/<?= esc($book['cover_image']) ?>" alt="<?= esc($book['title']) ?>" class="buku-img">
                        <p class="title"><?= $book['title'] ?></p>
                        <a href="/borrowings/borrow/<?= $book['book_id'] ?>/<?= session()->get('user_id') ?>">Pinjam</a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Tidak ada buku yang tersedia.</p>
            <?php endif; ?>
        </div>
    </section>
</main>
    <footer>
        ©2024 PT. Byte Back
    </footer>
</body>

</html>