<head>
    <!-- On fait appel au script de la page formulaire.js -->
    <script type="text/javascript" src="js/formulaire.js"></script>
</head>
<div class="span8">
    <center><u><b><h2>L'article</H2></u></b></center>
    <div class="page-header well">
        <!-- Récupération des données transmisent par la page commentaire.php -->
        <!-- Le titre -->
        <center><h2>{$data_article['titre']}</h2><br>
        <!-- Image de l'article -->
        <img src = "img/{$data_article['id_article']}.jpg" width = "200" height = "200" alt = ""/></center>
        <!-- Contenu de l'article -->
        <br>{$data_article['contenu']}<br><br>
        <!-- Date de publication -->
        <i> Publié le : {$data_article['date']}</i>
    </div><br>
    
    <!-- Zone de commentaire -->
    <center><u><b><h2>Commentaires</H2></u></b></center>
    <div class="page-header well">
    <!-- Pour chaque données dans le tableau transmis par la page commentaire.php -->
    {foreach from=$data_tab item=data}    
        <!-- On affiche le pseudo de la personne qui a posté le commentaire -->
        <b><i>Posté par {$data['pseudo']} le {$data['date']}</b></i>
        <!-- Contenu du contenu -->
        <br><dd>|   {$data['contenu']}</dd><br>    
    {/foreach}
    </div><br>
    
    <!-- Ajout d'un commentaire -->
    <div class="page-header well">
        <center><u><b><h2>Ajouter un commentaire</H2></u></b></center>
        <form name="commentaire" method="POST" enctype="multipart/form-data" action="commentaire.php">     
            <b>Pseudo :</b><br>
            <!-- Champs de saisie pour le pseudo -->
            <input type="text" name="pseudo" value="" style="width: 240px;"/>
            <!-- Si un champ est vide un message en rouge apparait -->
            <erreur style="display: none; color:red;"> champs obligatoire </erreur>
            <br><b>Mail :</b><br>
            <!-- Champs de saisie du mail -->
            <input type="text" name="mail" value="" style="width: 150px;"/>@<input type="text" name="fin_mail" value="" style="width: 60px;"/></br>
            <!-- Si un champ est vide un message en rouge apparait -->
            <erreur style="display: none; color:red;"> champs obligatoire </erreur><erreur style="display: none; color:red;"> champs obligatoire </erreur>
            <br><b>Texte :</b><br>
            <!-- Champs de saisie du commentaire -->
            <textarea name="contenu" rows="4" cols="20" style="width: 240px;"></textarea><br> 
            <!-- Si un champ est vide un message en rouge apparait -->
            <erreur style="display: none; color:red;"> champs obligatoire </erreur>
            <!-- Champs caché qui contient l'id de l'article associé au commentaire -->
            <input type="hidden" name="id_article" value="{$reponseid}"  ><br>
            <!-- Bouton de soumission -->
            <br><input type="submit" value="Poster"  name="valider" class='btn btn-large' onsubmit=""/>
        </form>
    </div>
</div>