<?php require "inc/includes.php"; ?>
<?php require "inc/functions.php"; ?>
<?php logged_only();  ?>
<?php require 'inc/header.php';  ?>

<style>
    @import 'css/style_account.css';
</style>

<?php 
    if(!empty($_POST['old_pwd']) && !empty($_POST['new_pwd']) && !empty($_POST['conf_pwd'])){
        $new_pwd = test_input($_POST['new_pwd']);
        if(strlen($new_pwd) <= 3){
            $_SESSION['flash']['error'] = "Veuillez choisir un mot de passe de minimum (4) caractères";
        }else{
            if($new_pwd != $_POST['conf_pwd']){
                $_SESSION['flash']['error'] = "Les mots de passe ne correspondent pas";
                header("Refresh:0");
            }else{
                if(password_verify($_POST['old_pwd'], $_SESSION['auth']->pwd())){
                    if(password_verify($new_pwd, $_SESSION['auth']->pwd())){
                        $_SESSION['flash']['error'] = "Essayer un mot de passe différent de l'ancien";
                        header("Refresh:0");
                    } else {

                        $new_pwd = password_hash($new_pwd, PASSWORD_BCRYPT);
                        $anch->updatePwd($_SESSION['auth'], $new_pwd);
                        $_SESSION['auth']->set_pwd($new_pwd);
                        $_SESSION['flash']['success'] = "Mot de passe modifier avec succès";
                        header("Refresh:0");

                    }
                }else{
                    $_SESSION['flash']['error'] = "Mot de passe incorrect";
                    header("Refresh:0");
                }
            }
        }
    }


    if(!empty($_POST['pwd_del'])){
        $pwd_del = test_input($_POST['pwd_del']);
        if(password_verify($pwd_del, $_SESSION['auth']->pwd())) {
                if($anch->deleteUser($_SESSION['auth']->pseudo())) {
                    header('Location:deconnexion.php');
                    $_SESSION['flash']['success'] = "Compte supprimé avec succès ! Ne reviens plus jamais !";
                } else {
                    header('Refresh:0');
                    $_SESSION['flash']['error'] = "Vous ne lisez pas ? Vous êtes impliqué dans une enchère.<br/> Impossible de vous désinscrire maintenant!";
                }
            
        }else{
            $_SESSION['flash']['error'] = "Mot de passe incorrect ! Sale pirate";
        }
    }
    if(!empty($_POST['sale'])){
        if($_POST['sale']>0){
            $_SESSION['auth']->set_sale($_POST['sale']);
            $anch->updateSaleUser($_POST['sale'], $_SESSION['auth']);
            $_SESSION['flash']['success'] = "Rechargement effectué";
            header('Refresh:0');
            
        }else{
            $_SESSION['flash']['error'] = "Montant invalide";
            header('Refresh:0');
        }
    }
?>


<?php $user_articles = $anch->loadArticles($_SESSION['auth']->pseudo()); ?>
<?php $user_anch_articles = $anch->loadAnchArticles($_SESSION['auth']->pseudo()); ?>

<div class="wrapper">
        <h1>Hello <span style="color:rgb(21, 153, 201);"><?php echo $_SESSION['auth']->pseudo(); ?></span></h1>
        <div class="account">
            <div class="statsEnchere">
                <div class="myauction">
                    <div class="title">
                        <h3>Mes enchères</h3>
                    </div>
                    <div class="content-stats">
                    <?php if($user_articles): ?>
                        <?php foreach($user_articles as $key => $value): ?>
                            <a href="descArticle.php?numArt=<?php echo $value['idArticle']; ?>">
                                <div>
                                    <span>
                                       
<?php if($value['state']): ?>
    <i class="fa fa-circle" style="color:crimson; margin-right:10px;"></i>
<?php else: ?>
    <i class="fa fa-circle" style="color:lightgreen; margin-right:10px;"></i>
<?php endif; ?>
                                    
                                    <?php print_min_libel($value['libel']); ?></span>
                                    <span> - </span>
                                    <span>PA :</span>
                                    <span><?php print_min_libel($value['hightPrice']); ?>$</span>
                                </div>
                            </a>
                            <br />
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Pas d'articles</p>
                    <?php endif; ?>
                    </div>
                </div>

                <div class="inAuction">
                    <div class="title">
                        <h3>Participation</h3>
                    </div>
                    <div class="content-stats">
                    <?php if($user_anch_articles): ?>
                        <?php foreach($user_anch_articles as $key => $value): ?>
                            <a href="descArticle.php?numArt=<?php echo $value['idArticle']; ?>">
                                <div>
                                    <span><?php print_min_libel($value['libel']); ?></span><span> - </span>
                                    <span>PA :</span>
                                    <span><?php print_min_libel($value['hightPrice']); ?>$</span>
                                </div>
                            </a>
                            <br />
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Pas d'articles</p>
                    <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="manageaccount">
                <div class="title"><h3>Gérer mon compte</h3></div>
                <div class="content-manage">
                    <form action="account.php" method="post">
                    
                        <h4><label style='color:rgb(101, 101, 233)'>Solde actuel: <?php echo htmlspecialchars($_SESSION['auth']->sale()); ?>$</label></h4>
                        <h4><label for="sale">Portefeuille d'enchère: <?php echo htmlspecialchars($_SESSION['auth']->bidSale()); ?>$</label></h4>
                        <br />
                        <h4><label for="sale">Recharger votre solde</label></h4>
                        <input type="text" name="sale" id="sale" placeholder="Somme à ajouter"><br>
                        <button type="submit">Recharger</button>
                    </form>
                    <br>
                    <h4><label>Modification de mot de passe</label></h4>
                    <form action="account.php" method="post" class="changepwd">
                        <div>
                            <input type="password" name="old_pwd" placeholder="Mot de passe">
                            <input type="password" name="new_pwd" placeholder="Nouveau mot de passe">
                            <input type="password" name="conf_pwd" placeholder="Confirmer nouveau mdp">
                        </div>
                        <button type="submit">Modifier mot de passe</button>

                    </form>
                    <br>
                    <form action="account.php" method="post">
                        <h4><label for="pwd_del">Supprimer le compte</label></h4>
                       
                        <input type="password" name="pwd_del" id="pwd_del" placeholder="Votre mot de passe" required><br>
                        <small>Vous ne pouvez vous désinscrire si vous êtes impliqué dans une enchère en cours</small>
                        <br>
                        <button style="background-color: crimson;" type="submit" onclick="return confirm('Voulez vous vraiment supprimer votre compte ?')">Supprimer compte</button>
                       </form>
                </div>
            </div>
        </div>
    </div>
<br><br>

<?php require 'inc/footer.php';  ?>
