
<div class="body-content" id="landing">
    <div class="login-page">

        <?php
            $disppage = 0;
            if($disppage == 0) {
                echo "<div class='form-inline'>";
            }
            else {
                echo "<div class='form-inline invisible'>";
            }
        ?>

            <h4>Connectez-vous</h4>
            
            <form action="?action=login" method="post">
                <div class="form-input">
                    <input type="email" placeholder="E-mail" name="email" id="email" required>
                </div>
                <div class="form-input">
                    <input type="password" placeholder="Mot de passe" name="pswd" id="pswd" required>
                </div>
                <div class="form-input">
                    <button type="submit"><span class="material-icons">send</span></button>
                </div>
            </form>
        </div>

        <?php
            if($disppage == 0) {
                echo "<h5><a href='?action=inscription'>Ou inscrivez-vous</a></h5>";
            }
        ?>
        
    </div>

</div>

<script>

</script>