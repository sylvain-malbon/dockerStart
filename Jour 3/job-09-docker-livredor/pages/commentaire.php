<?php
require_once '../config/config.php';
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    // Rediriger vers la page de connexion si non connecté
    header("Location: connexion.php");
    exit;
}

// Traitement du formulaire d'ajout de commentaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $commentaire = trim($_POST['commentaire']);

    if (empty($commentaire)) {
        $error = "Le commentaire ne peut pas être vide.";
    } else {
        // Insérer le commentaire dans la base de données
        $stmt = $pdo->prepare("INSERT INTO commentaires (commentaire, id_utilisateur, date) VALUES (:commentaire, :id_utilisateur, NOW())");
        $result = $stmt->execute([
            ':commentaire' => $commentaire,
            ':id_utilisateur' => $_SESSION['user_id']
        ]);

        if ($result) {
            // Redirection vers la page livre d'or après succès
            header("Location: livre-or.php?success=1");
            exit;
        } else {
            $error = "Une erreur est survenue lors de l'ajout du commentaire.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un commentaire - Livre d'or</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Lato:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Grenze+Gotisch:wght@100..900&display=swap" rel="stylesheet">
</head>

<body>

    <?php include_once '../includes/header.php'; ?>

    <main>
        <div class="comment-form-page">

            <h1>Laisser un commentaire</h1>
            <p class="form-catchphrase">Partagez votre expérience avec nous</p>

            <section class="comment-form">
                <div class="form-content">

                    <!-- début PHP -->

                    <?php if (!empty($error)): ?>
                        <p style="color:red;"><?= htmlspecialchars($error) ?></p>
                    <?php endif; ?>

                    <!-- fin PHP -->

                    <form method="POST" class="form" action="">

                        <div class="form-group">
                            <label for="commentaire">Votre commentaire</label>
                            <textarea
                                id="commentaire"
                                name="commentaire"
                                required
                                rows="6"
                                placeholder="Écrivez votre commentaire ici..."><?= isset($commentaire) ? htmlspecialchars($commentaire) : '' ?></textarea>
                        </div>

                        <button type="submit" class="form-button">
                            Publier le commentaire
                        </button>
                    </form>

                </div>
            </section>

            <p class="form-bottom"><a href="livre-or.php">Consultez le <span class="logotype">Livre d'or<span></a></p>

        </div>
    </main>

    <?php include_once '../includes/footer.php'; ?>

</body>

</html>