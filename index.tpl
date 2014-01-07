<div class="span8">
    <!-- pour chaque données du tableau, on les ajoute sur la page -->
    {foreach from=$data_tab item=data}
        <div class="page-header well">
            <!-- titre de l'article -->
            <center><h2>{$data['titre']}</h2><br>
            <!-- image de l'article -->
            <img src = "img/{$data['id_article']}.jpg" width = "200" height = "200" alt = ""/></center>
            <!-- contenu de l'article -->
            <br>{$data['contenu']}<br><br>
            <!-- date de publication de l'article -->
            <i> Publié le : {$data['date']}</i>
            <!-- si connecté en session -->
            {if $session==true}   
                <!-- si connecté en session ou connecté simplement -->
                {if ($session==true || $state_connect == true)} 
                    <!-- affichage des boutons modifier et supprimer -->
                    <br><a href="article.php?id_article={$data['id_article']}"> Modifier l'article</a>
                    <br><a href="article.php?delete_article={$data['id_article']}"> Supprimer l'article</a>
                {/if}
            {/if}
            <!-- Boutons qui permet de voir les commentaires sur cet article -->
            <br><a href="commentaire.php?id_article={$data['id_article']}">Voir les commentaire</a>
        </div>
    {/foreach}
    
    <!-- Pagination -->
    <br><br>
    <center>Page :    
        {for $i = 1; $i <= $nombreDePages; $i++}
            {if $i == $pageActuelle }
                [ {$i} ]
            {else}
                <a href="index.php?page={$i}">{$i}</a>
            {/if}
        {/for}
        <!-- Bouton pour selection du nombre d'article par page -->
        <form method="POST">
            <br>Nombre d'articles sur une page : 
            <select name="nb_articles_choisi" onchange="submit();" style="width: auto;height: auto">
                <option value="1">1</option>
                <option value="3">3</option>
                <option value="5">5</option>
                <option value="7">7</option>
            </select>
        </form>
    </center>
</div>