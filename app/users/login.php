<?php


if(isset($_SESSION["user"])) {
    $disppage = 1;
    $message = "Bienvenue " . $_SESSION["fullname"] . ", vous êtes maintenant connecté au service.<br>Le reste arrive bientôt.";
}
else {
    $disppage = 0;
    $message = "";
}

// si une requete est envoyee on la traite

if(isset($_POST['email']) && isset($_POST['pswd'])){
    $email = htmlentities($_POST['email']);
    $pswd = hash("sha512", $_POST['pswd']);

    // check si les valeurs sont convenables
    if(strlen($email) < 30 && strlen($_POST['pswd']) < 30) {

        // check si l'user email ainsi que son password existe
        $req = $connexion->prepare("SELECT * FROM users WHERE email=? AND passwd=?");
        $req->execute([$email,$pswd]); 
        $userlogin = $req->fetch();
        $name = $userlogin['nom_public'];
        $userid = $userlogin['id'];
        $userrole = $userlogin['role'];
        if ($userlogin) {
            // les logins sont bons

            $_SESSION["user"] = $userid;
            $_SESSION["fullname"] = $name;
            $_SESSION["userid"] = $userid;
            $_SESSION["role"] = $userrole;
            
            header('Location:index.php');
        } else {
            $message = "<br><b>Veuillez vérifier vos informations de connexion.</b><br><a href='index.php'>Retourner à l'accueil</a>";
            echo $message;

        }
    }
    else {
        $message = "<br><b>Les informations que vous avez entrées sont trop longues. (max 30 caractères).</b><br><a href='index.php'>Retourner à l'accueil</a>";
        echo $message;
    }
}

// sinon on affiche le form

else {
    $email = '';
    $pswd = '';
}

?>