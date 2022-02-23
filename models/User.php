<?php

class User{
    private int $id;
    private bool $is_admin;
    private string $login;
    private string $mdp;
    private string $firstname;
    private string $lastname;
    private string $email;
    private string $phone;

    public function __construct(){
        
    }

    public function getAllUsers(){
        global $pdo;
        $requete = $pdo->query("SELECT * FROM users");
        $users = $requete->fetchAll();
        return $users;
    } 
    
    public function createUser($login, $mdp, $firstname, $lastname, $email, $phone){
        global $pdo;
        $requete = $pdo->prepare("INSERT INTO users (`is_admin`, `login`, `mdp`, `firstname`, `lastname`,
         `email`, `phone`) VALUES(0,?,?,?,?,?,?)");
        $requete->execute([$login, $mdp, $firstname, $lastname, $email, $phone]);
    }

    public function connexionToUser($email,$mdp){
        global $pdo;

            $requete = $pdo->prepare("SELECT * FROM users WHERE email = ? AND mdp = ?");
            $requete->execute([$email,$mdp]);
            $user = $requete->fetch();

            if($user == null){
                echo "Wrong password or email";
                header('Location: registerUser.php');
                exit();
            }else{
                $this->id = $user['id'];
                $this->is_admin = $user['is_admin'];
                $this->login = $user['login'];
                $this->mdp = $user['mdp'];
                $this->firstname = $user['firstname'];
                $this->lastname = $user['lastname'];
                $this->email = $user['email'];
                $this->phone = $user['phone'];
            }

    }

    public function getUserSelected($id){
        global $pdo;
        $requete = $pdo->prepare("SELECT * FROM users WHERE id = ?");
        $requete->execute([$id]);
        $user = $requete->fetch();
        $this->id = $user['id'];
        $this->is_admin = $user['is_admin'];
        $this->login = $user['login'];
        $this->mdp = $user['mdp'];
        $this->firstname = $user['firstname'];
        $this->lastname = $user['lastname'];
        $this->email = $user['email'];
        $this->phone = $user['phone'];
    }

    public function getLastUser(){
        global $pdo;
        try{
            $requete = $pdo->query("SELECT * FROM users ORDER BY id DESC LIMIT 1");
            $user = $requete->fetch();
        }catch(Exception $e){
            echo $e->getMessage();
        }
        $this->id = $user['id'];
        $this->is_admin = $user['is_admin'];
        $this->login = $user['login'];
        $this->mdp = $user['mdp'];
        $this->firstname = $user['firstname'];
        $this->lastname = $user['lastname'];
        $this->email = $user['email'];
        $this->phone = $user['phone'];
    }
    
    public function getDonation():array{
        global $pdo;
        $requete = $pdo->prepare("SELECT * FROM donation WHERE user_id = ?");
        $requete->execute([$this->id]);
        $donations = $requete->fetchAll();
        return $donations;
    }


    public function getArticles():array{
        global $pdo;
        $requete = $pdo->prepare("SELECT * FROM articles WHERE user_id = ?");
        $requete->execute([$this->id]);
        $articles = $requete->fetchAll();
        return $articles;
    }

    public function getRemarks($arId):array{
        global $pdo;
        $requete = $pdo->prepare("SELECT * FROM remarks WHERE article_id = ? AND user_id = ?");
        $requete->execute([$arId,$this->id]);
        $remarks = $requete->fetchAll();
        return $remarks;
    }

    public function getId(){
		return $this->id;
	}

    public function getLogin() {
		return $this->login;
	}

	public function getFirstname() {
		return $this->firstname;
	}

	public function getLastname() {
		return $this->lastname;
	}

	public function getEmail() {
		return $this->email;
	}

	public function getPhone() {
		return $this->phone;
	}

}

