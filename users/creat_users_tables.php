<?php

try{


          $bdd = new PDO('mysql:host=localhost;dbname=tickets_app','root','');  
         //put queary connection to sql and db in variable 
         
          $bdd->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
          //Error Handling    

          $tablen = 'users';
          $table = "CREATE TABLE IF NOT EXISTS $tablen( 
                 ID INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
                 username VARCHAR( 50 ) NOT NULL ,
                 email VARCHAR( 50 ) NOT NULL ,
                 password VARCHAR( 100 ) NOT NULL ,
                 pass VARCHAR( 50 ) NOT NULL ,
                 created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
                 lastUpdated TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
                 )";
           //put creat table queary if not exist with champs in variable $table

         
          $tables = $bdd->query("show tables")->fetchAll(PDO::FETCH_GROUP);
           // $exists = $bdd->query('select 1 from users'); not work
           //  find if table exist

        if ( in_array($tablen, array_keys($tables)) ) { echo"deja";
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