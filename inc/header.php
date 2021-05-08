<?php
    require "auto.php";
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Ces trois balises meta *doivent* venir avant tout autre balise meta, c'est indispensable -->

    <title>ANCHERIZE</title>

    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.min.css">

    <!-- Feuille de style personnalise-->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style_nav.css">

    <script src="js/nav.js"></script>
    <link rel="stylesheet" href="css/style_modal_box.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
</head>

<body>

<div class="navbar">
        <div class="nleft">
            <a href="accueil.php">Ancherize</a>
            <?php if(isset($_SESSION['root'])): ?>
                    <a href="proot.php"><i class="fa fa-user" style="margin-right: 8px;"></i> <?php echo htmlspecialchars($_SESSION['root']['access']); ?></a>
                <?php endif; ?>
        </div>
        <div class="nright">
            <a href="pub.php" class="nrl">Publier une enchère</a>
            <?php if(isset($_SESSION['auth'])): ?>
                <a href="account.php" class="nrl"><i class="fa fa-user" style="margin-right: 8px;"></i> <?php echo htmlspecialchars($_SESSION['auth']->pseudo()); ?></a>
            <?php endif; ?>
            <a href="deconnexion.php" onclick="return window.confirm('Vous nous laissez déjà ?')" class="nrl"><i class="fa fa-power-off"></i></a>

            <div class="dropdown">
                <button class="dropbtn" onclick="myFunction()">
                    <i class="i fa fa-bars"></i>
                </button>
                <div class="dropdown-content" id="myDropdown">
                <a href="pub.php">Publier une enchère</a>
                <?php if(isset($_SESSION['auth'])): ?>
                    <a href="account.php"><i class="fa fa-user" style="margin-right: 8px;"></i> <?php echo htmlspecialchars($_SESSION['auth']->pseudo()); ?></a>
                <?php endif; ?>
                <a href="deconnexion.php" onclick="return window.confirm('Vous nous laissez déjà ?')"><i class="fa fa-power-off" style="margin-right: 8px;"></i> Se déconnecter</a>
                </div>
            </div>
        </div>
</div>



    <div class="content">

        <?php if(isset($_SESSION['flash'])):  ?>
            <?php foreach($_SESSION['flash'] as $type => $message):  ?>
                <div class="alert-<?= $type; ?>">
                <p><?= $message; ?></p>
                <?php unset($_SESSION['flash']);  ?>
            </div>
            <?php endforeach;  ?>
        <?php endif;  ?>