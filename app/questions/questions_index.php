
<?php
if(isset($_SESSION["user"])) {
    echo "<div class='subnav'><ul>";
    # en tant qu admin

    if(isset($_SESSION["role"]) == 1) {
        echo "
            <a href='?action=questions-index' class='active'><li><span class='material-icons'>view_quilt</span>Vue d'ensemble</li></a>
            <a href='?action=questions-create' class='green'><li><span class='material-icons'>add</span>Créer une question</li></a>
        ";
    }
    # en tant qu utilisateur

    echo "</ul></div>";
    echo "<a href='?action=questions-create' style='z-index:999;'><div class='button-page-fixed-rounded blue'><span class='material-icons'>add</span><p>Nouvelle question</p></div></a>";
}

?>

<div class="body-content">
    <div class="body-header">
        <p class="big">Toutes les questions créees </p>
        <p>Consultez les questions créees.</p>
    </div>

<?php



        $sql = "SELECT * FROM questions ORDER BY id DESC";
        $stm = getPDO()->query($sql);
        $questions = $stm->fetchAll();
        
        $questionSupprimable = 0;

        foreach($questions as $question) {
                    echo '
                        <div class="section-wrap">
                        <div class="wrapped">
                            <div class="title">
                                <p><span class="material-icons">quiz</span>';
                    echo $question["intitule"];
                    echo ' • </p>
                                <p><span class="material-icons">emoji_events</span>';
                    echo $question["valeur_pts"];
                    echo ' points</div><div class="expand">';             

                    echo '</div></div>
                        <div class="unwrapped"></div>
                    </div>
                    ';
        }

?>
    
</div>