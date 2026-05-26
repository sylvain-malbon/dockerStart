<?php
require_once '../config/config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['name']);
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    // Vérification basique
    if (empty($login) || empty($password) || empty($password_confirm)) {
        $error = "Tous les champs sont obligatoires.";
    } elseif ($password !== $password_confirm) {
        $error = "Les mots de passe ne correspondent pas.";
    } else {
        // Hash du mot de passe
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insertion dans la table utilisateurs
        $stmt = $pdo->prepare("INSERT INTO utilisateurs (login, password) VALUES (:login, :password)");
        try {
            $stmt->execute([
                ':login' => $login,
                ':password' => $hashedPassword
            ]);
            header("Location: connexion.php?success=1");
            exit;
        } catch (PDOException $e) {
            // Gestion d'erreur (par ex. login déjà existant)
            $error = "Erreur lors de l'inscription : " . $e->getMessage();
        }
    }
}
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
        <div class="register-form-page">

            <h1>Inscription</h1>
            <p class="form-catchphrase">Inscrivez-vous pour laisser un commentaire</p>

            <section class="register-form">
                <div class="form-content">

                    <!-- début PHP -->

                    <?php if (!empty($error)): ?>
                        <p style="color:red;"><?= htmlspecialchars($error) ?></p>
                    <?php endif; ?>

                    <!-- fin PHP -->

                    <form method="POST" class="form" action="">
                        <input type="hidden" name="" value="">

                        <div class="form-group">
                            <label for="">Nom d'utilisateur</label>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                required
                                value="<?= isset($login) ? htmlspecialchars($login) : '' ?>"
                                placeholder="Votre nom d'utilisateur">
                        </div>

                        <div class="form-group">
                            <label for="password">Mot de passe</label>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                required
                                placeholder="Votre mot de passe">
                        </div>

                        <div class="form-group">
                            <label for="password">Confirmation du mot de passe</label>
                            <input
                                type="password"
                                id="password_confirm"
                                name="password_confirm"
                                required
                                placeholder="Votre mot de passe">
                        </div>

                        <button type="submit" class="form-button">
                            S'inscrire
                        </button>
                    </form>

                </div>
            </section>

            <p class="form-bottom">Vous avez déjà un compte ?</p>
            <p class="form-bottom"><a href="connexion.php">Connectez-vous</a></p>

        </div>
    </main>

    <?php include_once '../includes/footer.php'; ?>

</body>