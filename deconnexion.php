<?php
require 'inc/functions.php';
logged_only();
session_start();
unset($_SESSION['auth']);
if(isset($_SESSION['root'])) {
    unset($_SESSION['root']);
}
$_SESSION['flash']['success'] = "Vous êtes maintenant déconnecter";
header('Location: index.php');
