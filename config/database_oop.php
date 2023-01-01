<?php

class Database {

// DB param
private $driver = "mysql";
private $host = "localhost";
private $dbname = "tickets_app";
private $user = "root";
private $pass = "";
private $conn;
private $dbd;


private function creat_db(){

// ******** connection mysql server

$this->dbd = null;

    try {
        $this->dbd = new PDO('mysql:host=localhost;', 'root', '');
        //put queary connection to sql in variable 
      
        $this->dbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //Error Handling      
    


  // ********** drop or creat db

  $dbq    = "CREATE DATABASE IF NOT EXISTS ".$this->dbname;
  //put creat sql queary if not exist in variable

  // $dbs    = "DROP DATABASE IF EXISTS $this->dbname";  // for drop db

  $stmt = $this->dbd->query("SHOW DATABASES LIKE ".$this->dbname);
  // // check if db exist

  // // $stmt = $bdd->query("SELECT * FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'tickets_app'");  
  //  second method to check if db exist 

  if ($stmt->fetchColumn() == false) {
    $this->dbd->exec($dbq);
    //execute queary  with connection upster 
    echo "Database created successfully<br>";
  } elseif (isset($dbs)) {
    echo "existed database and droped / refresh to creat it again <br> ";
    $this->dbd->exec($dbs);  // drop db to creat it again 
  } else {
    echo " existed database <br>";
  }
} catch (PDOException $e) {  // catche error in try function and put it in variable $e
  echo "there was an error in table block " . "<br>" . $e->getMessage();
}  // and then echo the variable $sql "or more variable" end echo $e 

return $this->dbd ;

}


// $exec = new Database->creat_db();




// DB connect
    public function connect(){

        $this->conn = null;

    try{

        $this->conn = new PDO($this->driver.':host='.$this->host.';dbname='.$this->dbname,$this->user,$this->pass);   
        // put queary connection to sql and db in variable 


        $this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION ); // echo fatal error in  problem
        //  Error Handling
          
    }

        catch(PDOexception $e) {  // catche "setAttribute" error "pdo" in try function and put it in variable $e
            echo "Database Error ! " .$e->getMessage()  ;
        }    

    return $this->conn;

    }
}


// mysqli method connection with euth constants

// Informations d'identification
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'tickets_app');
 
// Connexion à la base de données MySQL 
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Vérifier la connexion
if($conn === false){
    die("ERREUR : Impossible de se connecter. " . mysqli_connect_error());
}