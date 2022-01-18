<?php

class Post {
  private $conn;
  private $table = 'posts';

  public $id;
  public $category_id;
  public $category_name;
  public $title;
  public $body;
  public $author;
  public $created_at;

  public function __construct($db)
  {
    $this->conn = $db;
  }

  public function read() 
  {
    $query = 'SELECT c.name as category_name, p.id, p.category_id, p.title, p.body, p.author, p.created_at 
    FROM 
    ' .  $this->table . ' p 
    LEFT JOIN
    categories c On p.category_id = c.id
    ORDER BY p.created_at DESC ';

    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt;
  }

  public function read_single()
  {
    $query = 'SELECT c.name as category_name, p.id, p.category_id, p.title, p.body, p.author, p.created_at 
    FROM 
    ' .  $this->table . ' p 
    LEFT JOIN
    categories c On p.category_id = c.id
    WHERE p.id = ?
    LIMIT 0, 1';
    //prepare statement
    $stmt = $this->conn->prepare($query);
    //bind id
    $stmt->bindParam(1, $this->id);
    //execute query
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    //set proprieties
    $this->title = $row['title'];
    $this->body = $row['body'];
    $this->author = $row['author'];
    $this->category_id = $row['category_id'];
    $this->category_name = $row['category_name'];

  }
}