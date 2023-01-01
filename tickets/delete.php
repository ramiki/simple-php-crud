<?php

include "../config/database_oop.php";
// include "simple-php-euth-main/config.php";

$database = new Database();
$db = $database->connect();

// delete GET methode 
if (isset($_GET['ID'])) {

  $user_id = $_GET['ID'];
  $keygen = $_GET['key'];

  // keygen for secure deleting any user id by get methode 
  $sql = "DELETE FROM form WHERE ID = '$user_id' AND keygen = '$keygen' ";
  $result = $db->exec($sql);

  if ($result == TRUE) {
    echo "<br> * Recorde deleted successfully <br>";
  } else {
    echo "Error DB To  Deleting ";
  }
}
?>

<html>
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css"> -->
<form>
  <a href="view.php"><br>
    <input class="btn btn-success" type="button" value="view">
  </a>
</form>

</html>