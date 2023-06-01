<?php

include('../sys/connexion.php');
// si une requete est envoyee on la traite
if(isset($_POST['titre']) && isset($_POST['description']) && isset($_POST['temps']) && isset($_POST['tentatives']) && isset($_POST['arrondi_note']) && isset($_POST['questions']) && isset($_SESSION["user"])){
    $titre     = htmlentities($_POST['titre']);
    $questions = $_POST['questions'];
    $description    = htmlentities($_POST['description']);
    $temps    = htmlentities($_POST['temps']);
    $tentatives = htmlentities($_POST['tentatives']);
    $arrondi_note = htmlentities($_POST['arrondi_note']);
    $categorie     = htmlentities($_POST['categorie']);
    $auteur_id  = getUserSessionId();
    $date_creation = time();
    $date_max = $date_creation + ($temps * 60);

    // check si les valeurs sont convenables
    if($tentatives > 0 && $temps > 0 && $arrondi_note > 0)
    {
            $requete = "insert into tests(titre,description,temps,date_max,date_creation,date_publish,tentatives,questions,publication,categorie,auteur,arrondi_note) values(:titre,:description,:temps,:date_max,:date_creation,:date_publish,:tentatives,:questions,:publication,:categorie,:auteur,:arrondi_note)";
            // structuration des parametres et envoi a la base
            $param = array(':titre' => $titre,
            ':description' => $description,
            ':temps' => $temps,
            ':date_max' => $date_max,
            ':date_creation' => $date_creation,
            ':date_publish' => $date_creation,
            ':tentatives' => $tentatives,
            ':questions' => json_encode($questions),
            ':publication' => 0,
            ':categorie' => $categorie,
            ':auteur' => $auteur_id,
            ':arrondi_note' => $arrondi_note,
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