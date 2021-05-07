<?php require "inc/includes.php"; ?>
<?php require "inc/functions.php"; ?>
<?php logged_only();  ?>
<?php logged_only_root();  ?>

<?php if(isset($_GET['own']) && isset($_GET['gl']) && isset($_GET['dl'])):  ?>

    <?php $all_user_articles = $anch->getAllArticles($_GET['own'], $_GET['gl'], $_GET['dl']); ?>
    <?php if($all_user_articles): ?>
        <?php foreach($all_user_articles as $key => $value): ?>
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
            <span class="s-del"><a onclick="return window.confirm('Voulez-vous vraiment supprimer cet article ?');" href="delete?idArt=<?php echo($value['idArticle']); ?>"><i class="fa fa-ban" style="color:crimson; margin-left:10px;"></i></a></span>
            <br />
            <br />
        <?php endforeach; ?>
        <span class="pn-button">
            <?php if($_GET['gl']!=0): ?>
                <button own="<?php echo($_GET['own']); ?>" gl="<?php echo(((int)$_GET['gl'])-7); ?>" dl="<?php echo(((int)$_GET['dl'])-7); ?>">PREV</button>
            <?php endif; ?>
            <button own="<?php echo($_GET['own']); ?>" gl="<?php echo($_GET['gl']+7); ?>" dl="<?php echo($_GET['dl']+7); ?>">NEXT</button>
        </span>
    <?php else: ?>
        <p>Pas d'articles</p>
        <span class="pn-button">
            <?php if($_GET['gl']!=0): ?>
                <button own="<?php echo($_GET['own']); ?>" gl="<?php echo(((int)$_GET['gl'])-7); ?>" dl="<?php echo(((int)$_GET['dl'])-7); ?>">PREV</button>
            <?php endif; ?>        </span>
    <?php endif; ?>

<?php endif;  ?>