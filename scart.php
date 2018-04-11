<?php
session_start();
include '../includes/dbConnection.php';

$dbConn = getDatabaseConnection('bakery');
$sql= "SELECT price FROM allitems WHERE name= ";
echo "<!DOCTYPE html>
<html>
    <head>
        <title> Menu </title>
        <link rel='stylesheet' href='css/project1.css' type='text/css' />
    </head>
    <body>
    
        
                <h1> <b> La Conchita! </b></h1>


<ul class='topnav'>
  <li> <a href='index.php'>Home </a> </li>
   <li> <a href='menu.php'>Menu </a>  </li>
   <li> <a href='location.php' > Location </a> </li>

</ul>";
echo "<ul>
<h2>";
$total=0;
if(isset($_GET['clear']))
{
    unset($_SESSION["cart"]);
}
else{
foreach($_SESSION["cart"] as $item )
{
    $sql= "SELECT DISTINCT * FROM allitems WHERE name= '".$item."'";
    $statement= $dbConn->prepare($sql); 
      $statement->execute(); //Always pass the named parameters, if any
      $records = $statement->fetch(PDO::FETCH_ASSOC); 
      echo"<li>".$records["name"]." ".$records["price"]."$</li>";
      $total+=$records["price"];
      
      
}
}
echo "total= ".$total."</h2>";
?>

        

<br/>
<a href="menu.php">Return Shopping</a>
<form>
<input type='submit' name='clear' value="clear">
</form>

    
</body>