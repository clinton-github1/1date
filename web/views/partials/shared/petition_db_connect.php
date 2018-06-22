<?php

class Database{
    
    private $host= "localhost";
    private $username= "clinton";
    private $password= "clinton";
    private $database="onedate";
    
    public $conn;
    
    public function getConnection(){
        
       $conn= new mysqli($this->host, $this->username, $this->password, $this->database);
        
        if(!$conn){
            
            echo "database failesd to connect" . mysqli_error();
        }
        
        return $conn;
    }
    
}

?>