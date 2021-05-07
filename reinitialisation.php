<?php require 'inc/includes.php'; ?>
<?php require 'inc/functions.php'; ?>
<?php if_logged();  ?>
<?php require 'inc/header.php'; ?>

<?php 

    if(!empty($_POST)){
        $new_pwd = test_input($_POST['new_pwd']);
        $conf_pwd = test_input($_POST['conf_pwd']);
        if(strlen($new_pwd) <= 3){
            $_SESSION['flash']['error'] = "Veuillez choisir un mot de passe de minimum (4) caractères";
            header('refresh:0');
        }else{
            if($new_pwd == $conf_pwd){
                if(isset($_GET['id']) && isset($_GET['recup_token'])){
                    if(!empty($_GET)){
                        $user_id = (int)test_input($_GET['id']);
                        $rec_token = test_input($_GET['recup_token']);
                        
                        $new_pwd = password_hash($new_pwd, PASSWORD_BCRYPT);
                        
                        $user_exist = $anch->loadUserId($user_id);

                        if($user_exist && $rec_token == $user_exist['reset_token']){
                            $anch->doReset($new_pwd, $user_exist);
                            $_SESSION['flash']['success'] = "Mot de passe réinitialisé avec succès";
                            //$_SESSION['ki'] = $lo;
                            $usr = new Utilisateur($user_exist['id'],$user_exist['pseudo'], $user_exist['email'], $user_exist['pwd'], $user_exist['sale'], $user_exist['bidSale']);
                            $_SESSION['auth'] = $usr;
                            header('Location: account.php');
                        }else{
                            $_SESSION['flash']['error'] = "Token invalid";
                            header('Location: index.php');
                        }
                        //$req = $pdo->prepare("UPDATE users SET pwd = ? WHERE id = ?");

                    }else{
                        $_SESSION['flash']['error'] = "Informations nécessaires inexitantes, reprenez la procédure";
                        header('Location: index.php');
                    }
                }else{
                    $_SESSION['flash']['error'] = "Certaines informations attendues sont inexistantes";
                    header('Location: index.php');
                }
            }else{
                $_SESSION['flash']['error'] = "Les mots de passes ne correspondent pas !";
                header('refresh:0');
            }
        }
    }

?>
<br>
<h2>Réinitialisation de mot de passe:</h2>
<form action ="" method="post">
    <br>
        <table>
            <thead>
                <tr>
                    <td><label for="new_pwd">Nouveau mot de passe </label></td>
                    <td><label for="conf_pwd">Confirmer nouveau mdp</label></td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="password" name="new_pwd" id="new_pwd" required></td>
                    <td><input type="password" name="conf_pwd" id="conf_pwd" required></td>
                    <td><button type="submit">Modifer mon mot de passe</button></td>
                </tr>
            </tbody>
        </table>
</form>


<br><br><br><br><br>
<?php debug($_SESSION);  ?>

<?php require 'inc/footer.php';  ?>
