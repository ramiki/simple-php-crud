<?php

          // ------------------------connection-----------------------------------------

try{
           $bdd = new PDO('mysql:host=localhost;','root','');  
           //put queary connection to sql in variable 
          
          $bdd->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
          //Error Handling
         



          // ********** drop or creat db


          $dbname = "user_test";
          $dbq    = "CREATE DATABASE IF NOT EXISTS $dbname";
          //put creat sql queary if not exist in variable

          // $dbs    = "DROP DATABASE IF EXISTS $dbname";  // for drop db

          $stmt = $bdd->query("SHOW DATABASES LIKE '$dbname'");  // second method to check if db exist
          // $stmt = $bdd->query("SELECT * FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'user_test'");  // check if db exist


                // therd method to check if db exist with statment 
          // $sr = "SHOW DATABASES LIKE '$dbname'";  
          // $stmt = $bdd->prepare($sr);
          // // $hh->bindParam(':dbname', $dbname);  // didnt work with SHOW !
          // $stmt->execute();
          // var_dump($stmt->fetchColumn());
          // die;


          if ( $stmt->fetchColumn() == false){
            $bdd->exec($dbq);
            //execute queary  with connection upster 
            echo "Database created successfully<br>" ;
          } elseif ( isset($dbs) ) { 
            echo "existed database and droped / refresh to creat it again <br> " ;   
            $bdd->exec($dbs);  // drop db to creat it again 
          } else {  
            echo " existed database <br>"; 
          }

       

        } catch(PDOException $e) {  // catche error in try function and put it in variable $e
          echo "there was an error in table block " . "<br>" . $e->getMessage();
        }  // and then echo the variable $sql "or more variable" end echo $e 


          // ------------------------creat table-----------------------------------------
          


          $ndd = new PDO("mysql:host=localhost;dbname=$dbname",'root','');  
         //put queary connection to sql and db in variable 
         
         $ndd->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
         //Error Handling

          $tablen = 'users_test';
          $table = "CREATE TABLE IF NOT EXISTS $tablen( 
                 ID INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
                 firstname VARCHAR( 50 ) NOT NULL ,
                 lastname VARCHAR( 100 ) NOT NULL ,
                 email VARCHAR( 50 ) NOT NULL ,
                 password VARCHAR( 50 ) NOT NULL ,
                 gender VARCHAR( 150 ) NOT NULL)
                 ";
           //put creat table queary if not exist with champs in variable $table

                 
          $tables = $ndd->query("show tables")->fetchAll(PDO::FETCH_GROUP);
          //  $exists = $ndd->query("SELECT 1 from $tablen"); // second method (problem when catch error 'remove  set attr error to work')
           
           //  check if table exist
          //  if ( $exists ) {   echo" existed table <br> ";   // second method
           if ( in_array($tablen, array_keys($tables)) ) {   echo " existed table <br> ";
           } else { $ndd->exec($table); 
               echo 'Created Table<br>';
               }              
              // test and execute queary  with connection upster      
              //  with message for creat table      

         
              
