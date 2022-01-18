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

    public function create()
    {
      $query = 'INSERT INTO ' . $this->table . '
      SET id = :id, name = :name ';
      //prepare stmt
      $stmt = $this->conn->prepare($query);
      //clean data
      $this->id = htmlspecialchars(strip_tags($this->id));
      $this->name = htmlspecialchars(strip_tags($this->name));
      //bind data
      $stmt->bindParam(':id', $this->id);
      $stmt->bindParam(':name', $this->name);
      //execute query
      if($stmt->execute()) {
        return true;
      }
      printf("Error: %s.\n", $stmt->error);
      return false;
    }

    public function update()
    {
      $query = 'UPDATE ' . $this->table . '
      SET name =:name
      WHERE id =:id';
      //prepare query
      $stmt = $this->conn->prepare($query);
      //clean data
      $this->id = htmlspecialchars(strip_tags($this->id));
      $this->name = htmlspecialchars(strip_tags($this->name));
      //bind data
      $stmt->bindParam('id', $this->id);
      $stmt->bindParam('name', $this->name);
      //execute query
      if($stmt->execute()) {
        return true;
      }
      //if not true show error
      print_r("Error: %s.\n". $stmt->error);
      return false;
    }

    public function delete() {
      $query = 'DELETE FROM ' . $this->table . ' WHERE id =:id';
      //prepare stmt
      $stmt = $this->conn->prepare($query);
      //clean data
      $this->id = htmlspecialchars(strip_tags($this->id));
      //bind data
      $stmt->bindParam('id', $this->id);

      if($stmt->execute()) {
        return true;
      }

      print_r("Error: %s.\n", $stmt->error);
      return false;
    }
  }