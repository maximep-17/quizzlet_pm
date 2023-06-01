
<?php
if(isset($_SESSION["user"])) {
    echo "<div class='subnav'><ul>";
    # en tant qu admin

    if(isset($_SESSION["role"]) == 1) {
        echo "
            <a href='' class='active'><li><span class='material-icons'>view_quilt</span>Vue d'ensemble</li></a>
            <a href='?action=tests-create' class='green'><li><span class='material-icons'>add</span>Créer un test</li></a>

        ";
    }
    # en tant qu utilisateur

    echo "</ul></div>";
    echo "<a href='?action=tests-create' style='z-index:999;'><div class='button-page-fixed-rounded blue'><span class='material-icons'>add</span><p>Nouveau test</p></div></a>";
}

?>



<div class="body-content">
    <div class="body-header">
        <p class="big">Tous les tests crées </p>
        <p>Consultez les tests crées.</p>
    </div>

<?php



        $sql = "SELECT * FROM tests ORDER BY id DESC";
        $stm = getPDO()->query($sql);
        $tests = $stm->fetchAll();
        $testsPending = 0;
        //req tentatives where test == testId AND auteur_id == userId
        
        foreach($tests as $test) {
            if(time() > $test["date_max"]) {
                $testDuration = "Terminé.";
                $testAvailable = 0;
            }
            else {
                $testDuration = "Encore disponible";
                $testAvailable = 1;
            }

                    echo '
                        <div class="section-wrap">
                        <div class="wrapped">
                            <div class="title">
                                <p><span class="material-icons">assignment</span>';
                    echo $test["titre"];
                    echo ' • </p>
                                <p><span class="material-icons">timer</span>';
                    echo $test["temps"];
                    echo ' minutes • </p>
                                <p><span class="material-icons">check_circle_outline</span>';
                    echo $testDuration;
                    echo '</p>
                            </div>
                    ';

                        echo '
                            <div class="expand">
                            <a href="?action=tests-liste-resultats&id=' . $test["id"] . '"><button class="small" type="button">Résultats</button></a>
                            <a href="?action=test-voir&id=' . $test["id"] . '"><button class="small" type="button">Visualiser</button></a>
                            
                        ';
                        if($test["publication"] == 0) {
                            echo '
                                <a href="?action=test-publier&id=' . $test["id"] . '""><button class="small" type="button">Publier</button></a>
                            ';
                        }
                        else {
                            echo '
                                <a href="?action=test-depublier&id=' . $test["id"] . '""><button class="small" type="button">Dépublier</button></a>
                            ';
                        }

                    echo '</div></div>
                        <div class="unwrapped"></div>
                    </div>
                    ';
            
        }
        return $testsPending;
    

?>
    
    


</div>