<?php require_once 'includes/connect.inc.php'; ?>
<nav class="span4">
    <div class="page-header well">
        <h3>Menu</h3>
            <!-- Formulaire qui permet de rechercher un mot dans un article ou le titre -->
            <form name="search" action="index.php" method="GET">
                <input type="search" name="rechercher" placeholder="Entrez votre recherche"><br>
                <input type="submit" value="Rechercher" class='btn btn-large '/>
            </form>
        <ul>
            <!-- Différents bouton du menu -->
            <li><a href="index.php">Accueil</a></li>
            <?php
                // Cas de connexion par cookie ou session
                if(isset($_SESSION['admin']) || $state_connect==true ) 
                {
            ?>
            <li><a href="article.php">Rédiger un article</a></li>
            <li><a href="deconnection.php">Déconnexion</a></li><br>
            <?php
                }
                // Cas non connecté au site
                else { 
            ?>
            <li><a href="connect.php">Se connecter</a></li>
            <?php
                }
            ?>
        </ul>
    </div>
</nav>