<?php require "inc/includes.php"; ?>
<?php require "inc/functions.php"; ?>
<?php logged_only();  ?>
<?php logged_only_root();  ?>

<?php

if(isset($_GET['ps'])) {
    if($anch->root_del_user($_GET['ps'])) {
        $_SESSION['flash']['success'] = "Utilisateur supprimé avec succès";
    } else {
        $_SESSION['flash']['error'] = "Erreur de suppression";
    }
} elseif(isset($_GET['idArt'])) {
    if($anch->root_del_article($_GET['idArt'])) {
        $_SESSION['flash']['success'] = "Article supprimé avec succès";
    } else {
        $_SESSION['flash']['error'] = "Erreur de suppression";
    }
}
header("Location: proot.php");

?>