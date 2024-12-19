<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="<?= base_url('css/home.css') ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <!-- Font Style-->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
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
                </span>
            </div>

        </div>
    </header>

    <main>
        <!-- Welcome Section -->
        <div class="welcome-section poppins-medium">
            Selamat Datang, <?= esc(session()->get('username')) ?> di Buku.com !
        </div>

        <!-- Carousel -->
        <div class="carousel">
            <img src="/image/library.jpg" alt="Carousel Image">
        </div>

        <!-- Grid Layout for additional blocks -->
        <div class="grid2">
            <div class="grid-item">
                <a href="/borrowings" class="button-link"> Pinjam</a>
            </div>
            <div class="grid-item">
                <a href="/borrowings/history/" class="button-link">History</a>
            </div>
        </div>

        <!-- Books of the month Section -->
        <div class="book-section">
            <div class="section-title">Books of the month</div>
            <div class="book-row">
                <div class="book">
                    <img src="/image/bumi-manusia.jpg" alt="Book Cover" class="buku-img">
                    <h4 class="title">Bumi Manusia</h4>
                    <p class="author">Pramoedya Ananta Toer</p>
                </div>
                <div class="book">
                    <img src="/image/davidandgoliath.jpg" alt="Book Cover" class="buku-img">
                    <h4 class="title">David and Goliath</h4>
                    <p class="author">Malcolm Gladwell</p>
                </div>
                <div class="book">
                    <img src="/image/tuesday-with-morrie.jpg" alt="Book Cover" class="buku-img">
                    <h4 class="title">Tuesdays With Morrie</h4>
                    <p class="author">Mitch Albom</p>
                </div>
                <div class="book">
                    <img src="/image/mockingbirs.jpg" alt="Book Cover" class="buku-img">
                    <h4 class="title">To Kill A Mockingbird</h4>
                    <p class="author">J.B. Lippincott & Co.</p>
                </div>
                <div class="book">
                    <img src="/image/gatsby.jpg" alt="Book Cover" class="buku-img">
                    <h4 class="title">The Great Gatsby</h4>
                    <p class="author">Scribnerl</p>
                </div>
                <div class="book">
                    <img src="/image/gatsby.jpg" alt="Book Cover" class="buku-img">
                    <h4 class="title">The Great Gatsby</h4>
                    <p class="author">Scribnerl</p>
                </div>

            </div>
        </div>

        <!-- Buku Rekomendasi Section -->
        <div class="book-section">
            <div class="section-title">Buku Rekomendasi</div>
            <div class="book-row">
                <div class="book">
                    <img src="/image/bumi-manusia.jpg" alt="Book Cover" class="buku-img">
                    <h4 class="title">Bumi Manusia</h4>
                    <p class="author">Pramoedya Ananta Toer</p>
                </div>
                <div class="book">
                    <img src="/image/davidandgoliath.jpg" alt="Book Cover" class="buku-img">
                    <h4 class="title">David and Goliath</h4>
                    <p class="author">Malcolm Gladwell</p>
                </div>
                <div class="book">
                    <img src="/image/tuesday-with-morrie.jpg" alt="Book Cover" class="buku-img">
                    <h4 class="title">Tuesdays With Morrie</h4>
                    <p class="author">Mitch Albom</p>
                </div>
                <div class="book">
                    <img src="/image/mockingbirs.jpg" alt="Book Cover" class="buku-img">
                    <h4 class="title">To Kill A Mockingbird</h4>
                    <p class="author">J.B. Lippincott & Co.</p>
                </div>
                <div class="book">
                    <img src="/image/gatsby.jpg" alt="Book Cover" class="buku-img">
                    <h4 class="title">The Great Gatsby</h4>
                    <p class="author">Scribnerl</p>
                </div>
                <div class="book">
                    <img src="/image/gatsby.jpg" alt="Book Cover" class="buku-img">
                    <h4 class="title">The Great Gatsby</h4>
                    <p class="author">Scribnerl</p>
                </div>

            </div>
        </div>

    </main>
    <footer>
        ©2024 PT. Byte Back
    </footer>
    <script>
        <?php if (session()->getFlashdata('message')): ?>
            alert('<?= session()->getFlashdata('message') ?>');
        <?php endif; ?>
    </script>

    <script src="<?= base_url('js/script.s') ?>"></script>
</body>

</html>