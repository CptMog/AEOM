<?php
    // session_start();
    require 'bdd.php';
    require 'models/Article.php';
    $objArticle = new Article();
    $objArticle->removeArticle(intval($_GET['id']));
    
echo "reussi";