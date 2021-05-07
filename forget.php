<?php require "inc/includes.php"; ?>
<?php require "inc/functions.php"; ?>
<?php if_logged();  ?>
<?php require 'inc/header.php'; ?>
<style>
    .navbar{
        display:none;
    }
</style>
<?php 
    if(!empty($_POST)){
        $error = array();

        $rec_mail = test_input($_POST['rec_email']);
        $user = $anch->loadEmailConfirmed($rec_mail);

        if($user){
            
            $rec_token = str_random(60);
            $anch->saveForgetRequest($user, $rec_token);

            mail($rec_mail, "ANCHERIZE : Reinitialisation de mot de passe", "Cliquer sur ce lien pour reinitialise votre compte\n\nhttp://localhost/ancherizz/reinitialisation.php?id=$user->id&recup_token=$rec_token");
            $_SESSION['flash']['success'] = "Le lien de réinitialisation vous a été envoyé par mail";
            header('Location: connexion.php');
        }else{
            $_SESSION['flash']['error'] = "Cet email ne correspond à aucun compte actif";
            header('refresh:0');
        }




        // while($result = $req->fetch()){
        //     if($result->email == $rec_mail){
        //         $rec_token = str_random(60);
        //         $reqt = $pdo->prepare("UPDATE users SET reset_token = ?, reset_at = NOW() WHERE id = ?");
        //         $reqt->execute([$rec_token, $result->id]);
        //         $_SESSION['flash']['success'] = "Le lien de réinitialisation a bien été envoyé";
        //     }
        // }
    }
    //mail($rec_mail, "TRAIN:ZONE : Reinitialisation de mot de passe", "Cliquer sur ce lien pour reinitialise votre compte\n\nhttp://localhost/train.zone/reinitialisation.php?id=$result->id&recup_token=$rec_token");
                    
?>

<br>
<h1>Réinitialisation de mot de passe</h1>

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
<br>
<div class="alert-info" style="background-color:rgb(21, 153, 201);">
    <p>Un mail vous sera contenant un lien de récupération de mot de passe vous sera envoyé</p>
</div>

<form method="post">
<br>
    <table>
        <thead>
            <tr>
                <td><label for="rec_email">Email</label></td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><input type="email" name="rec_email" id="rec_email" required></td>
                <td><button style="background-color:rgb(21, 153, 201);" type="submit">Envoyer</button></td>
            </tr>
        </tbody>
    </table>
</form>

<?php require 'inc/footer.php';  ?>