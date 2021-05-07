<?php 

    require "inc/includes.php";
    require "inc/functions.php";
    logged_only();



    if(!empty($_POST['saleBid']) && !empty($_POST['idArticle']) && !empty($_POST['price']) && !empty($_POST['h_price'])){
        if($_POST['saleBid']>0){
            
            if($_SESSION['auth']->tobid($_POST['saleBid'], $_POST['price'], $_POST['h_price'])) {

                $anch->tobid($_SESSION['auth'], $_POST['idArticle'], $_POST['saleBid']);
                $_SESSION['flash']['success'] = "Vous proposez " . $_POST['saleBid'] . "$ pour cet article.";
                header("Location: descArticle.php?numArt=" . $_POST['idArticle']);

            } else {

                $_SESSION['flash']['error'] = "Votre solde est très insuffisant ou faible pour encherir.";
                header("Location: descArticle.php?numArt=" . $_POST['idArticle']);

            }
            
        }else{
            $_SESSION['flash']['error'] = "Montant invalide";
            header("Location: descArticle.php?numArt=" . $_POST['idArticle']);
        }
    } else {
        header("Location: descArticle.php");
    }

?>