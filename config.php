<?php


try{

    $bdd = new PDO('mysql:host=localhost;dbname=user_test','root','');  
         //put queary connection to sql and db in variable 
         
          $bdd->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
          //Error Handling
          
        } catch(PDOException $e) {  // catche error in try function and put it in variable $e
            echo $bdd . "<br>" . $e->getMessage();
          }    
               // and then echo the variable $sql "or more variable" end echo $e 

           ?>