<?php

// headers
header('Access-Controle-Allow-Origin: *');
header('Content-Type: application/json');

include_once 'config/database_oop.php';
include_once 'models/form.php';

// Instantiate DB & connect to it
$database = new Database();
$db = $database->connect();

// Instantiate form object
$form = new tickets($db);

// Form query
$result = $form->read();
// Get row count
$num = $result->rowcount();

//check if the key is valable
$check = $form->chek_keygen();
$check2 = $check->rowcount();

// check if any form post
if($num > 0 & $check2 > 0) {

    //form post array
    $f_posts_arr = array();
    $f_posts_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row); //  Import variables into the current symbol table from an array , insted of $row['id'] .... , give direct variabes : $id

        $f_post_item = array(
            'id' => $ID,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'gender' => $gender,
            'form' => $form,
            'keygen' => $keygen,
            'created_at' => $created_at
        );
      
    // push to "data"
    array_push($f_posts_arr['data'],$f_post_item); 
 
    }
  
            echo json_encode($f_posts_arr);       
            
} else{
    // no form posts
    echo json_encode(
        array('rep' => false , 'msg' => 'plz entre a valide key')
    );

}
