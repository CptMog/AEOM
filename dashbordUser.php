<?php
    session_start();
    require 'bdd.php';
    require 'models/User.php';
    require 'models/Article.php';
    require 'models/Remark.php';
    $title="";
    $content="";
    $objUser = new User();
    $objRemark = new Remark();

    $objUser->getUserSelected(intval($_SESSION['user']));
    $articles = $objUser->getArticles();
    
    $article_comms= array();

    foreach($articles as $article){
        $article_comms[] = [$article['id'],$article['title'],count($objRemark->getArticleRemarks($article['id']))];
    }


    if(empty($_POST)){

        //modification de données
        if(!empty($_GET['update'])){
            $objArticle = new Article();
            $objArticle->getArticleSelected(intval($_GET['update']));
            $title =  $objArticle->getTitle();
            $content = $objArticle->getContent();
            $photo = $objArticle->getImage();
            $_SESSION['article'] = intval($objArticle->getId());
            require 'views/dashboard_create.phtml';
            exit();
        }

        if(empty($_GET['create'])){
            require 'views/dashboard.phtml';
        }else{
            require 'views/dashboard_create.phtml';
        }

    }else{
        $objArticle = new Article();
        if(!isset($_POST['update'])){
            $photo = "";
            
            if($_FILES["photo"]["name"][0] != ""){
                foreach ($_FILES["photo"]["error"] as $key => $error) {
                    if ($error == UPLOAD_ERR_OK) {
                        $tmp_name = $_FILES["photo"]["tmp_name"][$key];
                        $photo = basename($_FILES["photo"]["name"][$key]);
                        move_uploaded_file($tmp_name, "assets/img/upload/$photo");
                    }
                }
            }

            $objArticle->createArticle($_SESSION['user'],$_POST['title'],$_POST['content'],$photo);

        }else{

            $photo = "";
            
            if($_FILES["photo"]["name"][0] != ""){
                foreach ($_FILES["photo"]["error"] as $key => $error) {
                    if ($error == UPLOAD_ERR_OK) {
                        $tmp_name = $_FILES["photo"]["tmp_name"][$key];
                        $photo = basename($_FILES["photo"]["name"][$key]);
                        move_uploaded_file($tmp_name, "assets/img/upload/$photo");
                    }
                }
            }

            $objArticle->getArticleSelected(intval($_SESSION['article']));
            $objArticle->setTitle($_POST['title']);
            $objArticle->setContent($_POST['content']);
            if($objArticle->getImage() != $photo){
                $objArticle->setImage($photo);
            }
            $objArticle->updateArticle();
        }
        
        header('Location: dashbordUser.php');
        exit();
        
    }
