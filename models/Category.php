<?php

  class Category {
    //db prop
    private $conn;
    private $table = 'categories';
    //props
    public $id;
    public $name;
    public $created_at;
    //constructor + db
    public function __construct($db)
    { 
      $this->conn = $db;     
    }

    public function read() 
    {
      $query  = 'SELECT id, name, created_at FROM ' . $this->table . ' ORDER BY  created_at DESC';
      $stmt=$this->conn->prepare($query);
      $stmt->execute();
      return $stmt;
    }

    public function read_single()
    {
      $query = 'SELECT id, name, created_at FROM ' .
      $this->table . '
      WHERE id = ?
      LIMIT 0, 1 ';
      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(1, $this->id);
      $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      $this->name = $row['name'];
      $this->id = $row['id'];
    }
  }