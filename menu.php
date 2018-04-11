<?php

include '../includes/dbConnection.php';
    
    session_start();
    if(!isset($_SESSION["cart"]))
    {
     $_SESSION["cart"]= array();
    }
    $dbConn = getDatabaseConnection('bakery');
    
    
    function displayAll()
    {
    global $dbConn;
    $sql = "SELECT * 
            FROM allitems
            WHERE 1" ;  //Getting all records 
            
        if (isset($_GET['submitRequest']) && $_GET['option'] == "Pan Dulce")
                getPanDulce();
            
            if (isset($_GET['submitRequest']) && $_GET['option'] == "Pastries")
                getPastries();
                
            if (isset($_GET['submitRequest']) && $_GET['option'] == "Drinks")
                getDrinks();
                
            if (isset($_GET['submitRequest']) && $_GET['option'] == "Sandwiches")
                getSandwich();
                
            if (isset($_GET['submitRequest']) && $_GET['option'] == "Vegetarian")
                getVegetarian();
            
            
      $statement= $dbConn->prepare($sql); 
      $statement->execute($namedParameters); //Always pass the named parameters, if any
      $records = $statement->fetchALL(PDO::FETCH_ASSOC);  
      
 

    }
    
    function getPanDulce()
    {
        global $dbConn;
        
        $sql = "SELECT * FROM
            Bread ORDER BY bread";
        
        if (isset($_GET['nameSort']))
            $sql = "SELECT * FROM Bread ORDER BY bread";
            
        if (isset($_GET['sort']))
            $sql = "SELECT * FROM Bread ORDER BY price";
          
        $statement = $dbConn->prepare($sql);
        $statement->execute();
        $pan = $statement->fetchAll(PDO::FETCH_ASSOC);
        
       

        echo "<form >";
        echo "<table align='center'>";
        
        echo "<tr><td> </td>" . "<td>Item</td>" . "<td> Price </td>" . "<td> Image </td></tr>" ;

        
        foreach ($pan as $bread)
        {
            echo "<tr><td>". "<input type='submit' name='cartt'   value =" . $bread['bread'] . "> </td>" ;
            echo "<td>" .$bread['bread']. "</td> <td>" .$bread['price']. "</td><td><img src='img/bread/".$bread['bread'].".jpg'/></td></tr>";
        }
        
        echo "</table>";
        echo "</form>";
        
        
        

        
    }
    function getPastries()
    {
        
        global $dbConn;
        
        $sql = "SELECT * 
                FROM pastries
                ORDER BY name";
                
        if (isset($_GET['nameSort']))
            $sql = "SELECT * FROM pastries ORDER BY name";
        
        if (isset($_GET['sort']))
            $sql = "SELECT * FROM pastries ORDER BY price";
            
        $statement = $dbConn->prepare($sql);
        $statement->execute();
        $records = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        echo "<form >";
        echo "<table align='center'>";
        
                echo "<tr><td> </td>" . "<td>Item</td>" . "<td> Price </td>" . "<td> Image </td></tr>" ;


        foreach ($records as $record)
        {
            echo "<tr><td>". "<input type='submit' name='cartt'  value =" . $record['name'] . "> </td>" ;
            echo "<td>" .$record['name']. "</td><td>" .$record['price']. "</td><td><img src='img/pastries/".$record['name'].".jpg'/></td></tr>";
        }
        
        echo "</table>";
        echo "</form>";
        

        
    }
    
     function getDrinks()
    {
        global $dbConn;
        
        $sql = "SELECT * 
                FROM drinks
                ORDER BY name";
                
        if (isset($_GET['nameSort']))
            $sql = "SELECT * FROM drinks ORDER BY name";
        
        if (isset($_GET['sort']))
            $sql = "SELECT * FROM drinks ORDER BY price";
            
        $statement = $dbConn->prepare($sql);
        $statement->execute();
        $records = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        echo "<form>";
        echo "<table align='center'>";
        
                echo "<tr><td> </td>" . "<td>Item</td>" . "<td> Price </td>" . "<td> Image </td></tr>" ;

        
        foreach ($records as $record)
        {
            echo "<tr><td>". "<input type='submit' name='cartt' value ='".$record['name']."'> </td>" ;
            echo "<td>" .$record['name']. "</td><td>" .$record['price']. "</td><td><img src='img/drinks/".$record['name'].".jpg'/></td></tr>";
        }
        
        echo "</table>";
        echo "</form>";

      
    }
    
?>

<!DOCTYPE html>
<html>
    <head>
        <title> Menu </title>
        <link rel="stylesheet" href="css/project1.css" type="text/css" />
    </head>
    <body>
        
                <h1> <b> La Conchita! </b></h1>


<ul class="topnav">
  <li> <a href="index.php">Home </a> </li>
   <li> <a href="menu.php">Menu </a>  </li>
   <li> <a href="location.php" > Location </a> </li>

</ul>
    
    
    
        <form>
            <h2> Please choose from our wide selection: <select name="option"> </h2>
                <option>Choose one</option>
                <option>Pan Dulce</option>
                <option>Drinks</option>
                <option>Pastries</option>
                <option>Sandwiches</option>
                <option>Vegetarian</option>
            </select>
            
            </br>
           Order Alphebetically: <input type="checkbox" name="nameSort">
            </br>
            Order by price: <input type="checkbox" name="sort">
            </br>
            <input type='submit' name='submitRequest' value="Get Foods">
            <!--<input type='submit' name = "addCartt" value ="Submit">-->
            
        </form>
        
        </nav>
        
        
    <form>
            <?php
            displayAll();
            if(isset($_GET["cartt"]))
            {
            array_push( $_SESSION["cart"],$_GET['cartt']);
            }
            
            
            //print_r($_SESSION["cart"]);
            /*
            if(isset($_GET['addCart']))
            {
                $list=$_POST['cartt'];
                print_r($list);
               foreach($_POST['cartt'] as $item)
                {
                array_push( $_SESSION["cart"],$item);
                }
            }
            
            */        if(isset($_GET['submitRequest']))
            {
            ?> 
            
           
           
           <?php
           }
           ?>
           
         </form>  
              <a href ="scart.php">shopping cart</a>  
                
    </body>
</html>
