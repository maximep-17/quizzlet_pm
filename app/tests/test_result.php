<?php
    if(isset($_SESSION["user"])) {
        $requestedTest = htmlentities($_GET["id"]);
        
        $sql = "SELECT * FROM tests WHERE id=?";
        $stm = getPDO()->prepare($sql);
        $stm->execute([$requestedTest]);
        $test = $stm->fetch();

        $auteur_id  = getUserSessionId();

        if(!$test) {
            echo "Le test demandé n'est plus disponible.";
        }
        else {
// get la tentative si elle existe
            $sql = "SELECT * FROM tentatives WHERE test_id=? AND auteur_id=?";
            $stm = getPDO()->prepare($sql);
            $stm->execute([$requestedTest, $auteur_id]);
            $tentative = $stm->fetch();


// aucune tentative
            if(!$tentative) {
                echo "Aucune tentative enregistrée pour ce test.";
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


                

                echo "<div class='body-header reponses-test'>
                    <p class='title'>Vos résultats du test <u>" . $test["titre"] . "</u></p><hr>
                    ";


                foreach($questions as $question) {

                    $questionsPropositions = json_decode($question["propositions"], true);
                    $questionsReponses = json_decode($question["reponses"], true);


                    foreach($tentativeReponses as $tentativeReponse) {
                        if($question["id"] == $tentativeReponse["questionId"]) {
                        $totalPointsPossible = $totalPointsPossible + $question["valeur_pts"];

                      
                            if($question["format"] == 0) {
                                $reponseEleve = "";
                                $reponseEleve = $tentativeReponse["reponses"][0];
                            }
                            else {
                                $reponseEleve = "";

                                foreach($tentativeReponse["reponses"] as $reponsesEleve) {
                                    $nombreReponses = count($tentativeReponse["reponses"]);
                                    if($nombreReponses > 1) {
                                        $reponseEleve = $reponseEleve . "<br>" . $questionsPropositions[$reponsesEleve];
                                    }
                                    else {
                                        $reponseEleve = $questionsPropositions[$reponsesEleve];
                                    }
                                } 
                            }

                            echo "<div class='reponse-question'>
                                <p class='title'>" . $question["intitule"] . "</u></p>
                                <b>Vous avez répondu :</b> ".  $reponseEleve ." <br>
                                <b>Réponse(s) :</b>
                            ";
// $tentativeReponse["reponses"][0] val reponse
                            
                            foreach($questionsReponses as $reponse) {
                                $bonneReponses = $reponse;
                                $nombreBonneReponses = count($questionsReponses);
                                if($nombreBonneReponses > 1) {
                                    echo "<br>". $questionsPropositions[$bonneReponses];
                                }
                                else {
                                    echo $questionsPropositions[$bonneReponses];
                                }
                            } 

                            echo "
                                <br><b>Nombre de points obtenus:</b>
                            ";

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

                            echo $nbPoints;
                            
                            echo "<hr></div>
                            ";
                        }
                    }
                }
                echo "<p class='nbpoints'>Nombre total de points obtenus: <strong>" . $totalPoints . "/" . $totalPointsPossible  . "</strong>" ;
                echo "</div>";
            }
        }




//        echo "<a href='?action=tests-create'><div class='button-page-fixed-roundedbox green'><div class='icon'><span class='material-icons'>add_task</span></div><div class='first-step'><p>Enregistrer la question</p></div><div class='second-step'><div class='text'><p class='title'><span class='material-icons'>send</span>Enregistré.</p><p class='desc'>Votre question a été correctement enregistrée. Cliquez pour en re-créer une autre.</p><input value='créer une autre question'></div></div></div></div></a>";
    }
?>