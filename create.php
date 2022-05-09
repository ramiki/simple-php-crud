<?php 


include "config.php";

if(isset($_POST['submit'])) {

    $first_name = $_POST['firstname'];
    $last_name = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $gender = @$_POST['gender'];

    $sql = "INSERT INTO users_test(firstname,lastname,email,password,gender) VALUES('$first_name','$last_name','$email','$password','$gender')";

    // $result = $bdd->prepare($sql);
    // $result->execute();

if(empty($first_name) OR empty( $last_name) OR empty($email) OR empty($password)){

    echo "PLZ remplie les champs:" . "<br>"  ;

}  
else{

    $bdd->exec($sql);
    echo "new record created succesfully";   
    $bdd = null ;
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
        <legend>  <h3> personal Information </h3> </legend>
        <div style="margin: 35px  ">
        First Name : <br>
        <input type="text" name="firstname" >
        <br>
        Last Name : <br>
        <input type="text" name="lastname" >
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