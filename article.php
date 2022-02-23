<?php
    session_start();
    require 'bdd.php';
    require 'models/User.php';
    require 'models/Article.php';
    require 'models/Remark.php';

    $objUser = new User();
    $objRemark = new Remark();
    $objArticle = new Article();
    $_SESSION['article'] = intval($_GET['id']);
    $objArticle->getArticleSelected(intval($_GET['id']));
    $remarks =  $objRemark->getArticleRemarks(intval($_GET['id']));
    $commentsUsers = array();
    foreach($remarks as $remark){
        $objUser->getUserSelected(intval($remark['user_id']));
        $commentsUsers[] = [$objUser->getLogin() => $remark];
    }
    $user="";
    if(!empty($_SESSION['user'])){
        $objUser->getUserSelected(intval($_SESSION['user']));
        $user = $objUser->getLogin();
    }
    
    require 'views/article.phtml';

?>