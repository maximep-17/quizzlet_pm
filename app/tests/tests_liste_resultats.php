
<?php
if(isset($_SESSION["user"])) {
    echo "<div class='subnav'><ul>";
    # en tant qu admin

    if(isset($_SESSION["role"]) == 1) {
        echo "
            <a href='index.php' class='active'><li><span class='material-icons'>view_quilt</span>Vue d'ensemble</li></a>
            <a href='?action=tests-create' class='green'><li><span class='material-icons'>add</span>Créer un test</li></a>

        ";
    }
    # en tant qu utilisateur

    echo "</ul></div>";
    echo "<a href='?action=tests-create'><div class='button-page-fixed-rounded blue'><span class='material-icons'>add</span><p>Nouveau test</p></div></a>";
}

    $testId = htmlentities($_GET["id"]);

?>

<div class="body-content">
    <div class="body-header">
        <p class="big">Résultats du test <?= htmlentities($_GET["id"]) ?> </p>
        <p>Consultez le résultat de chaque élève.</p>
    </div>

<?php



        $sql = "SELECT * FROM users ORDER BY nom_public ASC";
        $stm = getPDO()->query($sql);
        $users = $stm->fetchAll();
        $testsPending = 0;
        //req tentatives where test == testId AND auteur_id == userId
        
        foreach($users as $user) {
            $resultats = getEleveResultat($testId,$user["id"]);

                echo '
                    <div class="section-wrap">
                    <div class="wrapped">
                        <div class="title">
                            <p><span class="material-icons">person</span>';
                echo $user["nom_public"];
                echo '</p></div><div class="expand">';
                echo $resultats;
                echo '</div></div><div class="unwrapped"></div></div>
                ';
            
        }
        return $testsPending;
    

?>

</div>