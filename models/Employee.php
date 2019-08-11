<?php

class Employee {

    private $conn;
    private $table = "tab1";
    

    // Dealing with Post and Get Requests.

    public $id;
    public $name;


    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {

       $query = 'SELECT * FROM '.$this->table;

        return $this->conn->query($query);

    }

    // For fetching the single user Data

    public function read_single_user_data() {
        
       if(!isset($_GET['emp_id'])){
        $_GET['emp_id'] = -1;
       }

       $id = $_GET['emp_id'];

       $query = "SELECT * FROM ".$this->table." where id = '".$this->id."' ";

        return $this->conn->query($query);

    }
    
    
    
    public function create() {

        $query = 'INSERT INTO '.$this->table.' (name) VALUES("'.$this->name.'")';

     
        if($this->conn->query($query)){
            return true;
        }
        else
            return false;
    }


    public function delete() {

        $query = "DELETE FROM ".$this->table." where id = ".$this->id;


        if($this->conn->query($query)) {
            return true;
        }

        return false;
    }

    public function update(){
        $query = "update ".$this->table." set name = '".$this->name."' where id = ".$this->id;


        if($this->conn->query($query)) {
            return true;
        }

        return false;
    }

}

?>