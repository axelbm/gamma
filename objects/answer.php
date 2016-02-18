<?php
class Answer{
    private $id;
    private $page;
    private $book;
    private $destinaion;
    private $content;
    private $creator;
    private $publication_date;
    
    public function __construct($data){
    	if(!empty($data)){
			foreach ($data as $key => $value) {
				$this->$key = $value;
			}
		}
    }
    
    public function ID(){
        return $this->id;
    }
    
    public function Page(){
        return $this->page;
    }
    
    public function Book(){
        return $this->book;
    }
    
    public function Destination(){
        return $this->destination;
    }
    
    public function Content(){
        return $this->content;
    }
    
    public function Creator(){
        return $this->creator;
    }
    
    public function PublicationDate(){
        return $this->publication_date;
    }
}