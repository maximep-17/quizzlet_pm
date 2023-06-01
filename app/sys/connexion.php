<?php
    session_start();

    $connexion = "";
    //connexion Ã  la base de donnÃ©es
    $user = 'root'; // nom d'utilisateur pour se connecter
    $pass = ''; // mot de passe de l'utilisateur pour se connecter
    //Pour que les donnÃ©es arrivent dans le programme encodÃ©es en UTF8, il faut fournir des paramÃ¨tres
    $pdo_options[PDO::MYSQL_ATTR_INIT_COMMAND] = "SET NAMES 'UTF8'";
    $connexion = new PDO('mysql:host=localhost;dbname=proj_ap', $user, $pass, $pdo_options);
    

    //ParamÃ©trer la connexion pour rÃ©cupÃ©rer les erreurs de la base de donnÃ©es
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    function getPDO() {
        $user = 'root'; // nom d'utilisateur pour se connecter
        $pass = ''; // mot de passe de l'utilisateur pour se connecter
        //Pour que les donnÃ©es arrivent dans le programme encodÃ©es en UTF8, il faut fournir des paramÃ¨tres
        $pdo_options[PDO::MYSQL_ATTR_INIT_COMMAND] = "SET NAMES 'UTF8'";
        return $connexion = new PDO('mysql:host=localhost;dbname=proj_ap', $user, $pass, $pdo_options);
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    
        //ParamÃ©trer la connexion pour rÃ©cupÃ©rer les erreurs de la base de donnÃ©es
    }
    // on initialise les parametres du site

    $tableSettings = $connexion->query("SELECT * FROM parametres")->fetch();
    
    $system_siteTitle   = $tableSettings['nom_site'];
    $system_siteMeta    = $tableSettings['meta_data'];
    $system_siteVersion = $tableSettings['version'];

    // reglages temporaires le temps de les relier a la base de donnees. donnees liees au site

    $system_siteTitle   = "ENT Quizzlet";
    $system_landingDesc = "Bienvenue sur le site $system_siteTitle.<br>Auto-formez vous et consultez vos résultats en ligne.";

// functions

    function isAdmin($userId) {
        $emailreq = getPDO()->prepare("SELECT * FROM users WHERE id=?");
        $emailreq->execute([$userId]); 
        $admin = $emailreq->fetch();

        if($admin) {
            return $admin["role"];
        }
    }

    function getUserSessionId() {
        if(isset($_SESSION["user"]))
        {
            return ($_SESSION["user"]);
        }
        else {
            return "n";
        }
    }

// fonction pour obtenir nb de points d une tentative 
function getEleveResultat($testId,$eleveId) {
    $requestedTest = $testId;
    
    $sql = "SELECT * FROM tests WHERE id=?";
    $stm = getPDO()->prepare($sql);
    $stm->execute([$requestedTest]);
    $test = $stm->fetch();

    $auteur_id  = $eleveId;

    if(!$test) {
        return "Test inexistant.";
    }
    else {
// get la tentative si elle existe
        $sql = "SELECT * FROM tentatives WHERE test_id=? AND auteur_id=?";
        $stm = getPDO()->prepare($sql);
        $stm->execute([$requestedTest, $auteur_id]);
        $tentative = $stm->fetch();


// aucune tentative
        if(!$tentative) {
            return "Non rendu.";
        }
        else {
            $totalPointsPossible = 0;
            $totalPoints = 0;
// on repertorie les questions
            $tentativeReponses = json_decode($tentative["reponses"], true);

            $sql = "SELECT * FROM questions";
            $stm = getPDO()->prepare($sql);
            $stm->execute([$requestedTest, $auteur_id]);
            $questions = $stm->fetchAll();

            foreach($questions as $question) {
                $questionsPropositions = json_decode($question["propositions"], true);
                $questionsReponses = json_decode($question["reponses"], true);

                foreach($tentativeReponses as $tentativeReponse) {
                    if($question["id"] == $tentativeReponse["questionId"]) {
                    $totalPointsPossible = $totalPointsPossible + $question["valeur_pts"];
                        
                        foreach($questionsReponses as $reponse) {
                            $bonneReponses = $reponse;
                            $nombreBonneReponses = count($questionsReponses);
                        } 
// calcul des pts
                        $nbPoints = "";

                        if($question["format"] == 0) {
                            $reponseEleve = $tentativeReponse["reponses"][0];
                            if($questionsPropositions[0] == $reponseEleve) {
                                $nbPoints = $question["valeur_pts"];
                                $totalPoints = $totalPoints + $nbPoints;
                            }
                        }
                        else {
                            $reponseEleve = "";

                            foreach($tentativeReponse["reponses"] as $reponsesEleve) {
                                $nombreReponses = count($tentativeReponse["reponses"]);

                                if($questionsPropositions[$reponsesEleve] == $questionsPropositions[$bonneReponses] && $nombreBonneReponses == $nombreReponses) {
                                    $nbPoints = $question["valeur_pts"];
                                    $totalPoints = $totalPoints + $nbPoints;
                                }
                            } 
                        }
                    }
                }
            }
            $resultat = array();
            $resultat[] = $totalPoints;
            $resultat[] = $totalPointsPossible;
            return($totalPoints . "/" . $totalPointsPossible);
        }
    }
}
    
?>