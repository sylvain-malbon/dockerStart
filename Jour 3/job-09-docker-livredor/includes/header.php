<header class="header">

    <nav class="header-navbar">
        <a href="<?= BASE_PATH ?>index.php" class="logo" title="Accueil">
            <img src="<?= BASE_PATH ?>assets/images/logo_livre-or.png" alt="Logo du site">
        </a>

        <!-- EFFET PROFONDEUR : ajout d'une bande derrière le logo  -->
        <div class="logo-back"></div>

        <ul class="nav-list">

            <?php if (isset($_SESSION['login'])) : ?>
                <li><a href="<?= BASE_PATH ?>index.php" title="accueil"><span class="initiale">A</span>ccueil</a></li>
                <li class="separateur">|</li>
                <li><a href="<?= BASE_PATH ?>pages/profil.php" title="profil">
                        <span class="initiale">P</span>rofil utilisateur
                    </a></li>
                <li class="separateur">|</li>
                <li><a href="<?= BASE_PATH ?>pages/commentaire.php" title="commenter"><span class="initiale">L</span>aisser un commentaire</a></li>
                <li class="separateur">|</li>
                <li><a href="<?= BASE_PATH ?>pages/livre-or.php" title="livre d'or"><span class="initiale">C</span>onsulter le <span class="logotype">Livre d'or<span></a></li>
                <li class="separateur">|</li>
                <li><a href="<?= BASE_PATH ?>pages/deconnexion.php" title="déconnexion"><span class="initiale">D</span>éconnexion</a></li>
            <?php else : ?>
                <li><a href="<?= BASE_PATH ?>index.php" title="accueil"><span class="initiale">A</span>ccueil</a></li>
                <li class="separateur">|</li>
                <li><a href="<?= BASE_PATH ?>pages/inscription.php" title="register"><span class="initiale">S</span><span class="apostrophe">'</span>inscrire pour commenter</a></li>
                <li class="separateur">|</li>
                <li><a href="<?= BASE_PATH ?>pages/livre-or.php" title="livre d'or"><span class="initiale">C</span>onsulter le <span class="logotype">Livre d'or<span></a></li>
                <li class="separateur">|</li>
                <li><a href="<?= BASE_PATH ?>pages/connexion.php" title="connexion"><span class="initiale">S</span>e connecter</a></li>
            <?php endif; ?>

        </ul>

    </nav>

</header>