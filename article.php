<?php
    // Statut de connection à false
    $state_connect = false;
    // On inclus différents fichiers
    require_once 'includes/connect.inc.php'; 
    require_once 'libs/Smarty.class.php'; 
    // Création d'un objet smarty
    $smarty = new Smarty();
    // Démarrage de la session
    session_start();
    // Si nous sommes pas connecté et le cookie différent de null
    if (empty($_SESSION['admin']) && !isset($_COOKIE['cookie'])) 
    {
        // Redirection vers la page d'accueil
        header('Location: index.php');
        exit();
    }
    // Si on choisi de créer ou de modifier un article
    if (isset($_POST['Ajouter']) || isset($_POST['Modifier'])) 
    {
        // Appel des variables par POST
        $titre = "";
        if (isset($_POST['titre']))
            $titre = $_POST['titre'];
        $texte = "";
        if (isset($_POST['contenu']))
            $texte = $_POST['contenu'];
        if (!empty($_POST['$image'])) 
            $erreur_image = $_FILES['image']['error'];
        else
            $erreur_image = "";
        $statut = "";
        $statut = (isset($_POST['statut'])) ? true : false;
        // Création de la date
        $date = "";
        $date = date("Y") . '-' . date("m") . '-' . date("d") . ' ' . date("H") . ':' . date("i") . ':' . date("s");
        // Si il n'y à pas d'erreur image
        if (empty($erreur_image)) 
        {
            // Si le titre et le contenu ne sont pas vide
            if ($titre != "" && $texte != "") 
            {
                // On récupère l'id de l'article pour la modification
                $id_article = ($_POST['id']);
                // Si il n'y a pas un id pour l'article, nous sommes dans le cas d'un ajout d'un article
                if (empty($id_article)) 
                {
                    // Requête d'ajout d'un article
                    $req = "INSERT INTO `article`(`id_article`, `titre`, `contenu`, `date`, `statut`) VALUES ('','$titre','$texte','$date','$statut')";
                    // Envoi de la requête
                    mysql_query($req);
                    // Retourne le dernier identifiant généré
                    $id = mysql_insert_id();
                } 
                // Modification de l'article selectionne
                else 
                {
                    // Requête de modification d'un article
                    $req = "UPDATE `article` SET `id_article`='$id_article',`titre`='$titre',`contenu`='$texte',`date`='$date',`statut`='$statut' WHERE id_article='$id_article'";
                    // Envoi de la requête
                    mysql_query($req);
                    // Retourne le dernier identifiant généré
                    $id = $id_article;
                }
                // Déplacement de l'image choisi et renommage avec l'id de l'article modifié ou créé
                move_uploaded_file($_FILES['image']['tmp_name'], dirname(__FILE__) . "/img/$id.jpg");
                // Redirection vers la page d'accueil
                header("Refresh: 1;URL=index.php");
            }
        } 
    } 
    // Cas de suppression de l'article
    elseif (isset($_GET['delete_article'])) 
    {
        // Récupération de l'id de l'article à supprimer
        $id = $_GET['delete_article'];
        // Requête de suppression d'un article
        $sql = "DELETE FROM article WHERE article.id_article = $id";
        // Envoi de la requête
        $requete = mysql_query($sql);
        // Redirection vers la page d'accueil
        header('Location:index.php');
    }
    else 
    {
        // Si l'id de l'article n'est pas vide
        if (isset($_GET['id_article'])) 
        {
            // Récupération de l'id de l'article
            $id = $_GET['id_article'];
            // Requête d'obtention d'un article
            $sql = "SELECT id_article, contenu, titre, statut, DATE_FORMAT(date,\"%d/%m/%y à %HH%i\") as date FROM article WHERE article.id_article = $id";
            // Envoi de la requête
            $requete = mysql_query($sql);
            // Retourne un tableau avec les valeurs de la requête
            $reponse = mysql_fetch_array($requete);
            // Extraction des résultats dans le tableau
            extract($reponse);
        } 
        // Sinon
        else
            // Création d'un tableau avec les valeurs vides
            $reponse = array("id_article" => NULL, "titre" => "", "contenu" => "", "date" => "", "statut" => "");
        // $action_label qui permet de modifier un label du template
        $action_label = (!empty($_GET['id_article'])) ? 'Modifier' : 'Ajouter';
        include_once 'includes/header.inc.php';
        // Envoi des données de la base vers le template
        $reponsetitre = $reponse['titre'];
        $smarty->assign("reponsetitre",$reponsetitre);
        $reponsecontenu = $reponse['contenu'];
        $smarty->assign("reponsecontenu",$reponsecontenu);
        $reponsestatut = $reponse['statut'];
        $smarty->assign("reponsestatut",$reponsestatut);
        $reponseidarticle = $reponse['id_article'];
        $smarty->assign("reponseidarticle",$reponseidarticle);
        $action_label = $action_label;
        $smarty->assign("action_label",$action_label);
        // Affichage du template
        $smarty->display('template/article.tpl');
        include_once 'includes/menu.inc.php'; 
        include_once 'includes/footer.inc.php';
    }
?>







