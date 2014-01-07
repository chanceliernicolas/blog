<?php
    // Démarrage de la session
    session_start();
    // Si nous sommes en cookie ou en session
    if (!isset($_SESSION['admin']) || !isset($_COOKIE['cookie'])) 
    {
        // Redirection vers la page d'accueil
        header('Location: index.php');
        exit();
    }
?>