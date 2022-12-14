<?php
include "config.php";
include "simple-php-euth-main/config.php";

  // Initialiser la session
  session_start();
  // Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
  if(!isset($_SESSION["username"])){
    header("Location: simple-php-euth-main/login.php");
    exit(); 
  }

if(isset($_POST['delete'])) {   // delete in the same page

    $user_id = $_POST['del_id'];    
     // id num returned by delete hiden input

     $sql = "DELETE FROM users_test WHERE ID = :del_id ";
     $sqlu = "DELETE FROM users WHERE ID = $user_id ";
   
    // $result = $bdd->query($sql); // sigle ligne query ( with out prepare & bindparam & execute) but no boolean check
    $resulta = $bdd->prepare($sql);
    $resulta->bindParam(':del_id' , $_POST["del_id"]);
    $resulta->execute();

    $resu = mysqli_query($conn, $sqlu);

    if ($resulta == TRUE OR $resu == TRUE)  {
          echo "<br> * Recorde deleted successfully <br>";
         
         }
         else { echo "Error To Delete "  ; }   
         // . $bdd->error for more explination
       
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD View</title>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="simple-php-euth-main/style.css" />
    <script src="../bootstrap/js/bootstrap.js"></script>
</head>

<body>
    <div class="container p-4">

    <div class="sucess">
    <h1>Bienvenue <?php echo $_SESSION['username']; ?>!</h1>
    <p>C'est votre tableau de bord.</p>
    <a href="simple-php-euth-main/logout.php">Déconnexion</a>
    </div>

        <h2>Users</h2>

    <table class="table">

    <a href="create.php" class="btn btn-primary">
         Add
    </a>
<br><br>
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
<?php

        // query to read all from db
        $sql = "SELECT * FROM users_test";

        // $result = $bdd->query($sql); // sigle ligne query 
        $result = $bdd->prepare($sql);
        $result->execute();

        if($result->rowCount() > 0) {
            while($row = $result->fetch(PDO::FETCH_ASSOC)) {   // fetch pour reternu le resultat query du bdd 
            // foreach ( $result->fetchall(PDO::FETCH_ASSOC) as $k => $row ) {   // fetch with froeach

                // if($row['ID'] == 67 )    {continue;}   // test for skiping id '67'

                    ?>
                <tr>   
                   <td><?php echo "<a href = '?ID= " . $row['ID'] . "' > " . $row['ID']. "</a>"; ?> </td>
                   <!-- just testing link for user manage/show -->
                   <td><?php echo $row['firstname']; ?> </td>
                   <td><?php echo $row['lastname']; ?> </td>
                   <td><?php echo $row['email']; ?> </td>
                   <td><?php echo $row['password']; ?> </td>
                   <td><?php echo $row['gender']; ?> </td>

                   <!-- delete and update POST methode 1 -->
                   <td>
                   <form action="" method="POST">
                   <input  type="hidden" name="del_id" value="<?php print $row['ID']; ?>">  
                   <input class="btn btn-danger" type="submit" name="delete" value="Delete"/> 
                   </td>
                   <td>
                   </form>
                   <form action="update2.php" method="POST"> 
                    <!-- for method we use request or post ( if empty or any other name = get )  -->
                   <input  type="hidden" name="up_id" value="<?php print $row['ID']; ?>">
                   <input class="btn btn-info" type="submit" name="update" value="Update"/>
                   </form>
                   </td>

                   <!-- delete and update GET methode -->
                   <!-- <td> <a class="btn btn-danger" href="delete.php?ID=<?php //echo $row['ID']; ?>&key=<?php //echo $row['keygen']; ?>"> Delete </a> </td> -->
                   <!-- keygen for secure deleting any user id by get methode -->
                   <!-- <td> <a class="btn btn-info"   href="update.php?ID=<?php //echo $row['ID']; ?>"> Edit   </a> </td> -->
                </tr>
               
                    <?php 

    } 
        }else{ echo "BD Error To View !! OR Empty BD " ; }
        
?>

       </tbody>
     </table>
    </div>
</body>
</html>


  <!-- **************  Pagination   ****************** -->

<div class="container p-4">

<h2>admin's in Pagination</h2>

<table class="table">

<a href="simple-php-euth-main/register.php" class="btn btn-primary">
 Add
</a>
<br><br>
<thead>
<tr>
<th>ID</th>
<th>User Name</th>
<th>Email</th>
<th>Password</th>
</tr>
</thead>

<tbody> 

<?php

// ********* pagination script 

$resultpage = 3 ;
$numrow = $result->rowcount();

if (!isset($_GET["page"]) || empty($_GET["page"]) ) {
    $page = 1 ;
}elseif (isset($_GET["page"])){
    $page = $_GET["page"] ;
}

$totalp = ceil($numrow / $resultpage) ;

for( $co = 1 ; $co <= $totalp ; ++$co) {
echo "<a style = ' color: black;  float: left; position: relative; left: 40%; padding: 10px 25px;  text-decoration:underline overline #FF3028;' href = 'view.php?page=" . $co. "'>" .$co . "<a>" ;
}

// $sqla = "SELECT * FROM users LIMIT " . $resultpage . "," .  ($page-1)*$resultpage ;  // didnt work with , ( coma )
$sqla = "SELECT * FROM users LIMIT " . $resultpage . " OFFSET ". ($page-1)*$resultpage ;
$n = mysqli_query($conn, $sqla);  // mysqli connection
// $n = $bdd->prepare($sqla);  pdo connection ( not work )
// $n->execute();

foreach ($n as $b){

    ?>
                <tr>   
                   <td><?php echo "<a href = '?ID= " . $b['ID'] . "' > " . $b['ID']. "</a>"; ?> </td>
                   <!-- just testing link for user manage/show -->
                   <td><?php echo $b['username']; ?> </td>
                   <td><?php echo $b['email']; ?> </td>
                   <td><?php echo substr(password_hash($b['password'], PASSWORD_DEFAULT) , 0 , 30); ?> </td>

                   <!-- delete and update POST methode 1 -->
                   <td>
                   <form action="" method="POST">
                   <input  type="hidden" name="del_id" value="<?php print $b['ID']; ?>">  
                   <input class="btn btn-danger" type="submit" name="delete" value="Delete"/> 
                   </td>
                </tr>

                <?php  }  ?>
                
        </tbody>
     </table>
    </div>

<?php   

    // testing pagination position 
    
    // work 
    // for( $co = 1 ; $co <= $totalp ; ++$co) {
    //     echo "<a style = ' color: black;  float: left; position: relative; left: 40%; padding: 10px 25px;  text-decoration:underline overline #FF3028;' href = 'view.php?page=" . $co. "'>" .$co . "<a>" ;
    // } 
?>
    <!-- not work !! -->
    <!-- <a style = ' color: black;  float: left; position: relative; left: 40%; padding: 10px 25px; text-decoration:underline overline #FF3028;' href = 'view.php?page=<?php $co ;  ?>' >ff <?php $co ;  ?> </a> -->
