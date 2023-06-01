<?php
    ### ajout d'une subnav si l utilisateur est connecte => subnav tests
    if(isset($_SESSION["user"])) {
        echo "<div class='subnav'><ul>";
        # en tant qu admin

        if(isset($_SESSION["role"]) == 1) {
            echo "
                <a href='?action=categories-index'><li><span class='material-icons'>view_quilt</span>Vue d'ensemble</li></a>
                <a href='' class='active'><li><span class='material-icons'>add</span>Créer une catégorie</li></a>
            ";
        }
        # en tant qu utilisateur

        echo "</ul></div>";
    
        echo "

        <div class='body-content' id='test_create'>
        <div class='testcreate-page'>
    
            <div class='form-block'>
                <h4>Création d'une catégorie</h4>
                <h6>Créez une catégorie pour une question ou un test en renseignant un titre, une description et si c'est une catégorie 'test' ou 'question'.</h6>
                <br>            
                <form action='app/categories/categories_insert.php' method='post' id='categorie-send'>
                    <select name='type'>
                        <option value=''>Type de catégorie</option>
                        <option value='question'>Pour une question</option>
                        <option value='test'>Pour un test</option>
                    </select>
                    <label for='message' class='p_help'>Sélectionnez si c'est une catégorie pour une question ou un test</label>

                    <label class='has-float-label'>
                        <input placeholder=' ' type='text' name='titre' required>
                        <span class='label'>Titre *</span>
                        <div class='helper'>Doit être de 2 caractères minimum</div>
                        <div class='error'>Erreur: Doit être de 2 caractères minimum</div>
                    </label>

                    <div class='form__group'>
                    <textarea id='desc' class='form__field' placeholder='Description' rows='6' name='description'></textarea>
                    <label for='desc' class='form__label'>Description</label>
                    <div class='helper'>Doit être renseigné</div>
                    </div>

                    <div class='form-input'>
                        <button type='submit'><span class='material-icons'>send</span> Créer la catégorie</button>
                    </div>
                </form>
                <p class='errors-form'></p>
            </div>
        </div>
        </div>
        ";

//        echo "<a href='?action=tests-create'><div class='button-page-fixed-roundedbox green'><div class='icon'><span class='material-icons'>add_task</span></div><div class='first-step'><p>Enregistrer la catégorie</p></div><div class='second-step'><div class='text'><p class='title'><span class='material-icons'>send</span>Enregistré.</p><p class='desc'>Votre question a été correctement enregistrée. Cliquez pour en re-créer une autre.</p><input value='créer une autre question'></div></div></div></div></a>";
    }
?>