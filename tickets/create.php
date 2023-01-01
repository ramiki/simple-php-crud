<?php

include "../config/database_oop.php";
// include "simple-php-euth-main/config.php";

$database = new Database();
$db = $database->connect();

 // Initialiser la session
 session_start();
 // Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
 if(!isset($_SESSION["username"])){
   header("Location: ../users/login.php");
   exit(); 
 }


//  $t = "ALTER TABLE `form` AUTO_INCREMENT=200";
//  $b = $db->prepare($t);
//  $b->execute();


 $username = $_SESSION['username'] ; 

 $sqlid = " SELECT ID , username FROM users WHERE username = '$username' " ;
 $r = $db->query($sqlid);
 $userid = $r->fetch(PDO::FETCH_ASSOC);

$uid = $userid["ID"] ;
$uname = $userid["username"] ;

if (isset($_POST['submit'])) {

    $keygen = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 50);
    $first_name = $_POST['firstname'];
    $last_name = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $gender = @$_POST['gender'];

   
    $sql = "INSERT INTO form (firstname,lastname,email,password,gender,keygen,userid , username) VALUES('$first_name','$last_name','$email','$password','$gender','$keygen', '$uid','$uname' )";

    if (empty($first_name) or empty($last_name) or empty($email) or empty($password)) {
        echo "PLZ remplie les champs:" . "<br>";
    } else {

        // $db->exec($sql); // with out prepare & execute
        $result = $db->prepare($sql);
        $result->execute();
        echo "new record created succesfully";
        // $db = null ;  // (deconnecting)

        // test lastinsertid
        // echo $f = $db->lastInsertId();
        // $s = "SELECT * FROM  users_test WhERE ID = '$f' ";
        // $result  = $db->prepare($s);
        // $resulta = $result->execute();  // return boolean to check
        // $row = $result->fetch(PDO::FETCH_ASSOC);

        // echo "<pre>";
        // print_r($row["firstname"]);
        // echo "</pre>";

    }
}
?>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Add</title>

</head>

<body>
    <h2 align="center"> Signup Form </h2>
    <form action="" method="POST">
        <fieldset style="margin: 35px ;  background-color:lavender ">
            <legend>
                <h3> personal Information </h3>
            </legend>
            <div style="margin: 35px  ">
                First Name : <br>
                <input type="text" name="firstname">
                <br>
                Last Name : <br>
                <input type="text" name="lastname">
                <br>
                Email : <br>
                <input type="text" name="email">
                <br>
                Password : <br>
                <input type="password" name="password">
                <br>
                Gender : <br>
                <input type="radio" name="gender" value="Male">Male
                <input type="radio" name="gender" value="Female">Female
                <br><br>
                <input type="submit" name="submit" value="submit">
            </div>
        </fieldset>
    </form>
</body>

<form>
    <a href="view.php">
        <input style="background-color:lawngreen ; /* Green */ padding: 6px 16px; font-size: 15px; margin: 0px 40px;" type="button" value="view">
    </a>
</form>

</html>