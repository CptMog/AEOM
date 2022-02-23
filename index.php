<?php
    session_start();
    require 'bdd.php';
    require 'models/Event.php';
    require 'models/Article.php';
    $user = "";
    if(!empty($_SESSION['user'])){
        require 'models/User.php';
        $objUser = new User();
        $objUser->getUserSelected(intval($_SESSION['user']));
        $user = $objUser->getLogin();
    }
    $obj_event = new Event();
    $obj_article = new Article();
    $articles = $obj_article->getLastArticles();
    $event = $obj_event->getNextEvent();


    require 'views/home.phtml';
?>