<?php 

    require 'inc/includes.php';
    require "inc/functions.php";
    if_logged_root();
    require 'inc/header.php';


    if(!empty($_POST['root_ps']) && !empty($_POST['root_pwd'])) {

        if(preg_match('/(^anch\-)([a-z])+(@rootAncherize)$/', $_POST['root_ps'])) {
            
            $ps = substr($_POST['root_ps'], 5, -14);
            $user = $anch->connectAdmin($ps, $_POST['root_pwd']);
            
            if($user) {

                $usr = new Utilisateur($user['id'],$user['pseudo'], $user['email'], $user['pwd'], $user['sale'], $user['bidSale']);
                $info_root = array("root_pseudo" => $user['pseudo'], "spw" => $user['special_word'], "access" => $user['access']);
                $_SESSION['auth'] = $usr;
                $_SESSION['root'] = $info_root;
                $_SESSION['flash']['success'] = "Mode Admin = SUCCESS ";
                header("Location: proot.php");

            } else {
                $_SESSION['flash']['error'] = "Mode Admin = ECHEC, pseudo ou mot de passe invalide";
                header("Location: index.php");
            }

        } else {
            $_SESSION['flash']['error'] = "Mode Admin = ECHEC";
            header("Location: index.php");
        }

    }
    
?>



