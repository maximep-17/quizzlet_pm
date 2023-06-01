
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
        <p class="big">Bienvenue <span><?php echo $_SESSION["fullname"]; ?></span></p>
        <p>Vous avez <?php echo $pendingTestsTexte; ?> tests à finaliser.</p>
        <p class="title">Tests en cours</p>
    </div>

<?php
    if($pendingTests > 0)
    {
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
        // tests à faire ici:
                if(time() > $test["date_max"]) {
                    $testDuration = "Le temps est écoulé.";
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
                                <p><span class="material-icons">restart_alt</span>';
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
        }
        return $testsPending;
    }
    else {
        echo "Aucun test n'est disponible pour le moment.";
    }

?>
    
    


</div>