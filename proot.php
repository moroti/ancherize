<?php require "inc/includes.php"; ?>
<?php require "inc/functions.php"; ?>
<?php logged_only();  ?>
<?php logged_only_root();  ?>
<?php require 'inc/header.php';  ?>


<style>
    @import 'css/style_proot.css';
</style>



<div class="wrapper">
        <h1>Hello <span style="color:rgb(21, 153, 201);"><?php echo $_SESSION['root']['access']; ?> <?php echo $_SESSION['auth']->pseudo(); ?></span></h1>
        <div class="account">
            <div class="statsEnchere">
                <div class="div-users">
                    <div class="title">
                        <h3>Utilisateurs</h3>
                    </div>
                    <div class="content-stats">
                        
                    </div>
                </div>

                <div class="div-articles">
                    <div class="title">
                        <h3>Articles de l'utilisateur</h3>
                    </div>
                    <div class="content-stats">
                        <p>Selectionner un utilisateur pour voir ses articles</p>
                    </div>
                </div>
            </div>
        </div>
</div>

<script src="js/prootApp.js"></script>

<?php require 'inc/footer.php';  ?>