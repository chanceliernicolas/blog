<?php
    // on met le cookie à -1 ce qui le désactive
    setcookie('cookie', NULL, -1);
    // démarrage d'une session
    session_start();
    // arrêt de la session
    session_unset();
    // destruction de la session
    session_destroy();
    // redirection vers la page d'accueil
    header('Location:index.php');
    exit();
?>

