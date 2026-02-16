<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image - Photo-Share</title>
    <link rel="stylesheet" href="/assets/css/styles.css">
</head>

<body>
    <header>
        <div class="container">
            <nav>
                <a href="index.html" class="logo">Photo-Share</a>
                <ul class="menu">
                    <li><a href="/api/images">Accueil</a></li>
                    <li><a href="/uploader">Upload</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <?php if ($image != null) { ?>
            <section class="product-detail">
                <img src="<?= $image['path'] ?>" width="300" alt="<?= $image['description'] ?>">
                <div class="info">
                    <p><?= $image['description'] ?></p>
                </div>
            </section>
        <?php } ?>
    </main>

    <footer>
        <p>&copy; 2025 Photo-Share</p>
    </footer>
</body>

</html>