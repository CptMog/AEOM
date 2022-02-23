<?php
    session_start();
    require 'bdd.php';
    require 'models/User.php';

    if(empty($_SESSION['user'])){

        $objUser = new User();

        if(empty($_POST)){
            if(empty($_GET['registration'])){
                require 'views/user_connect.phtml';
            }else{
                require 'views/user_regstration.phtml';   
            }
        }else{

            if(count($_POST) == 2){
                $objUser->connexionToUser($_POST['email'],$_POST['mdp']);

            }else{
                $objUser->createUser($_POST['pseudo'],$_POST['mdp'],$_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['phone']);
                $objUser->getLastUser();
            }

            $_SESSION['user'] = intval($objUser->getId());
            if($_SESSION['user'] == 1){
                header('Location: dashboardAdmin.php');
            }else{
                header('Location: dashbordUser.php');
            }
            
            exit();
        }
    }else{
        if($_SESSION['user'] == 1){
            header('Location: dashboardAdmin.php');
        }else{
            header('Location: dashbordUser.php');
        }
        exit();
    }