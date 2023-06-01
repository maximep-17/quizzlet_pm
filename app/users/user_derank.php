
<?php
# modifier le role de l utilisateur

    if(isset($_SESSION["user"]) && isset($_SESSION["role"]) == 1 && isset($_GET["id"])) {
        $testId = htmlentities($_GET["id"]);

        $sql = "UPDATE users SET role=? WHERE id=?";
        getPDO()->prepare($sql)->execute([0, $testId]);

        header('Location:index.php?action=settings');
    }
    else {
        header('Location:index.php');
    }
?>