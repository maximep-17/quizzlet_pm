
<?php

function getPendingTests() {
    
    $sql = "SELECT * FROM tests";
    $stm = getPDO()->query($sql);
    $tests = $stm->fetchAll();
    $testsPending = 0;
    //req tentatives where test == testId AND auteur_id == userId
    
    foreach($tests as $test) {
        $sql = "SELECT * FROM tentatives WHERE test_id=? AND auteur_id=?";
        $stm = getPDO()->prepare($sql);
        $stm->execute([$test["id"],$_SESSION["user"]]);
        $tentative = $stm->fetch();

        if(!$tentative) {
            $testsPending = $testsPending + 1;
        }
    }
    return $testsPending;
}

$pendingTests = getPendingTests();

if($pendingTests == 0) {
    $pendingTestsTexte = "aucun";
}
else {
    $pendingTestsTexte = $pendingTests;
}

?>

<div class="body-content">
    <div class="body-header">
        <p class="big">Elève <span><?php echo $_SESSION["fullname"]; ?></span></p>
        <p>Consultez les résultats de vos tests ici.</p>
        <p class="title">Vos résultats</p>
    </div>

<?php


        $sql = "SELECT * FROM tests ORDER BY id DESC";
        $stm = getPDO()->query($sql);
        $tests = $stm->fetchAll();
        $testsPending = 0;
        //req tentatives where test == testId AND auteur_id == userId
        
        foreach($tests as $test) {
            $sql = "SELECT * FROM tentatives WHERE test_id=? AND auteur_id=?";
            $stm = getPDO()->prepare($sql);
            $stm->execute([$test["id"],$_SESSION["user"]]);
            $tentative = $stm->fetch();
    
            if(!$tentative) {
        // tests à faire ici:
                if(time() > $test["date_max"]) {
                    $testDuration = "Non rendu.";
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
                                <p><span class="material-icons">assignment_late</span>';
                    echo $testDuration;
                    echo '</p>
                            </div>
                    ';

                    if($testAvailable == 1) {
                        echo '
                            <div class="expand">
                                <a href="?action=fairetest&id=';
                        echo $test["id"];
                        echo '"><button class="small" type="button">Répondre au test</button></a>
                            </div>
                        ';
                    }

                    echo '   </div>
                        <div class="unwrapped"></div>
                    </div>
                    ';
            }
// tests realises
            else {
                $testDuration = "Evalué.";
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
                                <p><span class="material-icons">assignment_returned</span>';
                    echo $testDuration;
                    echo '</p>
                            </div>
                    ';

                        echo '
                            <div class="expand">
                                <a href="?action=resultattest&id=';
                        echo $test["id"];
                        echo '"><button class="small" type="button">Voir mes résultats</button></a>
                            </div>
                        ';

                    echo '   </div>
                        <div class="unwrapped"></div>
                    </div>
                    ';
            }
        }
        return $testsPending;

?>
    
    


</div>