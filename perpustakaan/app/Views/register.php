<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="<?= base_url('css/sign.css') ?>">
</head>

<body>
    <div class="sign-container">
        <h2>SIGN-UP</h2>
        <form action="/register" method="post">

            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" placeholder="Masukkan username" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" placeholder="Masukkan email" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" placeholder="Masukkan password baru" name="password" required>
            </div>

            <div class="form-group">
                <label for="confirm_password">Konfirmasi Password:</label>
                <input type="password" id="confirm_password" placeholder="Masukkan password ulang" name="confirm_password" required>
            </div>

            <button type="submit">Register</button>
        </form>

        <?php if (session()->getFlashdata('errors')): ?>
            <ul class="errors">
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
    <script src="<?= base_url('js/script.js') ?>"></script>
</body>

</html>