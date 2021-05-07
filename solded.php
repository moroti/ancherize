<?php require "inc/includes.php"; ?>
<?php require "inc/header.php";  ?>
<?php require "inc/functions.php";  ?>
<?php logged_only();  ?>

<style>
    @import "css/style_acceuil.css";
</style>
<!--  -->
<div class="wrapper">

    <!-- CHARGEMENT DES ARTICLES -->
    <?php $articles = $anch->loadAllArticlesSolded(); ?>

                    
    <div class="title-acceuil">
    <a href="solded.php" style="color: rgb(28, 101, 179); font-weight:bold;">Articles vendus</a>
    <i class="fa fa-caret-right" style="margin: 0 8px;"></i>
    <a href="accueil.php" style="color: slategrey;">Enchère en cours</a>
    </div>

    <h1>Articles vendus</h1>

  <div class="wrapper">

    <div class="row">
        <?php if($articles): ?>
            <?php foreach ($articles as $key => $value): ?>
                <div class="column">
                    <div class="card">
                        <a href="descArticle.php?numArt=<?php echo htmlspecialchars($value['idArticle']); ?>"><div style="height:300px;background-image: url(<?php echo htmlspecialchars($value['chImage']); ?>);background-repeat: no-repeat;background-size: cover;background-position: center;"></div></a>
                        <div class="container">
                        <div class="desc">
                            <h3><?php echo print_libel($value['libel']); ?></h3>
                            <p class="startBid">Montant de départ: <?php echo print_min_libel($value['startPrice']); ?>$</p>
                            <p>Nombre d'enchérisseurs : <?php echo htmlspecialchars($value['countBidder']); ?></p>
                            <p>Proposition actuel: <?php echo print_min_libel($value['hightPrice']); ?>$</p>
                            
                            <a href="descArticle.php?numArt=<?php echo $value['idArticle']; ?>" class="button"><i class="fa fa-plus"></i> Voir plus</a>
                        </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Pas d'articles dans ce système</p>
        <?php endif; ?>

    </div>

  </div>

<?php require "inc/footer.php";  ?>