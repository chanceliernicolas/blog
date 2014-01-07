<head>
    <!-- On fait appel au script de la page formulaire.js -->
    <script type="text/javascript" src="js/formulaire.js"></script>
</head>
<div class="span8">
    <center><h3>Page connexion</H3></center>
    <div class="page-header well">
        <center> 
            <!-- Formulaire de connection -->
            <form name="connection" method="POST" enctype="multipart/form-data" action="">       
                <b> Nom d'utilisateur : </b><br>
                <!-- Champ de saisie du login -->
                <input type="text" name="login" value=""/>
                <!-- Si un champ est vide un message en rouge apparait -->
                <erreur style="display: none; color:red;">champs obligatoire</erreur>
                <br><b> Mot de Passe : </b><br>
                <!-- Champ de saisie du mot de passe -->
                <input type="password" name="mdp" value=""/>
                <!-- Si un champ est vide un message en rouge apparait -->
                <erreur style="display: none;color:red;">champs obligatoire</erreur>
                <br><b> Resté connecter : </b><br>
                <!-- Checkbox qui perme de reste connecte -->
                <input type="checkbox" name="cookie" value="" /><br><br>
                <!-- Bouton de soumission -->
                <input type="submit" value="Connexion"  name="connexion" class='btn btn-large' onsubmit=""/>       
            </form>
        </center> 
    </div>
</div>