<?php

# deconnecter l'utilisateur et toutes ses sessions puis le rediriger a l'index

    session_start();
    unset($_SESSION);
    session_destroy();

    header('Location:index.php');
    exit;
?>