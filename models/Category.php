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
  }