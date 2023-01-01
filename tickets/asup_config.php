<?php


// try{

    $bdd = new PDO('mysql:host=localhost;dbname=euth','root','');  
         //put queary connection to sql and db in variable 


          // $bdd->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION ); // echo fatal error in  problem
          //Error Handling
          
// }

        // catch(exception $e) {  // catche "throw" error in try function and put it in variable $e
        // catch(PDOexception $e) {  // catche "setAttribute" error "pdo" in try function and put it in variable $e
            // echo "Database Error !" ;
            // header("error.php") ;
        // }    

        //  throw new Exception();  // echo msg in throw error
