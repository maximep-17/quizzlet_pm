<?php
    ### ajout d'une subnav si l utilisateur est connecte => subnav tests
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
            if($test["publication"] == 0) {
                echo "Le test demandé n'est pas publié.";
            }
            else {
                if(time() > $test["date_max"]) {
                    echo "Le test demandé n'est plus disponible (temps écoulé).";
                }
                else {

                    $sql = "SELECT * FROM tentatives WHERE test_id=? AND auteur_id=?";
                    $stm = getPDO()->prepare($sql);
                    $stm->execute([$requestedTest, $auteur_id]);
                    $tentative = $stm->fetch();
    
                    if($tentative) {
                        echo "Vous avez déjà réalisé ce test.";
                    }
                    else {

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
                                <h4>Vous réalisez le test: '" . $pageTestTitre . "'</h4>
                                <h6>" . $pageTestDesc . "</h6>
                                <br>            
                                <form action='app/tests/tests_finish.php' method='post' id='test-finish'>
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
                                    <div class='form-input'>
                                        <button type='submit' id='test-send'><span class='material-icons'>send</span> Finir le test</button>
                                    </div>
                                </form>
                                <p class='errors-form'></p>
                            </div>
                        </div>
                        </div>
                        ";
                    }
                }
            }
        }
    }
?>