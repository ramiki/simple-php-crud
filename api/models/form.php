<?php

class tickets {

// DB stuff
private $conn;
private $table = 'tickets';

// users properties
public $id;
public $firstname;
public $lastname;
public $email;
public $gender;
public $form;
public $username;
public $key;
public $created_at;

// constructor with DB
public function __construct($db){
    $this->conn = $db;
}
  
//******************* get form
//************************* */

public function read(){
    // create query
    $query= "SELECT * FROM " .$this->table ;

    // prepare statement
    $stmt = $this->conn->prepare($query);

    // execute query
    $stmt->execute();

    return $stmt;
}

public function chek_keygen(){

    $this->key = isset($_GET['key']) ? $_GET['key'] : die(json_encode(array('rep' => false , 'msg' => 'plz entre your key'))) ;
    // create query
    $query= "SELECT keygen FROM " .$this->table ." WHERE keygen = '$this->key'" ;

    // prepare statement
    $stmt2 = $this->conn->prepare($query);

    // execute query
    $stmt2->execute();

    return $stmt2;
}

//************** get single form
//*************************** */

public function read_single(){
    // create query
    $query = 'SELECT ID,firstname,lastname,email,gender,form,username,created_at FROM '.$this->table.' WHERE ID = ? ' ;

    // prepare statement
    $stmt = $this->conn->prepare($query);

    // bind ID
    $stmt->bindParam(1, $this->id);

    // execute query
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // set properties
            $this->id = $row['ID'] ;
            $this->firstname = $row['firstname'];
            $this->lastname = $row['lastname'];
            $this->email = $row['email'];
            $this->gender = $row['gender'];
            $this->form = $row['form'];
            $this->username = $row['username'];
            $this->created_at = $row['created_at'];
}


//*************** Creat posts
//************************ */

public function creat(){

// creat query
$query = 'INSERT INTO '. 
    $this->table.'
  SET 
  firstname = :firstname ,
  lastname = :lastname ,
  email = :email ,
  gender = :gender ,
  form = :form ,
  firstname = :firstname ';

}


}