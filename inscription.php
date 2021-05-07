<?php require 'inc/includes.php'; ?>
<?php require_once 'inc/functions.php';  ?>

<?php if_logged();  ?>
<?php 
        if(!empty($_POST)){
            $error = array();
            /**
             * Verification pseudo
             */
            if(!preg_match("/^[a-zA-Z0-9_]*$/",$_POST['pseudo'])){
                $error['pseudo'] = "Votre pseudo n'est pas valide !";
            }else{
                $pseudo = test_input($_POST['pseudo']);
                $user_existing = $anch->searchPseudo($pseudo);
                if($user_existing){
                    $error['pseudo'] = "Ce pseudo est déjà pris !";
                }
            }
            /**
             * Verification email
             */
            if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                $error['email'] = "Votre email n'est pas valide !";
            }else{
                $email = test_input($_POST['email']);
                $email_existing = $anch->searchEmail($email);
                if($email_existing){
                    $error['email'] = 'Cet email est déjà utilisé pour un autre compte !';
                }
            }

            /**
             * Verification de mot de passe
             */
            if(strlen($_POST['pwd']) <= 3){
                $error['pwd'] = "Veuillez choisir un mot de passe de minimum (4) caractères";
            }
            if($_POST['pwd'] != $_POST['pwdconf']){
                $error['pwdconf'] = "Veuillez bien confirmer votre mot de passe !";
            }
            
            if(empty($error)){
                $pwd = test_input(password_hash($_POST['pwd'], PASSWORD_BCRYPT));
                $pwdconf = test_input($_POST['pwdconf']);
                $token = str_random(60);
                $anch->addUser_with_token($pseudo, $email, $pwd, $token);

                $user_id = $anch->lastInsertId();
                mail($_POST['email'], "Ancherize : Confirmation de votre compte", "Afin de valider votre compte merci de cliquer sur ce lien \n\nhttp://localhost/ancherizz/confirm.php?id=$user_id&token=$token");
                $_SESSION['flash']['success'] = "Votre compte a bien été créé. Vérifier vos mails afin d'activer votre compte.";
                header('Location: connexion.php');
                exit();
            }          
        
        }
?>
<?php require 'inc/header.php';  ?>
<style>
    @import "css/style_inscription.css";
    .navbar{
        display:none;
    }
</style>

<?php if(!empty($error)):  ?>
        <br>
        <div class="alert-error">
            <p>Vous n'avez pas rempli le formulaire correctement !</p>
            <ul>
                <?php foreach($error as $errors): ?>
                    <li><?= $errors; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
<?php endif;  ?>
<div class="container">
        <div class="insc"><label>INSCRIPTION</label></div>

        <form action="" method="post">
            <input class="area" name="pseudo" placeholder="Nom utilisateur" type="text" required>
            <input class="area" name="email" placeholder="Email" type="email" required>
            <input class="area" name="pwd" placeholder="Mot de passe" type="password" required>
            <input class="area" name="pwdconf" placeholder="Confirmation de mot de passe" type="password" required>
            
        
            
            <label for="clause" class="check">
                <input type="checkbox" name="clause" id="clause">
                
                Accepter les <br><a href="#" style="color:rgb(21, 153, 201);">conditions d'utilisation</a>
            </label>
            <button type="submit">S'inscrire</button>
            <div class="connexion"><a href="connexion.php" >Je suis déjà membre</a></div>
        </form>
    </div>

<?php require 'inc/footer.php';  ?>