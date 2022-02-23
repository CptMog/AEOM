<?php
session_start();
require 'bdd.php';
require 'models/Event.php';
$user = "";
if(!empty($_SESSION['user'])){
    require 'models/User.php';
    $objUser = new User();
    $objUser->getUserSelected(intval($_SESSION['user']));
    $user = $objUser->getLogin();
}
$obj_event = new Event();
$events = $obj_event->getAllEvents();

require 'views/all_events.phtml'
?>