<?php require "inc/includes.php"; ?>
<?php require "inc/functions.php"; ?>
<?php logged_only(); ?>
<?php

$correctExt = array('jpg' , 'jpeg' , 'gif' , 'png', 'JPG', 'JPEG', 'GIF', 'PNG');
$maxsize = 8*1048576;
$nameImage = 'img/article/' .  'anch_article_' . md5(uniqid(rand(), true)) . '.';

if(!empty($_POST) && !empty($_FILES['chImage'])) {
    if(!empty($_POST['libel']) && !empty($_POST['startPrice']) && !empty($_POST['endDate']) && !empty($_POST['endTime']) && $_POST['startPrice'] > 0 && !empty($_POST['description']) && $_FILES['chImage']['error'] != UPLOAD_ERR_NO_FILE) {
        
        $info_file = pathinfo($_FILES['chImage']['name']);

        if(in_array($info_file['extension'], $correctExt) && $maxsize>=$_FILES['chImage']['size']) {

            $nameImage = $nameImage . $info_file['extension'];
            $answer = move_uploaded_file($_FILES['chImage']['tmp_name'], $nameImage);

            if($answer) {

                if(isset($_POST['endDate']) && isset($_POST['endTime'])) {
                    $ed = strtotime($_POST['endDate'] . " " . $_POST['endTime']);
                    $endDate = date("y-m-d H:i:s", $ed);
                }

                $article = new Article($nameImage, $_POST['libel'], $_POST['description'], $_POST['startPrice'], $endDate, $nameImage, $_SESSION['auth']->pseudo());
                $anch->addArticle($article);

                $_SESSION['flash']['success'] = "Article publié avec succès";

                if(isset($_POST['go'])){
                    header("Location: pub.php");
                } else {
                    header("Location: account.php");
                }
            } else {

                $_SESSION['flash']['error'] = "Problème de téléchargement de l'image";
                header("Location: pub.php");
            }
        } else {

            $_SESSION['flash']['error'] = "Extension non valide ou image trop volumineuse";
            header("Location: pub.php");
        }
    } else {
        $_SESSION['flash']['error'] = "Vous n'avez rempli tous les champs du formulaire ou avez renseigné une mauvaise valeur de champs";
        header("Location: pub.php");
    }
} else {
    $_SESSION['flash']['error'] = "Vous n'avez rempli aucun champ du formulaire";
    header("Location: pub.php");
}

?>