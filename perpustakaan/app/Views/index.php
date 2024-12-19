<!-- File: app/Views/index.php -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Kategori</title>
    </head>

    <body>
    <div class="buku-container">
        <?php foreach ($books as $item): ?>
            <div class="buku-card">
                <img src="/uploads/<?= esc($item['cover_image']) ?>" alt="<?= esc($item['title']) ?>" class="buku-img">
                <h3><?= esc($item['title']) ?></h3>
                <p><strong>Pengarang:</strong> <?= esc($item['publisher_name']) ?></p>
                <p><?= esc($item['description']) ?></p>
            </div>
        <?php endforeach; ?>
    </div>
    </body>
</html>
