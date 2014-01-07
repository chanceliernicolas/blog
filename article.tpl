<head>
    <!-- On fait appel au script de la page formulaire.js -->
    <script type="text/javascript" src="js/formulaire.js"></script>
</head>
<div class="span8">
    <center><h3>Page admin</H3></center>
    <div class="page-header well">
        <!-- La variable '$action_label' varie en fonction du bouton modifier ou ajouter -->
        <center><u><b><h3>{$action_label} un article</H3></u></b>
            <!-- Formulaire de création ou de modification d'un article -->
            <form id="creation_article" method="POST" action="article.php" enctype="multipart/form-data" >     
                <b> Titre : </b>
                <!-- Champs de saisie pour le titre. 
                La variable '$reponsetitre' permet de récuperer la valeur du champs lors de la modification de l'article -->
                <input type="text" name="titre" value="{$reponsetitre}" />
                <!-- Si un champ est vide un message en rouge apparait -->
                <span style="display:none; color: red"> champs obligatoire </span>              
                <br><b> Texte : </b>
                <!-- Champs de saisie pour le contenu. 
                La variable '$reponsecontenu' permet de récuperer la valeur du champs lors de la modification de l'article -->
                <textarea name="contenu" rows="4" cols="20">{$reponsecontenu}</textarea><br>
                <!-- Si un champ est vide un message en rouge apparait -->
                <span style="display:none; color: red"> champs obligatoire </span>
                <b> Image : </b>
                <!-- Bouton pour choisir une image -->
                <input type="file" name="image" value="" /><br>
                <b> Publié : </b>
                <!-- Checkbox de statut de connecté qui est coché ou non en fonction de la valeur retourné par la page article.php -->
                <input type="checkbox" name="statut" value="{$reponsestatut}" {if $reponsestatut==1}checked {else}{/if} /><br><br>
                <!-- Champs caché de l'id de l'article lors de la modification de l'article -->
                <input type="hidden" name="id" value="{$reponseidarticle}"  ><br>
                <!-- Bouton de soumission -->
                <input type="submit" value="{$action_label}"  name="{$action_label}" class='btn btn-large' onsubmit=""/>            
            </form>
        </center>
    </div>
</div>