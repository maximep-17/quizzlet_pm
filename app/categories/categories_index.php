<?php
    ### ajout d'une subnav si l utilisateur est connecte => subnav tests
    if(isset($_SESSION["user"])) {
        echo "<div class='subnav'><ul>";
        # en tant qu admin

        if(isset($_SESSION["role"]) == 1) {
            echo "
                <a href='' class='active'><li><span class='material-icons'>view_quilt</span>Vue d'ensemble</li></a>
                <a href='?action=categories-create' class='green'><li><span class='material-icons'>add</span>Créer une catégorie</li></a>
            ";
        }
        # en tant qu utilisateur

        echo "</ul></div>";
        echo "<a href='?action=categories-create' style='z-index:999;'><div class='button-page-fixed-rounded blue'><span class='material-icons'>add</span><p>Nouvelle catégorie</p></div></a>";
    }
?>

<div class="body-content">
    <div class="body-header">
        <p class="big">Toutes les catégories créees </p>
        <b>Consultez les catégories créees pour les tests.</b><hr>
    </div>

<?php

        $sql = "SELECT * FROM categories_test ORDER BY id DESC";
        $stm = getPDO()->query($sql);
        $catTests = $stm->fetchAll();

        foreach($catTests as $catTest) {
                    echo '
                        <div class="section-wrap">
                        <div class="wrapped">
                            <div class="title">
                                <p><span class="material-icons">topic</span>';
                    echo $catTest["titre"];
                    echo ' • </p>
                                <p><span class="material-icons">read_more</span>';
                    echo $catTest["description"];
                    echo '</div><div class="expand">';             

                    echo '</div></div>
                        <div class="unwrapped"></div>
                    </div>
                    ';
        }

        echo "<div class='body-header'><hr><b>Consultez les catégories créees pour les questions.</b></div>";


        $sql = "SELECT * FROM categories_questions ORDER BY id DESC";
        $stm = getPDO()->query($sql);
        $catQuestions = $stm->fetchAll();

        foreach($catQuestions as $catQuestion) {
                    echo '
                        <div class="section-wrap">
                        <div class="wrapped">
                            <div class="title">
                                <p><span class="material-icons">topic</span>';
                    echo $catQuestion["titre"];
                    echo ' • </p>
                                <p><span class="material-icons">read_more</span>';
                    echo $catQuestion["description"];
                    echo '</div><div class="expand">';             

                    echo '</div></div>
                        <div class="unwrapped"></div>
                    </div>
                    ';
        }
        
?>
    
</div>