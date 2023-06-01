<?php
    ### ajout d'une subnav si l utilisateur est connecte => subnav tests
    if(isset($_SESSION["user"])) {
        echo "<div class='subnav'><ul>";
        # en tant qu admin

        if(isset($_SESSION["role"]) == 1) {
            echo "
                <a href='?action=questions-index'><li><span class='material-icons'>view_quilt</span>Vue d'ensemble</li></a>
                <a href='' class='active'><li><span class='material-icons'>add</span>Créer une question</li></a>
            ";
        }
        # en tant qu utilisateur

        echo "</ul></div>";
    
        echo "

        <div class='body-content' id='test_create'>
        <div class='testcreate-page'>
    
            <div class='form-block'>
                <h4>Création d'une question</h4>
                <h6>Créez une question pour un test en renseignant un intitulé, des propositions avec ses réponses puis le type de question (choix multiple, réponse libre...).</h6>
                <br>            
                <form action='app/questions/questions_insert.php' method='post' id='question-send'>
                    <label class='has-float-label'>
                        <input placeholder=' ' type='text' name='intitule' required>
                        <span class='label'>Intitulé *</span>
                        <div class='helper'>Doit être de 2 caractères minimum</div>
                        <div class='error'>Erreur: Doit être de 2 caractères minimum</div>
                    </label>

                    <select name='type' id='question-create-categorie'>";

                    $sql = "SELECT * FROM categories_questions";
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
                    <h4>Réponses</h4>
                    <div class='propositions'>
                        <div class='reponse'>
                            <label class='has-float-label'>
                                <input placeholder=' ' type='text' name='reponse0' required>
                                <span class='label'>Réponse 1 *</span>
                                <div class='helper'>Doit être de 2 caractères minimum</div>
                                <div class='error'>Erreur: Doit être de 2 caractères minimum</div>
                            </label>
                            <div class='check'>
                            <input type='checkbox' id='checkbox0'>
                                <div>
                                <label for='checkbox0'>Définir comme réponse</label>
                                </div>
                            </div>
                        </div>
                    <button class='small' onclick='addProposition()' type='button'>Ajouter une proposition</button>
                    </div>

                    <br><h4>Paramètres</h4>

                    <select name='format' id='format-select'>
                        <option value=''>Type de question</option>
                        <option value='0'>Réponse libre</option>
                        <option value='1'>Liste déroulante</option>
                        <option value='2'>Choix multiples</option>
                    </select>
                    <label for='message' class='p_help'>Choisissez si c'est un champ libre, un choix multiple.</label>

                    <select name='niveau' id='niveau-select'>
                        <option value=''>Difficulté de la question</option>
                        <option value='0'>Débutant</option>
                        <option value='1'>Intermédiaire</option>
                        <option value='2'>Difficile</option>
                        <option value='3'>Expert</option>
                    </select>
                    <label for='message' class='p_help'>Choisissez le niveau de difficulté.</label>


                    <label class='has-float-label'>
                        <input placeholder=' ' type='text' name='valeur_pts' required>
                        <span class='label'>Nombre de points *</span>
                        <div class='helper'>Définissez le nombre de points que rapporte la question.</div>
                        <div class='error'>Erreur: Doit être renseigné.</div>
                    </label>



                    <div class='form-input'>
                        <button type='submit' id='question-send'><span class='material-icons'>send</span> Créer la question</button>
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