<?php


// ------------------------ creat table -----------------------------------------

$tabname = 'tickets_app';
$ndd = new PDO("mysql:host=localhost;dbname=$dbname", 'root', '');
//put queary connection to sql and db in variable 

$ndd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
//Error Handling

$tablen = 'tickets';
$table = "CREATE TABLE IF NOT EXISTS $tablen( 
                 ID INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
                 title varchar(255) NOT NULL,
                 content text CHARACTER SET utf8 NOT NULL,
                 checked tinyint(1) DEFAULT NULL,
                 keygen varchar(150) NOT NULL,
                 userid INT ( 11 )  FOREIGN KEY REFERENCES users(ID) ,
                 username varchar(255) DEFAULT NULL,
                 created_at timestamp NOT NULL DEFAULT current_timestamp(),
                 lastUpdated timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
                 )ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
//put creat table queary if not exist with champs in variable $table


$tables = $ndd->query("show tables")->fetchAll(PDO::FETCH_GROUP);
//  $exists = $ndd->query("SELECT 1 from $tablen"); // second method (problem when catch error 'remove  set attr error to work')

//  check if table exist
//  if ( $exists ) {   echo" existed table <br> ";   // second method
if (in_array($tablen, array_keys($tables))) {
  echo " existed table <br> ";
} else {
  $ndd->exec($table); 
  echo 'Created Table<br>';
}              
                    


              // testing and info :

// $fkey = "CREATE TABLE tickets_app.tickets AS SELECT * FROM user_test.users_test " ;  // copy table from db to db with new name
// $fkey = "ALTER TABLE $tablen ADD FOREIGN KEY admin REFERENCES tickets_app.users(ID))" ; // fk from db to db not suported
// $fkey = "ALTER TABLE tickets_app.tickets ADD COLUMN userid INT DEFAULT(1),ADD FOREIGN KEY fk_name(userid) REFERENCES users(ID) ON DELETE CASCADE " ; // add fk in table refer to an other table 
// $fkey = "SELECT * FROM user_test.users_test LEFT JOIN tickets_app.users ON users_test.ID=users.ID" ;  join from db to db work

// $tables = $ndd->prepare($fkey) ;
// $tables->execute();
// // $result = $tables->setFetchMode(PDO::FETCH_ASSOC); 
// // var_dump($result);

// while($row = $tables->fetch(PDO::FETCH_ASSOC)) {
// echo "<pre>";
// print_r($row) ;
// echo "</pre>";
// }
