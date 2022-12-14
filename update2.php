<?php

// update POST or REQUEST methode :

include "config.php";

if (isset($_REQUEST['up_id'])) {     // REQUEST to fint out what methode is used ( post / get / cookie )

    $user_id = $_REQUEST['up_id'];
    $sql     = "SELECT * FROM users_test WHERE ID = '$user_id'";

    // $result  = $bdd->query($sql);  // direct sql query
    $result  = $bdd->prepare($sql);
    $resulta = $result->execute();  // return boolean to check

    if ($resulta) {

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $firstname = $row['firstname'];
            $lastname  = $row['lastname'];
            $email     = $row['email'];
            $password  = $row['password'];
            $gender    = $row['gender'];
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
            <br>
            <h2 align="center"> Update User Info </h2>
            <form action="" method="POST">
                <fieldset style="margin: 35px ;  background-color:lavender ">
                    <legend>
                        <h3> personal Information </h3>
                    </legend>
                    <div style="margin: 35px  ">
                        First Name : <br>
                        <input type="text" name="firstname" value="<?php echo $firstname; ?>">
                        <br>
                        Last Name : <br>
                        <input type="text" name="lastname" value="<?php echo $lastname; ?>">
                        <br>
                        Email : <br>
                        <input type="text" name="email" value="<?php echo $email; ?>">
                        <br>
                        Password : <br>
                        <input type='password' name='password' value="<?php echo $password; ?>">
                        <br>
                        Gender : <br>
                        <input type="radio" name="gender" value="Male"   <?php if ($gender == 'Male')   { echo 'checked'; } ?>> Male
                        <input type="radio" name="gender" value="Female" <?php if ($gender == 'Female') { echo 'checked'; } ?>> Female
                        <br><br>
                        <input type="submit" name="upd" value="update">
                        <input type="hidden" name="up_id" value="<?php echo $user_id; ?>">
                    </div>
                </fieldset>
            </form>
            <a href="view.php" style="background-color: #4CAF50; /* Green */ padding: 6px 16px;  margin:35px;" > View </a>
        </body>

        </html>

        <?php
    } else {
                echo '<script type="text/javascript">';
                echo 'alert("DB Error To Update !! ");';
                echo '</script>';
            }
} else {
    echo "access refuse <a href='view.php' style='background-color: #4CAF50; /* Green */ padding: 6px 16px;  margin: 0px 14px;' type='button' value='view'> 
        View   </a>";
}

if (isset($_POST['upd'])) {

    $user_id   = $_POST['up_id'];
    $firstname = $_POST['firstname'];
    $lastname  = $_POST['lastname'];
    $email     = $_POST['email'];
    $password  = $_POST['password'];
    $gender    = $_POST['gender'];

    $sql = "UPDATE users_test SET firstname='$firstname',lastname='$lastname',email='$email',password ='$password',gender='$gender' WHERE ID='$user_id'";
    $result = $bdd->prepare($sql);
    $check = $result->execute();

    if ($check) {
        echo '<script type="text/javascript">';
        echo 'alert("User Updated");';
        echo 'window.location.href = "view.php";';
        echo '</script>';
    } else {
        echo '<script type="text/javascript">';
        echo 'alert("DB Error To Update !! ");';
        echo '</script>';
    }
}

?>