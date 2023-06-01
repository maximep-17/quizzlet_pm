
<?php
    if(isset($_SESSION["user"]) && isset($_SESSION["role"]) == 1 && isset($_GET["id"])) {
        $testId = htmlentities($_GET["id"]);

        $sql = "UPDATE tests SET publication=? WHERE id=?";
        getPDO()->prepare($sql)->execute([1, $testId]);

        header('Location:index.php');
    }
    else {
        header('Location:index.php');
    }
?>