<?php
session_start();
require_once './config/config.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livre d'or</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Lato:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Grenze+Gotisch:wght@100..900&display=swap" rel="stylesheet">
</head>

<body>

    <?php include_once 'includes/header.php'; ?>

    <main>
        <section class="hero">

            <!-- Même "z-index" (calque) que la vidéo mais en dehors de la balise "video" -->
            <img src="/assets/images/hero-fallback-image_livre-or.png" alt="image livre d'or" class="hero-fallback" />

            <video autoplay muted loop playsinline class="hero-video">
                <source src="assets/videos/hero-video_livre-or.mp4" type="video/mp4" alt="vidéo livre d'or">
                Votre navigateur ne supporte pas la vidéo.
            </video>

            <div class="hero-content">

                <!-- début PHP -->

                <?php if (!empty($_GET['logout'])): ?>
                    <p style="color:green; position: absolute; top: -10rem; left: 19rem;">Vous êtes bien déconnecté.</p>
                <?php endif; ?>

                <!-- début PHP -->

                <p>
                <h2>
                    Partagez vos impressions avec d'autres utilisateurs
                </h2>
                <a href="pages/connexion.php">Laissez un commentaire</a>
                ou
                <a href="pages/livre-or.php">Consultez le livre d'or</a>
                </p>

                <h1>Bienvenue dans notre <span class="logotype">Livre d'or</span></h1>

            </div>

        </section>
    </main>

    <?php include_once 'includes/footer.php'; ?>

</body>

</html>