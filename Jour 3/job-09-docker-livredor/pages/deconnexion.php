<?php
session_start();      // on démarre la session
session_unset();      // supprime toutes les variables de session
session_destroy();    // détruit la session

// Redirection vers l'accueil
header("Location: ../index.php?logout=1");
exit;
