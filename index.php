<?php
    // Statut de connection a false
    $state_connect = false;
    require_once 'includes/connect.inc.php';
    include_once 'includes/header.inc.php';
    require_once 'libs/Smarty.class.php';
    // Démarrage de la session
    session_start();
    // Si le nombre d'article a affciché choisi par l'internaute n'est pas vide
    if(isset($_POST['nb_articles_choisi']))
        // On affiche autant d'article voulu par l'internaute
        $messagesParPage = $_POST['nb_articles_choisi'];
    // Sinon on affiche 2 article par défaut
    else
        $messagesParPage = 2;
    
    // Création d'un objet smarty
    $smarty=new Smarty();
    // Cas de la recherche
    if (isset($_GET['rechercher']))
    {
        // Récupération de la valeur a chercher
        $recherche = $_GET['rechercher'];
        // Recherche dans la base de données
        $article = mysql_query("SELECT COUNT(*) AS total FROM `article` WHERE ((`contenu` LIKE '%$recherche%' OR `titre` LIKE '%$recherche%') AND article.statut = 1)");       
    }
    else
        // On recherche dans la base le nombre total d'articles qui sont publiés
        $article = mysql_query('SELECT COUNT(*) AS total FROM `article` WHERE article.statut = 1');     
    $nb_total = mysql_fetch_array($article); // On récupère le retour de la requete
    $total = $nb_total['total']; // On récupère le total d'articles
    $nombreDePages = ceil($total / $messagesParPage); // On calcule le nombre de pages
    if (isset($_GET['page']))
    {
        $pageActuelle = intval($_GET['page']);
        if ($pageActuelle > $nombreDePages) // Si la valeur de $pageActuelle est plus grande que $nombreDePages
            $pageActuelle = $nombreDePages;
    }
    else  
        $pageActuelle = 1;
    $premierArticle = ($pageActuelle - 1) * $messagesParPage; // On calcul la numéro du premier aticle
    
    if (isset($_GET['rechercher']))
        // Requete de recherche 
        $sql = "SELECT * FROM `article` WHERE ((`contenu` LIKE '%$recherche%' OR `titre` LIKE '%$recherche%') AND article.statut = 1) LIMIT $premierArticle, $messagesParPage";
    else
        // Requete d'obtention d'un article
        $sql = "SELECT id_article, contenu, titre, DATE_FORMAT(date,\"%d/%m/%y à %HH%i\") as date FROM article WHERE article.statut = 1 ORDER BY article.date DESC LIMIT $premierArticle, $messagesParPage";
    // Envoi de la requête
    $requete = mysql_query($sql);
    // Création d'un tableau
    $data_tab = array();
    // Tant qu'il y a des données on les ajoute dans le tableau
    while ($ligne = mysql_fetch_array($requete)) 
        $data_tab[] = $ligne;
    
    // Si connecté en session
    if (!empty($_SESSION['admin']))
        // Variable a true
        $session = true;
    else
        // Sinon variable a false
        $session = false; 
    // Envoi des données vers le template
    $smarty->assign("session",$session);  
    $smarty->assign("state_connect",$state_connect);
    $smarty->assign("data_tab",$data_tab);
    $smarty->assign("nombreDePages",$nombreDePages);
    $smarty->assign("pageActuelle",$pageActuelle);
    $smarty->assign("messagesParPage",$messagesParPage);
    // Appel du template
    $smarty->display("template/index.tpl");
    
    include_once 'includes/menu.inc.php';
    include_once 'includes/footer.inc.php';
?>