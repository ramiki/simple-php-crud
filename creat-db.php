                 
<?php

try{
           $bdd = new PDO('mysql:host=localhost;','root','');  
           //put queary connection to sql in variable 
          
          $bdd->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
          //Error Handling
         
          $dbq    = 'CREATE DATABASE IF NOT EXISTS user_test';
          //put creat db queary if not exist in variable sql

          $bdd->exec($dbq);
          //execute queary  with connection upster

          echo "Database created successfully<br>" ;
         //  message for creat db

          $bdd = new PDO('mysql:host=localhost;dbname=user_test','root','');  
         //put queary connection to sql and db in variable 
         
          $bdd->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
          //Error Handling
             
         

          $table = "CREATE TABLE IF NOT EXISTS users_test( 
                 ID INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
                 firstname VARCHAR( 50 ) NOT NULL ,
                 lastname VARCHAR( 100 ) NOT NULL ,
                 email VARCHAR( 50 ) NOT NULL ,
                 password VARCHAR( 50 ) NOT NULL ,
                 gender VARCHAR( 150 ) NOT NULL)
                 ";
           //put creat table queary if not exist with champs in variable $table

          $tablen = 'users_test';
          $tables = $bdd->query("show tables")->fetchAll(PDO::FETCH_GROUP);
           // $exists = $bdd->query('select 1 from dd88'); not work
           //  prepar sql if table exist

        if ( in_array($tablen, array_keys($tables)) ) {   echo"deja";
        } else { $bdd->exec($table); 
               echo 'Created Table<br>';
               }              
              // test and execute queary  with connection upster      
              //  with message for creat table

            } catch(PDOException $e) {  // catche error in try function and put it in variable $e
                echo $dbq . "<br>" . $e->getMessage();
              }    
                   // and then echo the variable $sql "or more variable" end echo $e 

               ?>