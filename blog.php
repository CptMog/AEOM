<?php
    session_start();
    require 'bdd.php';
    require 'models/Article.php';
    $user = "";
    if(!empty($_SESSION['user'])){
        require 'models/User.php';
        $objUser = new User();
        $objUser->getUserSelected(intval($_SESSION['user']));
        $user = $objUser->getLogin();
    }
    $obj_article = new Article();
    $articles = $obj_article->getAllArticles();

    require 'views/all_blog.phtml';

?>