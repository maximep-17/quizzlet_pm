<?php
    ### ajout d'une subnav si l utilisateur est connecte => subnav tests
    if(isset($_SESSION["user"])) {
        echo "<div class='subnav'><ul>";
        # en tant qu admin

        if(isset($_SESSION["role"]) == 1) {
            echo "
                <a href='' class='active'><li><span class='material-icons'>view_quilt</span>Vue d'ensemble</li></a>
                <a href='?action=tests-statistics'><li><span class='material-icons'>auto_graph</span>Consulter les tests</li></a>
                <a href='?action=tests-create' class='green'><li><span class='material-icons'>add</span>Créer un test</li></a>

            ";
        }
        # en tant qu utilisateur

        echo "</ul></div>";
        echo "<a href='?action=tests-create'><div class='button-page-fixed-rounded blue'><span class='material-icons'>add</span><p>Nouveau test</p></div></a>";
    }
?>