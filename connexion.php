    <?php require "inc/includes.php"; ?>
    <?php require "inc/functions.php"; ?>
    <?php if_logged();  ?>
    <?php require 'inc/header.php';  ?>
    <style>
        @import "css/style_connexion.css";
    .navbar{
        display:none;
    }
    </style>
    <?php 
        $error = array();
        if(!empty($_POST) && !empty($_POST['user_in']) && !empty($_POST['pswd'])){

                $user = $anch->loadUser($_POST['user_in']);
                
                if(isset($user) && !empty($user)){
                    
                    if(password_verify($_POST['pswd'], $user['pwd'])){
                        if($user['confirmed_at'] != NULL){
                            $usr = new Utilisateur($user['id'],$user['pseudo'], $user['email'], $user['pwd'], $user['sale'], $user['bidSale']);
                            $_SESSION['auth'] = $usr;
                            $_SESSION['flash']['success'] = "Vous avez bien été connecté";
                            header('Location: account.php');
                            exit();
                        }else{
                            $_SESSION['flash']['warning'] = "En attente de validation";
                        }
                    }
                    else{
                        $error['pswd'] = "Identifiant ou mot de passe incorrecte";
                    }
                }else{
                    $error['user_in'] = "Identifiant ou mot de passe incorrecte (user)";
                }
        }

    ?>


    <?php if(!empty($error)):  ?>
            <br>
            <div class="alert-error">
                <ul>
                    <?php foreach($error as $errors): ?>
                        <li><?= $errors; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
    <?php endif;  ?>

<div class="container">
        <!--div class="logos"><label>IFRI LAB</label></div-->
        <div class="connect"><label>connexion</label> </div>
        <!--div class="profile-photo"></i></div-->
        <span>
            <form action="" method="post">
                <input placeholder="Nom utilisateur" name="user_in" type="text" required>
                <input placeholder="Mot de passe" name="pswd" type="password" required>
                <button type="submit">Se connecter</button>
            </form>    
        </span>
        <div class="forgot_passwd"><a href="forget.php" >Mot de passe oublié ?</a></div>
        <div style="text-align: center; margin: 50px;"><a href="inscription.php" >Je n'ai pas de compte</a></div>
</div>

    <?php require 'inc/footer.php';  ?>
