<?php

include('../sys/connexion.php');
// si une requete est envoyee on la traite
if(isset($_POST['testid']) && isset($_SESSION["user"])){
    $reponses = $_POST['reponses'];
    $auteur_id  = getUserSessionId();
    $date_submit = time();
    $test_id = htmlentities($_POST["testid"]);

    $sql = "SELECT * FROM tests WHERE id=?";
    $stm = getPDO()->prepare($sql);
    $stm->execute([$test_id]);
    $test = $stm->fetch();

// verif. si test existant, si publie, si encore dispo, si tentative deja envoye, sinon on envoie

    if(!$test) {
        echo json_encode(["response" => "err_notavail"]);
    }
    else {
        if($test["publication"] == 0) {
            echo "Le test demandé n'est pas publié.";
            echo json_encode(["response" => "err_notpublished"]);
        }
        else {
            if(time() > $test["date_max"]) {
                echo json_encode(["response" => "err_timeout"]);
            }
            else {

                $sql = "SELECT * FROM tentatives WHERE test_id=? AND auteur_id=?";
                $stm = getPDO()->prepare($sql);
                $stm->execute([$test_id, $auteur_id]);
                $tentative = $stm->fetch();

                if($tentative) {
                    echo json_encode(["response" => "err_alreadysubmit"]);
                }
                else {
// on peut send la requete
                    $requete = "insert into tentatives(auteur_id,test_id,tentative_no,reponses) values(:auteur_id,:test_id,:tentative_no,:reponses)";
                    // structuration des parametres et envoi a la base
                    $param = array(':auteur_id' => $auteur_id,
                    ':test_id' => $test_id,
                    ':tentative_no' => 1,
                    ':reponses' => json_encode($reponses),
                    );
                    $req   = $connexion->prepare($requete);
                    $req->execute($param);
                    echo json_encode(["response" => "success"]);
                }
            }
        }
    }
}


?>