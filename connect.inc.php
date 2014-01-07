<?php
    // Connection à la base de données
    mysql_connect("mysql.fr", "blog", "blog") or die("Impossible de se connecter : " . mysql_error());
    // Selection de la base de données
    mysql_select_db("blog");
    
    // Si on décide de se connecter en cookie
    if (isset($_COOKIE['cookie'])) {
        // On récupère la valeur du cookie posté
        $moncookie = $_COOKIE['cookie'];
        // Requête du cookie dans la base
        $requete = "SELECT * FROM login WHERE cookie='$moncookie'";
        // Envoi de la requête
        $result = mysql_query($requete) or die('Erreur SQL !<br />' . $sql . '<br />' . mysql_error());
        // Ajout des données dans un tableau
        $reponse = mysql_fetch_array($result);
        // Extraction du tableau
        extract($reponse);
        if ($moncookie == $reponse['cookie']) {
            $state_connect = true;
        }
    }
?>
