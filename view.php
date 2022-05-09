<?php

//view with delete methode : 

include "config.php";

if(isset($_POST['delete'])) {  

    $user_id = $_POST['del_id']; 

   $sql = "DELETE FROM users_test WHERE ID = '$user_id'";

   $result = $bdd->query($sql);
   if ($result == TRUE)  {
          echo "<br> * Recorde deleted successfully <br>";
         }
         else { echo "Error :" . $sql. "<br>" . $bdd->error ; }
    }

$sql = "SELECT * FROM users_test";

$result = $bdd->query($sql);
// $bdd->exec($sql);

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD View</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container">

        <h2>Users</h2>

    <table class="table">

<thead>
    <tr>
        <th>ID</th>
        <th>First name</th>
        <th>Last name</th>
        <th>Email</th>
        <th>Password</th>
        <th>Gender</th>
        <th>Action</th>
    </tr>
</thead>

<tbody>
         <a href="create.php" class="btn btn-primary">
         Add
         </a>
    <?php
        // if($result->num_rows > 0) {
        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $user_id = $row['ID'];
           ?>
        <br>
           <tr>
               <td><?php echo $row['ID']; ?> </td>
               <td><?php echo $row['firstname']; ?> </td>
               <td><?php echo $row['lastname']; ?> </td>
               <td><?php echo $row['email']; ?> </td>
               <td><?php echo "*******"; ?> </td>
               <td><?php echo $row['gender']; ?> </td>

               <!-- delete and update methode 1 -->
               <td>
               <form action="" method="POST">
               <input  type="hidden" name="del_id" value="<?php print $user_id; ?>">
               <input class="btn btn-danger" type="submit" name="delete" value="Delete"/> 
               </td>
               <td>
               </form>
               <form action="update2.php" method="">
               <input  type="hidden" name="up_id" value="<?php print $user_id; ?>">
               <input class="btn btn-info" type="submit" name="update" value="Update"/>
               </form>
               </td>

               <!-- delete and update methode 2 -->
               <!-- <td> <a class="btn btn-info" href="update.php?ID=<?php //echo $row['ID']; ?>"> Edit </a> -->
               <!-- &nbsp; -->
               <!-- <a class="btn btn-danger" href="delete.php?ID=<?php //echo $row['ID']; ?>"> Delete </a>  // delete GET methode --> 
               <!-- </td> -->
             </tr>
               
           <?php   }     ?>

       </tbody>
     </table>
    </div>
</body>

</html>