<?php 
    // Initialisation de la connection à false
    $state_connect = false;
    // On inclus différents fichiers
    require_once 'includes/connect.inc.php'; 
    require_once 'includes/header.inc.php';
    require_once 'libs/Smarty.class.php'; 
    // Création d'un objet smarty
    $smarty = new Smarty();
    // Démarrage de la session
    session_start();
    
    // Appel des variables par POST
    $pseudo = "";
    if (isset($_POST['pseudo']))
        $pseudo = $_POST['pseudo'];
    $mail = "";
    if (isset($_POST['mail']))
        $mail = $_POST['mail'] . '@' . $_POST['fin_mail'];
    $contenu = "";
    if (isset($_POST['contenu']))
        $contenu = $_POST['contenu'];
    $id_article_com = "";
    if (isset($_POST['id_article']))
        $id_article_com = $_POST['id_article'];
    
    // Création de la date
    $date = "";
    $date = date("Y") . '-' . date("m") . '-' . date("d") . ' ' . date("H") . ':' . date("i") . ':' . date("s");
    
    // Si le pseudo, le mail et le contenu ne sont pas vides
    if ($pseudo != "" && $mail != "" && $contenu != "") 
    {
        // Requête d'ajout d'un commentaire
        $req = "INSERT INTO `commentaire`(`id_commentaire`, `id_article`, `pseudo`, `mail`, `contenu`, `date`) VALUES ('','$id_article_com','$pseudo','$mail','$contenu','$date')";
        // Envoi de la requête
        mysql_query($req);
        // Redirection vers la page du commentaire
        header("Location:commentaire.php?id_article=$id_article_com");
    }
    // Récupération de l'id de l'article
    $id_article = ($_GET['id_article']);
    // Requête d'obtention d'un article
    $sql_article = "SELECT id_article, contenu, titre, DATE_FORMAT(date,\"%d/%m/%y à %HH%i\") as date FROM article WHERE article.id_article=$id_article ORDER BY article.date";
    // Envoi de la requête
    $req = mysql_query($sql_article);
    // Ajout des données dans un tableau
    $data_article = mysql_fetch_array($req);
    // Extraction des données du tableau
    extract($data_article);
    // Requête d'obtention d'un commentaire
    $sql_com = "SELECT  commentaire.pseudo, commentaire.contenu, DATE_FORMAT(commentaire.date,\"%d/%m/%y à %HH%i\") as date FROM article INNER JOIN commentaire ON article.id_article = commentaire.id_article WHERE article.id_article =$id_article ORDER BY commentaire.date DESC";
    // Envoi de la requête
    $requete = mysql_query($sql_com);
    // Création d'un tableau
    $data_tab = array();
    // Ajout des données dans le tableau tant qu'il y en a
    while ($ligne = mysql_fetch_array($requete)) 
        $data_tab[] = $ligne;
    $reponseid = $_GET['id_article'];
    // Envoi des données vers le template
    $smarty->assign("reponseid",$reponseid);
    $smarty->assign("data_tab",$data_tab);
    $smarty->assign("data_article",$data_article);
    // Appel du template
    $smarty->display('template/commentaire.tpl');
    include_once 'includes/menu.inc.php';
    include_once 'includes/footer.inc.php';      
?>

