<?php
    $action = "";
    $traitement = "";


    if(isset($_GET["traitement"])) {
        $traitement = $_GET["traitement"];
    }

    if(isset($_GET["action"])) {
        $action = $_GET["action"];
    }
    
    if($traitement == "") {
        include('app/ui/header.php');
        

    }
    else {
        include('app/sys/connexion.php');
    }





    
    if(isset($_SESSION["user"])) {
        $_SESSION["role"] = isAdmin($_SESSION["userid"]);
    }

// logged as admin
    if(isset($_SESSION["user"]) && isset($_SESSION["role"])) {
        if($_SESSION["role"] == 1) {
            if($action == "") {
                include('app/tests/tests_liste_admin.php');
            }
            if($action == "tests-index") {
                include('app/tests/tests_liste_admin.php');
            }
            if($action == "tests-create") {
                include 'app/tests/tests_create.php';
            }
            if($action == "categories-index") {
                include 'app/categories/categories_index.php';
            }
            if($action == "categories-create") {
                include 'app/categories/categories_create.php';
            }

            if($action == "questions-index") {
                include 'app/questions/questions_index.php';
            }
            if($action == "questions-create") {
                include 'app/questions/questions_create.php';
            }
            if($action == "test-voir") {
                if(isset($_GET["id"])) {
                    include('app/tests/tests_do_admin.php');
                }
                else {
                    header('Location:index.php');
                }
            }
            if($action == "tests-liste") {
                include('app/tests/tests_liste_admin.php');
            }
            if($action == "tests-liste-resultats") {
                if(isset($_GET["id"])) {
                    include('app/tests/tests_liste_resultats.php');
                }
                else {
                    header('Location:index.php');
                }
            }
            if($action == "test-publier") {
                if(isset($_GET["id"])) {
                    include('app/tests/test_publish.php');
                }
                else {
                    header('Location:index.php');
                }
            }
            if($action == "test-depublier") {
                if(isset($_GET["id"])) {
                    include('app/tests/test_unpublish.php');
                }
                else {
                    header('Location:index.php');
                }
            }
            if($action == "settings") {
                include('app/sys/settings.php');
            }
            if($action == "user_derank") {
                if(isset($_GET["id"])) {
                    include('app/users/user_derank.php');
                }
                else {
                    header('Location:index.php');
                }
            }
            if($action == "user_rank") {
                if(isset($_GET["id"])) {
                    include('app/users/user_rank.php');
                }
                else {
                    header('Location:index.php');
                }
            }
        }
// logged as user 
        else {
            if($action == "") {
                include('app/ui/accueil_user.php');
            }
            if($action == "tests-index") {
                include('app/ui/accueil_user.php');
            }
            if($action == "fairetest") {
                if(isset($_GET["id"])) {
                    include('app/tests/tests_do.php');
                }
                else {
                    header('Location:index.php');
                }
            }
            if($action == "resultattest") {
                if(isset($_GET["id"])) {
                    include('app/tests/test_result.php');
                }
                else {
                    header('Location:index.php');
                }
            }
            if($action == "user_voir_results") {
                include('app/tests/tests_results.php');
                // faire: Lister les tests, voir si y a une tentative. On affiche en mode page "test index" en remplacant le bouton qui => redirige vers la page "resultattest & id = testId". Pour les tests non réalisés, juste afficher "Non rendu" (unclickable)
            }
        }

        
    }
// not logged
    else {
        if($action == "") {
            include 'app/ui/accueil.php';
        }
        if($action == "inscription") {
            include 'app/ui/inscription.php';
        }
        if($action == "login") {
            include 'app/users/login.php';
        }
        if($action == "apropos") {
            include 'app/ui/apropos.php';
        }
    }

    if($action == "logout") {
        include 'app/users/logout.php';
    }

    if($traitement == "") {
        include('app/ui/footer.php');
    }

?>