<?php

    require 'inc/includes.php';
    require 'inc/functions.php';
    if_logged();
    if(isset($_GET['id']) && isset($_GET['token'])){

        $user_id = (int)$_GET['id'];
        $token = test_input($_GET['token']);

        $user = $anch->loadUserId($user_id);

        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }

        if($user && $user['confirm_token'] == $token){

            $anch->confirm_user($user_id);
            $usr = new Utilisateur($user['id'],$user['pseudo'], $user['email'], $user['pwd'], $user['sale'], $user['bidSale']);
            $_SESSION['auth'] = $usr;
            $_SESSION['flash']['success'] = "Votre compte a bien été validé";
            header('Location: account.php');
            exit();

        }else{
            $_SESSION['flash'] = array();
            $_SESSION['flash']['error'] = "Ce token n'est pas valide !!";
            header('Location: connexion.php');
        }

    }else{
        die("Ya un pb bro");

    }   