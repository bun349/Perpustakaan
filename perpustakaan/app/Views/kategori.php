<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="<?= base_url('css/kategori.css') ?>">
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
        <section>
            <br>
            <p style="font-size: 54px; margin-left:30px;" class="italic">
                <!-- Judul kategori atau Semua Kategori -->
                Kategori - <?= esc($categoryName) ?>
                
                <?php if ($categoryName == 'Semua Kategori'): ?>
                    <!-- Menampilkan total buku untuk setiap kategori -->
                    <span style="font-size: 24px; font-weight: normal;">
                        <!-- Tampilkan total semua buku -->
                         (<?= esc($totalBooks) ?>)
                    </span>
                <?php else: ?>
                    <!-- Menampilkan total buku hanya untuk kategori tertentu -->
                    <?php foreach ($bookCounts as $count): ?>
                        <?php if (esc($count['category_name']) == $categoryName): ?>
                            <span style="font-size: 24px; font-weight: normal;">
                                (<?= esc($count['total_books']) ?>)
                            </span>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </p>

            <br>
            <div class="book-row">
                <?php if (empty($books)): ?>
                    <p id="noResultsMessage" style="text-align: center; font-size: 20px; font-weight: bold; color: red;">
                        No books found
                    </p>
                <?php else: ?>
                    <?php foreach ($books as $item): ?>
                        <div class="book">
                            <img src="/uploads/<?= esc($item['cover_image']) ?>" alt="<?= esc($item['title']) ?>" class="buku-img">
                            <h4 class="title"><a href="/buku/detail/<?= esc($item['book_id']) ?>"><?= esc($item['title']) ?></a></h4>
                            <p class="author"><?= esc($item['publisher_name']) ?></p>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <br><br>
            <p id="noResultsMessage" style="display: none; text-align: center; font-size: 20px; font-weight: bold; color: red;">
                No books found
            </p>
        </section>
    </main>
    <footer>
        ©2024 PT. Byte Back
    </footer>
    <script src="<?= base_url('js/script.js') ?>"></script>
</body>

</html>