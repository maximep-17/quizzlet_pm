<?php
    ### ajout d'une subnav si l utilisateur est connecte => subnav tests
    if(isset($_SESSION["user"])) {
        echo "<div class='subnav'><ul>";
        # en tant qu admin

        if(isset($_SESSION["role"]) == 1) {
            echo "
                <a href='?action=tests-index'><li><span class='material-icons'>view_quilt</span>Vue d'ensemble</li></a>
                <a href='' class='active'><li><span class='material-icons'>add</span>Créer un test</li></a>
            ";
        }
        # en tant qu utilisateur

        echo "</ul></div>";
    
        echo "

        <div class='body-content' id='test_create'>
        <div class='testcreate-page'>
    
            <div class='form-block'>
                <h4>Création d'un test</h4>
                <h6>Créez un test, des propositions avec ses réponses puis le type de question (choix multiple, réponse libre...).</h6>
                <br>            
                <form action='app/tests/tests_insert.php' method='post' id='test-send'>
                    <label class='has-float-label'>
                        <input placeholder=' ' type='text' name='titre' required>
                        <span class='label'>Titre *</span>
                        <div class='helper'>Doit être de 2 caractères minimum</div>
                        <div class='error'>Erreur: Doit être de 2 caractères minimum</div>
                    </label>

                    <label class='has-float-label'>
                        <input placeholder=' ' type='text' name='description' required>
                        <span class='label'>Description *</span>
                        <div class='helper'>Doit être de 2 caractères minimum</div>
                        <div class='error'>Erreur: Doit être de 2 caractères minimum</div>
                    </label>
                    
                    <select name='type' id='test-create-categorie'>";

                    $sql = "SELECT * FROM categories_test";
                    $stm = getPDO()->query($sql);

                    $users = $stm->fetchAll();

                    foreach($users as $row) {
                        echo "<option value='$row[0]'>$row[1]</option>";
                    }
                    echo "</select>";
                    echo "<div id='desc-categ'>";
                    foreach($users as $row) {
                        echo "<p id='$row[0]'>$row[2]</p>";
                    }
                    echo "</div><label for='message' class='p_help'>Sélectionnez la catégorie</label>";
                        

                        
// <option value='question'>Pour une question</option>

                    echo
                    "<br>
                    <br>
                    <h4>Questions</h4>
                    <div class='reponses-cache' style='display:flex;align-items:center'>";

                    echo "<span class='question-indice'>1) </span> <select name='type' id='test-create-questions-0' class='select-test'>";

                    $sql = "SELECT * FROM questions";
                    $stm = getPDO()->query($sql);

                    $users = $stm->fetchAll();

                    foreach($users as $row) {
                        echo "<option value='$row[0]' points='$row[10]'>$row[1]</option>";
                    }
                    echo "</select></div><div class='propositions'><div class='reponse'>
                    ";
// foreach question
         
        echo "
                    <button class='small' onclick='addQuestion()' type='button'>Ajouter une question</button>
                    </div></div>

                    <br><h4>Paramètres</h4>

                    <label class='has-float-label'>
                        <input placeholder=' ' type='text' name='temps' required>
                        <span class='label'>Temps alloué *</span>
                        <div class='helper'>Définissez le temps en <b>minutes</b> disponible après publication pour réaliser le test.</div>
                        <div class='error'>Erreur: Doit être renseigné.</div>
                    </label>

                    <label class='has-float-label'>
                        <input placeholder=' ' type='text' name='tentatives' required>
                        <span class='label'>Nombre de tentatives autorisées *</span>
                        <div class='helper'>Définissez le nombre de tentatives autorisées sur ce test.</div>
                        <div class='error'>Erreur: Doit être renseigné.</div>
                    </label>

                    <label class='has-float-label'>
                        <input placeholder=' ' type='text' name='arrondi_note' required>
                        <span class='label'>Note finale arrondie *</span>
                        <div class='helper'>Définissez un arrondi pour la note finale du test.</div>
                        <div class='error'>Erreur: Doit être renseigné.</div>
                    </label>

                    <p class='nbpoints'>Note maximale : </p>

                    <div class='form-input'>
                        <button type='submit' id='test-send'><span class='material-icons'>send</span> Créer la question</button>
                    </div>
                </form>
                <p class='errors-form'></p>
            </div>
        </div>
        </div>
        ";

//        echo "<a href='?action=tests-create'><div class='button-page-fixed-roundedbox green'><div class='icon'><span class='material-icons'>add_task</span></div><div class='first-step'><p>Enregistrer la question</p></div><div class='second-step'><div class='text'><p class='title'><span class='material-icons'>send</span>Enregistré.</p><p class='desc'>Votre question a été correctement enregistrée. Cliquez pour en re-créer une autre.</p><input value='créer une autre question'></div></div></div></div></a>";
    }
?>