<?php

include('../sys/connexion.php');
// si une requete est envoyee on la traite
if(isset($_POST['intitule']) && isset($_POST['propositions']) && isset($_POST['reponses']) && isset($_POST['format']) && isset($_POST['niveau']) && isset($_POST['categorie']) && isset($_POST['valeur_pts']) && isset($_SESSION["user"])){
    $intitule     = htmlentities($_POST['intitule']);
    $propositions = $_POST['propositions'];
    $reponses  = $_POST['reponses'];
    $format    = htmlentities($_POST['format']);
    $niveau    = htmlentities($_POST['niveau']);
    $categorie = htmlentities($_POST['categorie']);
    $valeur_pts = htmlentities($_POST['valeur_pts']);
    $auteur_id  = getUserSessionId();
    $date_creation = time();

    // check si les valeurs sont convenables
    if($format != '' && $categorie != '' && $niveau != '' && $valeur_pts > 0)
    {
            $requete = "insert into questions(intitule,propositions,reponses,format,niveau,categorie,auteur_id,date_creation,date_modification,valeur_pts) values(:intitule,:propositions,:reponses,:format,:niveau,:categorie,:auteur_id,:date_creation,:date_modification,:valeur_pts)";
            // structuration des parametres et envoi a la base
            $param = array(':intitule' => $intitule,
            ':propositions' => json_encode($propositions),
            ':reponses' => json_encode($reponses),
            ':format' => $format,
            ':niveau' => $niveau,
            ':categorie' => $categorie,
            ':auteur_id' => $auteur_id,
            ':date_creation' => $date_creation,
            ':date_modification' => $date_creation,
            ':valeur_pts' => $valeur_pts,
            );
            $req   = $connexion->prepare($requete);
            $req->execute($param);
            echo json_encode(["response" => "success"]);
    }
    else {
        echo json_encode(["response" => "err_saisie"]);
    }
}


?>