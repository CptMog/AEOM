<?php
    session_start();
    require 'bdd.php';
    require 'models/User.php';
    require 'models/Article.php';
    require 'models/Remark.php';
    require 'models/Event.php';

    $elems = array();

    $objUser = new User();
    

    if(!empty($_GET)){
        
        if(isset($_GET['user'])){
            $elems = $objUser->getAllUsers();
        }

        if(isset($_GET['article'])){
            $objArticle = new Article();
            $objRemark = new Remark();
            $articles = $objArticle->getAllArticles();
            foreach($articles as $article){
                $elems[] = [$article['id'],$article['title'],count($objRemark->getArticleRemarks($article['id']))];
            }
        }

        if(isset($_GET['remark'])){

            $objRemark = new Remark();
            $objArticle = new Article();
            $users = $objUser->getAllUsers();
            $articles = $objArticle->getAllArticles();
            foreach($articles as $article){
                foreach($objRemark->getArticleRemarks($article['id']) as $remark){
                    $objUser->getUserSelected($remark['user_id']);
                    $resume = substr($remark['content'],0,20);
                    $elems[] = [$resume.'...',$objUser->getLogin(),$article['title']];
                }
            }

            // $elems

        }

        if(isset($_GET['event'])){
            
            $objEvent = new Event();
            $elems = $objEvent->getAllEvents();
        }
    }

    $objUser->getUserSelected(intval($_SESSION['user']));
    require 'views/dashboard_admin.phtml';