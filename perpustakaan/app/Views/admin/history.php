<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Peminjaman</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="<?= base_url('css/history.css') ?>">
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
    <h1 style="font-size: 40px; color: #7469B6;" class="italic">Riwayat Peminjaman Semua Pengguna</h1>

    <table>
        <thead>
            <tr>
                <th>Email Pengguna</th>
                <th>Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Aksi</th>
<!-- Kolom untuk aksi -->
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($borrowings)): ?>
                <?php foreach ($borrowings as $borrowing): ?>
                    <tr>
                        <td><?= $borrowing['user_email'] ?></td>
                        <td><?= $borrowing['book_title'] ?></td>
                        <td><?= $borrowing['borrow_date'] ?></td>
                        <td>
                            <?= $borrowing['return_date'] ? $borrowing['return_date'] : 'Belum dikembalikan' ?>
                        </td>
                        <td>
                            <?php if (!$borrowing['return_date']): ?>
                                <a href="/borrowings/return/<?= $borrowing['id'] ?>">Kembalikan</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" style="text-align: center;">Belum ada riwayat peminjaman.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</main>
<footer>
        ©2024 PT. Byte Back
    </footer>
</body>

</html>
