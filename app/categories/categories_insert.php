<?php

include('../sys/connexion.php');

// si une requete est envoyee on la traite

if(isset($_POST['type']) && isset($_POST['titre']) && isset($_POST['desc']) && isset($_SESSION["user"])){
    $type = htmlentities($_POST['type']);
    $titre = htmlentities($_POST['titre']);
    $desc = htmlentities($_POST['desc']);
    $auteur_id = getUserSessionId();
    $date_creation = time();

    // check si les valeurs sont convenables
    if(strlen($titre) > 1 && strlen($titre) < 300 && strlen($_POST['desc']) > 1 && $type != '') {
        if($type == "question") {
            $requete = "insert into categories_questions(titre,description,auteur_id,date_creation) values(:titre,:description,:auteur_id,:date_creation)";
            // structuration des parametres et envoi a la base
            $param = array(':titre' => $titre, ':description' => $desc, ':auteur_id' => $auteur_id, ':date_creation' => $date_creation);
            $req   = $connexion->prepare($requete);
            $req->execute($param);
            echo json_encode(["response" => "success"]);
        }
        else {
            $requete = "insert into categories_test(titre,description,auteur_id,date_creation) values(:titre,:description,:auteur_id,:date_creation)";
            // structuration des parametres et envoi a la base
            $param = array(':titre' => $titre, ':description' => $desc, ':auteur_id' => $auteur_id, ':date_creation' => $date_creation);
            $req   = $connexion->prepare($requete);
            $req->execute($param);
            echo json_encode(["response" => "success"]);
        }
    }
    else {
        echo json_encode(["response" => "err_saisie"]);
    }
}


?>