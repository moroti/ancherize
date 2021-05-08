<?php require "inc/includes.php"; ?>
<?php require "inc/functions.php"; ?>
<?php if_logged_root();  ?>
<?php require 'inc/header.php';  ?>

<style>
    @import "css/style_connexion.css";
    .navbar{
        display: none;
    }
</style>

<?php

    if(!isset($_GET['spw']) || !$anch->checkSpecialWord($_GET['spw'])) {
        header("Location: index.php");
        exit();
    }

?>

<div class="container">
    <!--div class="logos"><label>IFRI LAB</label></div-->
    <div class="connect"><label>ADMIN</label> </div>
    <!--div class="profile-photo"></i></div-->
    <span>
        <form action="postroot.php" method="post">
            <input placeholder="Pseudo ADMIN" name="root_ps" type="text" required>
            <input placeholder="Mot de passe" name="root_pwd" type="password" required>
            <button type="submit">Se connecter</button>
        </form>    
    </span>
    <div class="forgot_passwd"><a href="forget.php" >Mot de passe oublié ?</a></div>
    <div style="text-align: center; margin: 50px;"><a href="inscription.php" >Je n'ai pas de compte</a></div>
</div>

<?php require 'inc/footer.php';  ?>