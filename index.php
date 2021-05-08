<?php require __DIR__ . '/vendor/autoload.php'; ?>
<?php require "inc/includes.php"; ?>
<?php require 'inc/header.php';  ?>
<style>
    @import "css/style_modal_box.css";
    @import "css/style_first.css";
    .navbar{
        display:none;
    }
</style>
<?php 
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
?>
<?php if(isset($_SESSION['flash'])):  ?>
    <?php foreach($_SESSION['flash'] as $type => $message):  ?>
        <div class="alert-<?= $type; ?>">
        <p><?= $message; ?></p>
        <?php unset($_SESSION['flash']);  ?>
    </div>
    <?php endforeach;  ?>
<?php endif;  ?>
<?php require 'inc/functions.php';  ?>

<div class="container">
        <div class="logos"><label><a><span>Ancheri</span>Ze</a></label></div>
        <!--div class="profile-photo"></div-->
        <div class="box-connexion">
            <div class="inscription"><a href="inscription.php">S'inscrire</a></div>           
            <div class="connexion"><a href="connexion.php">Se connecter</a></div>
        </div>
        <div class="what_is"><a href="#open-modal" >Qu'est ce que Ancherize ?</a></div>
    </div>

    <div id="open-modal" class="modal-window">
        <div>
            <a href="#modal-close" title="Close" class="modal-close"><i class="fa fa-close"></i></a>
            <h1>Qu'est ce que Ancheri<span>Ze</span> ?</h1>
            <div>
                <p>Ancherize est une application de publication et suivi de ventes aux enchères
                </p>    
            </div>
        </div>
</div>


<?php require 'inc/footer.php';  ?>