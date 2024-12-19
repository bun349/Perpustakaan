<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <link rel="stylesheet" href="<?= base_url('css/login.css') ?>">
</head>

<body>
    <div class="login-container">
        <h2>LOGIN</h2>
        <form action="/login" method="post">

            <div class="form-group">
                <label for="identifier">Username atau Email:</label>
                <input type="text" placeholder="Masukkan username atau email" name="identifier" id="identifier" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label> <br>
                <input type="password" id="password" placeholder="Masukkan password" name="password" required>
            </div>

            <div class="form-group remember-me">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Remember Me</label>
            </div>

            <button type="submit">Masuk</button>
        </form>

        <p>Belum punya akun? <a href="/register">Daftar di sini</a></p>


        <?php if (session()->getFlashdata('error')): ?>
            <p class="error"><?= session()->getFlashdata('error') ?></p>
        <?php endif; ?>

    </div>


    <script>
        <?php if (session()->getFlashdata('success')): ?>
            alert('<?= session()->getFlashdata('success') ?>');
        <?php endif; ?>
    </script>
</body>

</html>