<?php

class Remark{
    private int $id;
    private int $article_id;
    private int $user_id;
    private string $content;
    private string $date;

    public function __construct(){

    }

    // public function getAllRemarks(){
    //     global $pdo;
    //     $requete = $pdo->query("SELECT * FROM remarks");
    //     $remarks = $requete->fetchAll();
    //     return $remarks; 
    // }

    public function createRemark($user,$article,$content){
        global $pdo;
        $requete = $pdo->prepare("INSERT INTO remarks (`user_id`, `article_id`, `content`, `date`) VALUES(?,?,?,?)");
        $requete->execute([$user,htmlspecialchars($article),htmlspecialchars($content),date("y-m-d")]);
    }

    public function getSelectedRemark($u_id, $a_id){
        global $pdo;
        $requete = $pdo->prepare("SELECT * FROM remarks WHERE user_id = ? AND article_id = ?");
        $requete->execute([$u_id,$a_id]);
        $remark = $requete->fetch();
        
        $this->id = $remark['id'];
        $this->article_id = $remark['article_id'];
        $this->user_id = $remark['user_id'];
        $this->content = $remark['content'];
        $this->date =  $remark['date'];
    }

    public function getArticleRemarks($id):array{
        global$pdo;
        $requete = $pdo->query("SELECT * FROM remarks WHERE article_id =".$id." ORDER BY id DESC");
        $remarks = $requete->fetchAll();
        return $remarks;
    }

    public function getLastArticleRemarks($id){
        global$pdo;
        $requete = $pdo->query("SELECT * FROM remarks WHERE article_id =".$id." ORDER BY id DESC LIMIT 1");
        $remark = $requete->fetch();
        return $remark;
    }

    public function getArticle(){
        global $pdo;
        $requete = $pdo->prepare("SELECT * FROM articles WHERE id = ?");
        $requete->execute([$this->article_id]);
        $article = $requete->fetch();
        return $article;
    }

    public function getAuthor(){
        global $pdo;
        $requete = $pdo->prepare("SELECT login FROM user WHERE id = ?");
        $requete->execute([$this->user_id]);
        $article = $requete->fetch();
        return $article;
    }

    public function getContent() {
		return $this->$content;
	}

	public function setContent(string $content) {
		$this->content = $content;
	}

}

