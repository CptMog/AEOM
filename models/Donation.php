<?php

class Donation{
    private int $id;
    private string $user_id;
    private string $content;
    private float $amount;
    private string $date;

    public function __construct(){

    }

    // public function createDonation()

    public function getDonateur(){
        global $pdo;
        $requete = $pdo->prepare("SELECT * FROM user WHERE user_id = ?");
        $requete->execute([$user_id]);
        $user = $requete->fetch();
        return $user;
    }
}

