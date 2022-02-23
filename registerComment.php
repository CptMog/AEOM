<?php
session_start();
require 'bdd.php';
require 'models/Remark.php';
require 'models/User.php';

$objRemark = new Remark();
$objUser = new User();

$objRemark->createRemark(intval($_SESSION['user']),intval($_SESSION['article']),$_POST['content']);

$remark = $objRemark->getLastArticleRemarks(intval($_SESSION['article']));
$objUser->getUserSelected(intval($_SESSION['user']));

$data[$objUser->getLogin()] = $remark['content'];

echo json_encode($data);