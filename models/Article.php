<?php


class Article{

    private int $id;
    private string $user_id;
    private string $title;
    private string $content;
    private string $image;
    private string $date;
    

    public function __construct(){
        
    }

    public function updateArticle(){
        global $pdo;
        $pdo->query("UPDATE `articles` SET `title`='".htmlspecialchars($this->title,ENT_QUOTES,'UTF-8')."',`content`='".htmlspecialchars($this->content,ENT_QUOTES,'UTF-8')."' , `image`='".htmlspecialchars($this->image,ENT_QUOTES,'UTF-8')."' WHERE id=".$this->id);
    }

    public function removeArticle($id){
        global $pdo;
        $pdo->query("DELETE FROM remarks WHERE article_id=".$id);
        $pdo->query("DELETE FROM articles WHERE id=".$id);
    }

    public function getArticleSelected($id){
        global $pdo;
        $requete = $pdo->prepare("SELECT * FROM articles WHERE id = ?");
        $requete->execute([$id]);
        $article = $requete->fetch();

        $this->id = $article['id'];
        $this->user_id = $article['user_id'];
        $this->title = $article['title'];
        $this->content = $article['content'];
        $this->image = $article['image'];
        $this->date = $article['date'];
    }

    public function getAllArticles(){
        global $pdo;
        $requete = $pdo->prepare("SELECT * FROM articles ORDER BY id DESC");
        $requete->execute([]);
        $articles = $requete->fetchAll();
        return $articles;
    }

    public function getLastArticles(){
        global $pdo;
        $requete = $pdo->prepare("SELECT * FROM articles ORDER BY id DESC LIMIT 4");
        $requete->execute([]);
        $articles = $requete->fetchAll();
        return $articles;
    }


    public function getAuthor(){
        global $pdo;
        $requete = $pdo->prepare("SELECT login FROM users WHERE id = ?");
        $requete->execute([$this->user_id]);
        $author = $requete->fetch();

        return $author['login'];
    }


    public function getRemarks(){
        global $pdo;
        $requete = $pdo->prepare("SELECT * FROM remarks WHERE article_id = ?");
        $requete->execute([$this->id]);
        $remarks = $requete->fetch();
        return $remarks;
    }
    public function createArticle($user,$title,$contenu,$photo){
        global $pdo;
        $requete = $pdo->prepare("INSERT INTO articles( `user_id`, `title`, `content`, `image` ,`date`) VALUES ( ?, ?, ?, ? ,?)");
        $requete->execute([$user,htmlspecialchars($title,ENT_QUOTES,'UTF-8'),htmlspecialchars($contenu,ENT_QUOTES,'UTF-8'),htmlspecialchars($photo,ENT_QUOTES,'UTF-8'),date("y-m-d")]);
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of date
     */ 
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the value of date
     *
     * @return  self
     */ 
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get the value of content
     */ 
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * @return  self
     */ 
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get the value of title
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of image
     */ 
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */ 
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }
}

