<?php require "inc/includes.php"; ?>
<?php require 'inc/functions.php';  ?>
<?php require 'inc/header.php';  ?>
<style>
    @import "css/style_description.css";
    @import "css/style_modal.css";
</style>

    <!-- <div class="wrapper">
        <div class="articleImg"><img src="img/bg_idm.jpg" alt=""></div>
        <div class="desc">Auc</div>
    </div> -->
    <div class="wrapper">

    <!-- Chargement de l'article -->

    <?php if(isset($_GET['numArt']) && $_GET['numArt'] >= 0): ?>
        <?php $article = $anch->loadArticle($_GET['numArt']); ?>
        <?php if($article): ?>

            <div class="block">
                <div class="img-content"><img src="<?php echo htmlspecialchars($article['chImage']); ?>" alt="" style="height: 100%;object-fit: cover;"></div>
                <div class="desc">
                    <div>
                        <h2><?php echo htmlspecialchars($article['libel']); ?></h2>
                        
                        <small><?php echo htmlspecialchars($article['datePub']); ?></small>
                        <small class="h-date" style="color:crimson;"><?php echo htmlspecialchars($article['hightDate']); ?></small>
                        <br><br>
                        <blockquote><?php echo htmlspecialchars($article['description']); ?></blockquote>
                        <br>
                        <h3 class="startBid">Montant de départ: <?php echo htmlspecialchars($article['startPrice']); ?>$</h3>
                        <p>Nombre d'enchérisseurs : <?php echo htmlspecialchars($article['countBidder']); ?></p>
                        <p>Proposition actuel: <?php echo htmlspecialchars($article['hightPrice']); ?>$</p>
                        <?php if($article['state']): ?>
                            <p>Etat: <strong state="1" class="a-state" style="color: red;">Vendu</strong></p>
                        <?php else: ?>
                            <p>Etat: <strong state="0" class="a-state" style="color: green;">En cours d'enchère</strong></p>
                        <?php endif; ?>
                        <br />
                        <p style="display: none;">Date de fin d'enchere: <strong class="endDate" style="color: red;"><?php echo htmlspecialchars($article['endDate']); ?></strong></p>
                        <strong class="h-decompte"></strong>
                        <p><strong>Temps de séjour restant : </strong><span class="decompte"></span></p>
                        <br>
                    </div>
                </div>
                
            </div>
            <?php if(!$article['state']): ?>
                <a href="#open-modal" class="button">ENCHERIR</a>
            <?php endif; ?>

            <div id="open-modal" class="modal-window">
                <div>
                    <a href="#modal-close" title="Close" class="modal-close"><i class="fa fa-close"></i></a>
                    <h1>Proposer une somme</h1>
                    <form action="tobid.php" method="post">
                        <input type="hidden" name="idArticle" value="<?php echo htmlspecialchars($article['idArticle']); ?>">
                        <input type="hidden" name="price" value="<?php echo htmlspecialchars($article['startPrice']); ?>">
                        <input type="hidden" name="h_price" value="<?php echo htmlspecialchars($article['hightPrice']); ?>">
                        <input type="text" name="saleBid" required>
                        <br>
                        <button type="submit">Valider</button>
                    </form>
                </div>
            </div>


        <?php else: ?>
            <h2>Article Introuvable. Sorry</h2>
        <?php endif; ?>
        <?php else: ?>
            <h2>Selectionner un article afin de voir les détails ou d'encherir</h2>
    <?php endif; ?>

</div>

<script src="js/descApp.js"></script>

<?php require 'inc/footer.php';  ?>