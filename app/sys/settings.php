

<div class="body-content">
    <div class="body-header">
        <p class="big">Gestion des utilisateurs</p>
        <b>Consultez tous les utilisateurs existants.</b><hr>
    </div>

<?php

        $sql = "SELECT * FROM users ORDER BY id DESC";
        $stm = getPDO()->query($sql);
        $users = $stm->fetchAll();
        $isAdmin = 0;

        foreach($users as $user) {
            if($user["id"] == $_SESSION["user"]) {
                $isAdmin = 2;
            }
            else {
                if($user["role"] == 0) {
                    $isAdmin = 0;
                }
                if($user["role"] == 1) {
                    $isAdmin = 1;
                }
            }
                    echo '
                        <div class="section-wrap">
                        <div class="wrapped">
                            <div class="title">
                                <p><span class="material-icons">person</span>';
                    echo $user["nom_public"];
                    echo ' • </p>
                                <p><span class="material-icons">phone</span>';
                    echo $user["phone"];
                    echo '</div><div class="expand">';             

                    if($isAdmin == 0) {
                        echo '<a href="?action=user_rank&id=' . $user["id"] . '""><button class="small" type="button">Définir comme enseignant</button></a>';
                    }
                    elseif($isAdmin == 1) {
                        echo '<a href="?action=user_derank&id=' . $user["id"] . '""><button class="small" type="button">Définir comme élève</button></a>';
                    }
                    else {
                        echo '<a href="#"><button class="small" type="button" disabled>Vous-même</button></a>';
                    }

                    echo '</div></div>
                        <div class="unwrapped"></div>
                    </div>
                    ';
        }

?>
    
</div>