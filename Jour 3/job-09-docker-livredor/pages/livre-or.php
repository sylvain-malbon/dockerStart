<?php
require_once '../config/config.php';
session_start();

// Message de succès après ajout de commentaire
if (!empty($_GET['success'])) {
    $success = "Votre commentaire a été publié avec succès !";
}

// Récupérer tous les commentaires avec les informations des utilisateurs
// Organisés du plus récent au plus ancien
$stmt = $pdo->query("
    SELECT 
        c.id,
        c.commentaire,
        c.date,
        u.login
    FROM commentaires c
    INNER JOIN utilisateurs u ON c.id_utilisateur = u.id
    ORDER BY c.date DESC
");
$commentaires = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livre d'or</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Lato:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Grenze+Gotisch:wght@100..900&display=swap" rel="stylesheet">
</head>

<body>

    <?php include_once '../includes/header.php'; ?>

    <main>
        <div class="livredor-page">

            <div class="livredor-margin">

                <h1>Livre d'or</h1>

                <?php if (isset($_SESSION['user_id'])): ?>
                    <p class="form-catchphrase">Bienvenue <?= htmlspecialchars($_SESSION['login']) ?> !</p>
                    <p><a class="array-top" href='commentaire.php'>Laissez un commentaire</a>
                    <?php else: ?>
                    <p class="form-catchphrase">Pour laisser un commentaire</p>
                    <span>
                        <a class="array-top" href='inscription.php'>Inscrivez-vous</a>
                        ou
                        <a class="array-top" href='connexion.php'>Connectez-vous</a>
                    </span>
                <?php endif; ?>

                <!-- début PHP-->

                <?php if (!empty($success)): ?>
                    <p style="color:green; margin: 1rem 0;"><?= htmlspecialchars($success) ?></p>
                <?php endif; ?>

                <!-- fin PHP-->

                <section class="livredor">
                    <div class="livredor-array">

                        <div class="array-group">
                            <?php if (empty($commentaires)): ?>
                                <p style="margin: 2rem 0;">Aucun commentaire pour le moment. Soyez le premier à partager votre avis avec nous !</p>
                            <?php else: ?>
                                <?php foreach ($commentaires as $comment): ?>
                                    <div class="commentaire-item">
                                        <p class="commentaire-info">
                                            Posté le
                                            <?= date('d.m.Y', strtotime($comment['date'])) ?>
                                            à
                                            <?= date('H:i', strtotime($comment['date'])) ?>
                                            par
                                            <?= htmlspecialchars($comment['login']) ?>
                                        </p>
                                        <p class="commentaire-text">
                                            <?= nl2br(htmlspecialchars($comment['commentaire'])) ?>
                                        </p>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>

                        </div>
                </section>

            </div>

        </div>
    </main>

    <?php include_once '../includes/footer.php'; ?>

</body>

</html>