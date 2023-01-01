<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="../style/style.css" />
</head>
<body>
<?php

require('../config/database_oop.php');
// test mysqli connection

  // Initialiser la session
  session_start();
  // Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
  if(isset($_SESSION["username"])){
    // echo "<div class='sucess'>" ;
    // echo "<h1>vous etes deja login : " . $_SESSION["username"] . "</h1><br>" ;
    // echo "<h2><a href='index.php'>votre tableau de bord ici</a></h2>" ;
    // echo "</div>" ; 
    header("Location: ../tickets/view.php");
    exit(); 
  }

if (isset($_POST['username'])){
  $username = stripslashes($_REQUEST['username']);
  $username = mysqli_real_escape_string($conn, $username);
  $password = stripslashes($_REQUEST['password']);
  $password = mysqli_real_escape_string($conn, $password);
    $query = "SELECT * FROM `users` WHERE username='$username' AND password='".hash('sha256', $password)."'";
  $result = mysqli_query($conn,$query) or die( mysqli_connect_error());
  $rows = mysqli_num_rows($result);

  if($rows==1){
      $_SESSION['username'] = $username;
      header("Location: index.php");
  }else{
    $message = "Le nom d'utilisateur ou le mot de passe est incorrect.";
  }
}
?>
<form class="box" action="" method="POST" name="login">
<h1 class="box-logo box-title"><a href="">euth</a></h1>
<h1 class="box-title">Connexion</h1>
<input type="text" class="box-input" name="username" placeholder="Nom d'utilisateur">
<input type="password" class="box-input" name="password" placeholder="Mot de passe">
<input type="submit" value="Connexion " name="submit" class="box-button">
<p class="box-register">Vous êtes nouveau ici? <a href="register.php">S'inscrire</a></p>
<?php if (!empty($message)) { ?>
    <p class="errorMessage"><?php echo $message; ?></p>
<?php } ?>
</form>
</body>
</html>