<?php
    include('app/sys/connexion.php');
?>

<!DOCTYPE html>
<html class="index" lang="fr">
<head>
    <meta charset="UTF-8">
    <title>QCM en ligne</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tests en ligne</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="script.js"></script>
    <link href="assets/reset.css" rel="stylesheet">
    <link href="assets/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <!-- Section Header -->

    <?php
        
        if(isset($_SESSION["user"])) {
            echo "<div class='header-container'>";
        }
        else {
            echo "<div class='header-container big'>";
        }
    ?>
    
        <nav>
            <?php


            ### on ajuste le texte si un utilisateur est connecte ou non
                    if(isset($_SESSION["user"])) {
                        $fullnameheader = $_SESSION['fullname'];
                        if($_SESSION["role"] == 1) {
                            echo "<p>Panel d'administration</p>";
                        }
                        else {
                            echo "<p>Panel élève</p>";
                        }

                    }
                    else {
                        echo "<p><a href='index.php'> $system_siteTitle </a></p>";
                    }
            ?>

            <ul>
                <?php
                ### on ajuste les fonctions si un utilisateur est connecte ou non
                    if(isset($_SESSION["user"])) {
                        if($_SESSION["role"] == 1) {
                            echo "
                            <li id='tests-index'><a href='#'>Tests</a></li>
                            <li id='questions-index'><a>Questions</a></li>
                            <li id='categories-index'><a>Catégories</a></li>
                            <li><a href='?action=settings'>Paramètres</a></li>
                            <li class='rounded'><a href='?action=logout'><span class='material-icons'>logout</span></a></li>
                            ";
                        }
                        else {
                            echo "
                            <li id='tests-index'><a href='?action=user_voir_tests'>Tests</a></li>
                            <li id='tests-result'><a href='?action=user_voir_results'>Résultats</a></li>
                            <li class='rounded'><a href='?action=logout'><span class='material-icons'>logout</span></a></li>
                            ";
                        }
                    }
                    else {
                        echo "<li><a href='?action=inscription'>Inscription</a></li><li><a href='?action=apropos'>A propos</a></li>";
                    }
                ?>
                

            </ul>
        </nav>

        <header>
            <?php
                if(!isset($_SESSION["user"])) {
                    echo "<h4>Tests en ligne</h4><p>$system_landingDesc</p>";   
                }
            ?>
        </header>
    </div>

