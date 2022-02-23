<?php

class Event{

    private int $id;
    private string $title;
    private string $content;
    private string $date_begin;
    private string $date_end;

    public function __construct(){

    }

    // public createEvents()

    public function getAllEvents(){
        global $pdo;
        $requete = $pdo->prepare("SELECT * FROM events ORDER BY date_begin DESC");
        $requete->execute([]);
        $events = $requete->fetchAll();
        return $events;
    }

	public function getNextEvent(){
        global $pdo;
        $requete = $pdo->prepare("SELECT * FROM events LIMIT 1");
        $requete->execute([]);
        $event = $requete->fetch();
        return $event;
    }
    
    public function getTitle() {
		return $this->$title;
	}

	public function setTitle(string $title) {
		$this->title = $title;
	}

	public function getContent() {
		return $this->$content;
	}

	public function setContent(string $content) {
		$this->content = $content;
	}

	public function getDate_begin() {
		return $this->date_begin;
	}

	public function setDate_begin(string $date_begin) {
		$this->date_begin = $date_begin;
	}

	public function getDate_end() {
		return $this->date_end;
	}

	public function setDate_end(string $date_end) {
		$this->date_end = $date_end;
	}
}

