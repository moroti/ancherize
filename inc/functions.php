<?php

function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;
}

function debug($variable){
    echo '<pre>' . print_r($variable,true) . '</pre>';
}

function str_random($longueur){
    $alphabet = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $tkn = substr(str_shuffle(str_repeat($alphabet, $longueur)), 0, $longueur);
    
    return $tkn;
}

function logged_only(){
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
    if(!isset($_SESSION['auth'])){
        $_SESSION['flash']['error'] = "Vous n'avez pas le droit d'accéder à cette page";
        header('Location: index.php');  
        exit();
    } 
}
function logged_only_root(){
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
    if(!isset($_SESSION['root'])){
        $_SESSION['flash']['error'] = "Vous n'avez pas le droit d'accéder à cette page";
        header('Location: index.php');  
        exit();
    } 
}
function if_logged(){
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
    if(isset($_SESSION['auth'])){
        $_SESSION['flash']['error'] = "Vous n'avez pas le droit d'accéder à cette page (déjà)";
        header('Location: index.php');  
        exit();
    }
}

function if_logged_root(){
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
    if(isset($_SESSION['auth']) || isset($_SESSION['root'])){
        $_SESSION['flash']['error'] = "Vous n'avez pas le droit d'accéder à cette page (déjà)";
        header('Location: index.php');  
        exit();
    }
}

function print_libel($libel) {
    if(strlen($libel) <= 20):
        echo htmlspecialchars($libel);
    else:
        echo htmlspecialchars(substr($libel, 0, 20) . '...');
    endif;
}
function print_min_libel($libel) {
    if(strlen($libel) <= 15):
        echo htmlspecialchars($libel);
    else:
        echo htmlspecialchars(substr($libel, 0, 15) . '...');
    endif;
}
function printText($text) {
    echo htmlspecialchars($text);
}


function search_in_tab(){

}