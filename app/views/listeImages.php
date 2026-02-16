<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Photo-Share</title>
    <link rel="stylesheet" href="/assets/css/styles.css">
</head>

<body>
    <header>
        <div class="container">
            <nav>
                <a href="/" class="logo">Photo-Share</a>
                <ul class="menu">
                    <li><a href="/api/images">Accueil</a></li>
                    <li><a href="/uploader">Upload</a></li>
                </ul>
            </nav>
        </div>
    </header>



    <main>
        <h1>Bienvenue sur notre gallerie photo</h1>
        <section class="product-list">
            <?php
            if ($images != null) {
                foreach ($images as $image) { ?>
                    <article class="product-card">
                        <a href="/api/images/<?= $image['id'] ?>">
                            <img src="<?= $image['path'] ?>" alt="<?= $image['description'] ?>">
                        </a>
                    </article>
                <?php }
            } else { ?>
                <h3>Aucune images a afficher pour l'instant</h3>
            <?php }
            ?>

        </section>
    </main>
    <footer>
        <p>&copy; 2025 Photo-Share</p>
    </footer>
</body>

</html>