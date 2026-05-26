<?php
require_once '../config/config.php';
session_start();

// Message de succès après inscription
if (!empty($_GET['success'])) {
    $success = "Inscription réussie ! Vous pouvez vous connecter.";
}

// Traitement du formulaire de connexion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login']);
    $password = $_POST['password'];

    if (empty($login) || empty($password)) {
        $error = "Tous les champs sont obligatoires.";
    } else {
        // Vérifier si l'utilisateur existe
        $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE login = :login");
        $stmt->execute([':login' => $login]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // Connexion réussie → on stocke l'utilisateur en session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['login'] = $user['login'];

            // Redirection vers la page d'accueil ou livre d'or
            header("Location: ../index.php");
            exit;
        } else {
            $error = "Nom d'utilisateur ou mot de passe incorrect.";
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
        <div class="login-form-page">

            <h1>Connexion</h1>
            <p class="form-catchphrase">Connectez-vous pour laisser un commentaire</p>

            <section class="login-form">
                <div class="form-content">


                    <!-- début PHP -->

                    <?php if (!empty($success)): ?>
                        <p style="color:green;"><?= htmlspecialchars($success) ?></p>
                    <?php endif; ?>

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
                                id="login"
                                name="login"
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

                        <button type="submit" class="form-button">
                            Se connecter
                        </button>
                    </form>

                </div>
            </section>

            <p class="form-bottom">Vous n'avez pas encore de compte ?</p>
            <p class="form-bottom"><a href="inscription.php">Inscrivez-vous</a></p>

        </div>
    </main>

    <?php include_once '../includes/footer.php'; ?>

</body>