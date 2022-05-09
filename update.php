<?php

// update get methode : 

include "config.php";

if (isset($_POST['update'])) {

    $firstname = $_POST['firstname'];
    $user_id = $_GET['ID'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];

    $sql = "UPDATE users_test SET firstname='$firstname',lastname='$lastname',email='$email',password ='$password',gender='$gender' WHERE ID='$user_id'";

    $result = $bdd->query($sql);
    $bdd->exec($sql);

    if ($result == TRUE) {

        echo "Record Updated succesfully";
        $bdd->exec($sql);
    } else {
        echo "Eroor:";
    }
}

if (isset($_GET['ID'])) {

    $user_id = $_GET['ID'];

    $sql = "SELECT * FROM users_test WHERE ID = '$user_id'";

    $result = $bdd->query($sql);

    // if ($result->num_row > 0)  {
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

        $firstname = $row['firstname'];
        $user_id = $row['ID'];
        $lastname = $row['lastname'];
        $email = $row['email'];
        $password = $row['password'];
        $gender = $row['gender'];
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
        <h2 align="center"> Update User Info </h2>
        <form action="" method="POST">
            <fieldset style="margin: 35px ;  background-color:lavender ">
                <legend>
                    <h3> personal Information </h3>
                </legend>
                <div style="margin: 35px  ">
                    First Name : <br>
                    <input type="text" name="firstname" value="<?php echo $firstname; ?>">
                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
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
                    <input type="radio" name="gender" value="Male" <?php if ($gender == 'Male') {
                                                                        echo 'checked';
                                                                    } ?>>Male
                    <input type="radio" name="gender" value="Female" <?php if ($gender == 'Female') {
                                                                            echo 'checked';
                                                                        } ?>>Female
                    <br><br>
                    <input type="submit" name="update" value="update">
                </div>
            </fieldset>
        </form>
    </body>

    <form>
        <a href="view.php">
            <input style="background-color: #4CAF50; /* Green */ padding: 6px 16px; font-size: 15px; margin: 0px 14px;" type="button" value="view">
        </a>
    </form>

    </html>

<?php

} else {
    //if the 'id' value is not valid , redirect the user back to view.php page
    header('location:view.php');
}

// }

?>