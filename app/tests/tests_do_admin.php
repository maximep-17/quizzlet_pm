<?php
    ### ajout d'une subnav si l utilisateur est connecte => subnav tests
    if(isset($_SESSION["user"]) && $_SESSION["role"] == 1) {
        $requestedTest = htmlentities($_GET["id"]);
        
        $sql = "SELECT * FROM tests WHERE id=?";
        $stm = getPDO()->prepare($sql);
        $stm->execute([$requestedTest]);
        $test = $stm->fetch();

        $auteur_id  = getUserSessionId();

        if(!$test) {
            echo "Le test demandé n'existe pas.";
        }
        else {


                    $sql = "SELECT * FROM tentatives WHERE test_id=? AND auteur_id=?";
                    $stm = getPDO()->prepare($sql);
                    $stm->execute([$requestedTest, $auteur_id]);
                    $tentative = $stm->fetch();


                        $pageTestId = $test["id"];
                        $pageTestTitre = $test["titre"];
                        $pageTestDesc = $test["description"];
                        $pageTestTemps = $test["temps"];
                        $pageTestDateMax = $test["date_max"];
                        $pageTestCreation = $test["date_creation"];
                        $pageTestPublication = $test["date_publish"];
                        $pageTestTentatives = $test["tentatives"];
    
                        echo "
    
                        <div class='body-content' id='test_create'>
                        <div class='testcreate-page'>
                    
                            <div class='form-block'>
                                <h4>Vous visualisez le test: '" . $pageTestTitre . "'</h4>
                                <h6>" . $pageTestDesc . "</h6>
                                <br>            
                                <form action='' method='post' id=''>
                                    <input type='text' name='testid' value='" . $pageTestId . "' style='display:none'>
                        ";
                 
                // construction et affichage des questions
                        $sql = "SELECT * FROM questions";
                        $stm = getPDO()->query($sql);
                        $questions = $stm->fetchAll();
                
                        $testQuestions = json_decode($test["questions"], true);
                
                
                        foreach($questions as $question) {
                            foreach($testQuestions as $testQuestion) {
                                if($question["id"] == $testQuestion) {
                ## reponse libre    
                                    echo "<div class='question' id='" . $question["id"] . "' type='" . $question["format"] . "'>";
                                    
                
                                    if($question["format"] == 0) {
                                        echo "<b>" . $question["intitule"] . "</b>";
                                        echo "
                                            <label class='has-float-label'>
                                                <input placeholder=' ' type='text' name='" . $question["id"] . "'>
                                                <span class='label'>'Indiquez votre réponse ici'</span>
                                                <div class='helper'>Réponse libre</div>
                                                <div class='error'>Erreur: Doit être de 2 caractères minimum</div>
                                            </label>
                                        ";
                                    }
                ## liste deroulante
                                    if($question["format"] == 1) {
                                        $compteurval = 0;
                                        $questionsPropositions = json_decode($question["propositions"], true);
                                        echo "<b>" . $question["intitule"] . "</b>";
                                        echo "
                                            <select name='" . $question["id"] . "'>
                                            <option value=''>Veuillez choisir une réponse</option>
                                        ";
                                        foreach($questionsPropositions as $questionsProposition) {
                                            echo "<option value='" . $compteurval . "'>". $questionsProposition . "</option>";
                                            $compteurval = $compteurval + 1;
                                        }
                                        echo "</select>";
                                    }
                ## case à cocher
                                    if($question["format"] == 2) {
                                        $compteurval = 0;
                                        $questionsPropositions = json_decode($question["propositions"], true);
                                        echo "<div class='reply-checkboxes'><p><b>" . $question["intitule"] . "</b></p><div class='boxes'>";
                                        foreach($questionsPropositions as $questionsProposition) {
                                            echo "<input type='checkbox' name='" . $question["id"] . "' value='" . $compteurval . "' id ='" . $compteurval . "'>";
                                            echo "<label for='" . $compteurval . "'>" . $questionsProposition . "</label><br>";
                                            $compteurval = $compteurval + 1;
                                        }
                                        echo "</div></div>";
                                    }
                                    echo "</div><hr>";
                                }
                            }
                        }
                        
                        
                        echo "                    
                                </form>
                                <p class='errors-form'></p>
                            </div>
                        </div>
                        </div>
                        ";
        }





//        echo "<a href='?action=tests-create'><div class='button-page-fixed-roundedbox green'><div class='icon'><span class='material-icons'>add_task</span></div><div class='first-step'><p>Enregistrer la question</p></div><div class='second-step'><div class='text'><p class='title'><span class='material-icons'>send</span>Enregistré.</p><p class='desc'>Votre question a été correctement enregistrée. Cliquez pour en re-créer une autre.</p><input value='créer une autre question'></div></div></div></div></a>";
    }
    else {
        header('Location:index.php');
    }
?>