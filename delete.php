<?php

// delete GET methode :

include "config.php";

if(isset($_GET['ID'])) {

    $user_id = $_GET['ID'];

    $sql = "DELETE FROM users_test WHERE ID = '$user_id'";

    $result = $bdd->query($sql);

    if ($result == TRUE)  {
      echo "<br> * Recorde deleted successfully <br>";
      }
      else { echo "Error :" . $sql. "<br>" . $bdd->error ; }

    }  
?>

<html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
   <form>
         <a href="view.php"><br>
         <input class="btn btn-success" type="button" value="view">
         </a>
   </form>
</html>