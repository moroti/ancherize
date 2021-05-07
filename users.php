<?php require "inc/includes.php"; ?>
<?php require "inc/functions.php"; ?>
<?php logged_only();  ?>
<?php logged_only_root();  ?>

<?php if(isset($_GET['gl']) && isset($_GET['dl'])):  ?>

    <?php $all_user = $anch->getAllUsers($_GET['gl'], $_GET['dl']); ?>
    <?php if($all_user): ?>
        <?php foreach($all_user as $key => $value): ?>
            <a href="" value="<?php echo htmlspecialchars($value['pseudo']); ?>" class="a-pseudo">
                <div>
                    <span><?php print_min_libel($value['pseudo']); ?></span><span> - </span>
                    <span>Sale : </span>
                    <span><?php print_min_libel($value['sale']); ?>$</span>
                    
                </div>
            </a>
            <span class="s-del"><a onclick="return window.confirm('Voulez-vous vraiment supprimer cet utilisateur ?');" href="delete?ps=<?php echo($value['pseudo']); ?>"><i class="fa fa-ban" style="color:crimson; margin-left:10px;"></i></a></span>
            <br />
            <br />
        <?php endforeach; ?>
        <span class="pn-button">
            <?php if($_GET['gl']!=0): ?>
                <button gl="<?php echo($_GET['gl']-7); ?>" dl="<?php echo($_GET['dl']-7); ?>">PREV</button>
            <?php endif; ?>
            <button gl="<?php echo($_GET['gl']+7); ?>" dl="<?php echo($_GET['dl']+7); ?>">NEXT</button>
        </span>
    <?php else: ?>
        <p>Pas d'utilisateur</p>
        <span class="pn-button">
            <?php if($_GET['gl']!=0): ?>
                <button gl="<?php echo($_GET['gl']-7); ?>" dl="<?php echo($_GET['dl']-7); ?>">PREV</button>
            <?php endif; ?>
        </span>
    <?php endif; ?>

<?php endif;  ?>