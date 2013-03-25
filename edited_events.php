<html>
    </body>
        
<?php
    session_start();
    $connection=mysql_connect("localhost","root","");
    if(!$connection)
    die("error".mysql_error());             // connect to database and initialize session variables
    $dbname='apogee';
    mysql_select_db($dbname,$connection)or die("crap");
      
         if(!isset($_SESSION['user']))
       {
       
        echo "You are not  logged in";                  //check if user is logged out and trying to access home page
        exit(0);
       
       }
?>
<?php
    if(isset($_POST['events']))
    $events= implode(" ",$_POST['events']);
    else
    $events=NULL;
    $query="update login set events ='$events' where user = '$_SESSION[user]';";
    mysql_query($query,$connection) or die(mysql_error($connection));                   //put the updated data into the database
    echo "Your events have been changed";
    
?>
    <br>
    <a href="./home.php" >Home</a><br>
    <a href="./logout.php" >Logout </a></br>
    
    </body>
</html>