<?php 
    // Initialisation de l'état de connection à null
    $state_connect = false;
    // Inclut à la page les fichier suivant
    require_once 'includes/connect.inc.php'; 
    require_once 'libs/Smarty.class.php';
    
    // Création d'un objet smarty
    $smarty = new Smarty();
    // On teste si le visiteur a soumis le formulaire de connexion
    if (isset($_POST['connexion'])) 
    {
        // On teste si les champs login et mot de passe ne sont pas vides
        if ((!empty($_POST['login'])) && !empty($_POST['mdp'])) 
        {
            // On affecte les valeurs saisies par l'utilisateur aux variables suivantes
            $login = $_POST['login'];
            $mdp = $_POST['mdp'];
            // Création de la requête pour la vérification de la bonne authentification de l'utilisateur
            $requete = "SELECT * FROM login WHERE user='$login' AND mdp=PASSWORD('$mdp')";
            // Execution de la requête ou on fait un echo de l'erreur
            $result = mysql_query($requete) or die('Erreur SQL !<br />' . $sql . '<br />' . mysql_error());
            // Ajout des valeurs de la requête dans un tableau
            $reponse = mysql_fetch_array($result);
            // On extrait une par un les valeurs qui sont dans le tableau
            extract($reponse);
            // Si on obtient une réponse, alors l'utilisateur est un membre 
            if (!empty($reponse))
            {
                // On démarre une session
                session_start();
                $_SESSION['admin'] = $login;
                // Si on choisi de se connecter en cookie
                if(isset($_POST['cookie']))
                {
                    // Variable qui définit la durée de validité du cookie
                    $temps = 15*60;  
                    // Cryptage du temps
                    $cookie = md5($reponse['user'].time());
                    $user = $reponse['user'];
                    // Création du cookie en y ajoutant le temps crypté
                    setcookie ("cookie",$cookie, time() + $temps);  
                    // Création d'une requête et execution de celle ci pour l'ajout du cookie dans la base
                    $req = "UPDATE login SET cookie='$cookie' WHERE user='$user'";
                    mysql_query($req);
                }
                else
                {
                    // Si on se connecte en session
                    // Création d'une requête et execution de celle ci pour la connection en session
                    $req = "UPDATE login SET session='0' WHERE user='$login'";
                    mysql_query($req);
                }
                // Si la connection réussi : redirection vers la page d'accueil
                header('Location: index.php');
            } 
        }
        else
        {
            // Sinon on retourne sur la page de connection
            header('Location: connect.php');
        }
    }  
    else 
    {
        // Appel des différents éléments de la page
        include_once 'includes/header.inc.php';
        // Appel du template de connexion
        $smarty->display('template/connect.tpl');
        include_once 'includes/menu.inc.php';
        include_once 'includes/footer.inc.php';      
    }
