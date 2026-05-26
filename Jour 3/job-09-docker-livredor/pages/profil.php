<?php
require_once '../config/config.php';
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    // Rediriger vers la page de connexion si non connecté
    header("Location: connexion.php");
    exit;
}

// Récupérer les informations actuelles de l'utilisateur
$stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE id = :id");
$stmt->execute([':id' => $_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Traitement du formulaire de modification
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($login)) {
        $error = "Le nom d'utilisateur est obligatoire.";
    } elseif (!empty($password) && $password !== $confirm_password) {
        $error = "Les mots de passe ne correspondent pas.";
    } else {
        // Vérifier si le login est déjà utilisé par un autre utilisateur
        $stmt = $pdo->prepare("SELECT id FROM utilisateurs WHERE login = :login AND id != :id");
        $stmt->execute([':login' => $login, ':id' => $_SESSION['user_id']]);

        if ($stmt->fetch()) {
            $error = "Ce nom d'utilisateur est déjà utilisé.";
        } else {
            // Préparer la requête de mise à jour
            if (!empty($password)) {
                // Mise à jour avec nouveau mot de passe
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare("UPDATE utilisateurs SET login = :login, password = :password WHERE id = :id");
                $result = $stmt->execute([
                    ':login' => $login,
                    ':password' => $hashed_password,
                    ':id' => $_SESSION['user_id']
                ]);
            } else {
                // Mise à jour uniquement du login
                $stmt = $pdo->prepare("UPDATE utilisateurs SET login = :login WHERE id = :id");
                $result = $stmt->execute([
                    ':login' => $login,
                    ':id' => $_SESSION['user_id']
                ]);
            }

            if ($result) {
                // Mettre à jour la session
                $_SESSION['login'] = $login;
                $success = "Votre profil a été mis à jour avec succès !";
                // Recharger les informations de l'utilisateur
                $user['login'] = $login;
            } else {
                $error = "Une erreur est survenue lors de la mise à jour.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon profil - Livre d'or</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Lato:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Grenze+Gotisch:wght@100..900&display=swap" rel="stylesheet">
</head>

<body>

    <?php include_once '../includes/header.php'; ?>

    <main>
        <div class="profile-form-page">

            <h1>Profil utilisateur</h1>
            <p class="form-catchphrase">Vous pouvez modifier vos informations personnelles ici</p>

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

                        <div class="form-group">
                            <label for="login">Nom d'utilisateur</label>
                            <input
                                type="text"
                                id="login"
                                name="login"
                                required
                                value="<?= htmlspecialchars($user['login']) ?>"
                                placeholder="Votre nom d'utilisateur">
                        </div>

                        <div class="form-group">
                            <label for="password">Nouveau mot de passe (optionnel)</label>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                placeholder="Laissez vide pour ne pas changer">
                        </div>

                        <div class="form-group">
                            <label for="confirm_password">Confirmation du nouveau mot de passe</label>
                            <input
                                type="password"
                                id="confirm_password"
                                name="confirm_password"
                                placeholder="Confirmez votre nouveau mot de passe">
                        </div>

                        <button type="submit" class="form-button">
                            Mettre à jour
                        </button>
                    </form>

                </div>
            </section>

        </div>
    </main>

    <?php include_once '../includes/footer.php'; ?>

</body>

</html>