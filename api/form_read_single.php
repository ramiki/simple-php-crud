<?php

// headers
header('Access-Controle-Allow-Origin: *');
header('Content-Type: application/json');
// header('Content-type: text/plain');

include_once 'config/database_oop.php';
include_once 'models/form.php';

$database = new Database();
$db = $database->connect();


    // ********   add new column and content

//add form column
// $query= 'ALTER TABLE form ADD colname varchar(255) AFTER form' ;

// prepare statement
// $stmt = $db->prepare($query);

// execute query
// $stmt->execute();

// // find row numbers
// $form = new form($db);
// $result = $form->read();
// $num = $result->rowcount();
// // echo $num;

// // get centent from loripsum api
// $content = file_get_contents('http://loripsum.net/api');
// echo json_encode($content) ;

// // add content to form column
// $query= "UPDATE form SET form = '$content' " ;

// // prepare statement
// $stmt = $db->prepare($query);

// // execute query
// $stmt->execute();


// add centent by row num : not yet 


     //  **********************
 


// Instantiate form object
$form = new form($db);

// Get ID 
$form->id = isset($_GET['id']) ? $_GET['id'] : die(json_encode(array('rep' => false , 'msg' => 'plz give your ID')))  ;

// Get post
$form->read_single();

// Creat result array
$f_post_arr = array(
    'id' => $form->id,
    'firstname' => $form->firstname,
    'lastname' => $form->lastname,
    'email' => $form->email,
    'gender' => $form->gender,
    'form' => $form->form,
    'user_name' => $form->username,
    'created_at' => $form->created_at
);

if ($f_post_arr['id'] !== null ){

// push to "data"
echo json_encode($f_post_arr);

}else{ echo json_encode(array('rep' => false , 'msg' => 'plz give a valid ID')) ;} 