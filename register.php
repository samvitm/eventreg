<?php
session_start(); // start session
?>

<html>
    <head>
        <title>REGISTER</title>
        </head>
<body>
<?php

function save()         // this function adds a record to the database
{
    

    $connection=mysql_connect("localhost","root","");
    if(!$connection)
    die("error".mysql_error());                                         //connect to databse
    $dbname='apogee';
    mysql_select_db($dbname,$connection)or die("crap");
    
    $pass=md5(strtolower($_POST['password'])); // hash the password
   
    if(isset($_POST['events']))                                                  //insert record into tables
    $events= implode(" ",$_POST['events']);
    else
    $events=NULL;
    
    $user=strtolower($_POST['user']);
    
    $query2=" insert into login values ('$user' , '$pass',NULL, '$events' );";
    mysql_query($query2, $connection) or die(" username already taken/ invalid password  <a  href='./new_user.php'> Go to Login </a>" . mysql_error($connection));
    
    $query= "INSERT INTO registration VALUES (NULL, '$_POST[fname]', '$_POST[lname]', '$_POST[college]', '$_POST[sex]', '$_POST[email]', '$_POST[address]');";
    mysql_query($query,$connection) or die(mysql_error($connection));
                                       // there are 2 tables: 1. participant details  2: login details and events
    
    
    
    echo "Registration Successful!";
    echo  "<a href='./login_new.php' > Go to Login Page </a>";
}
checkCaptcha();
function checkCaptcha()
{
    if(isset($_POST['captcha']))
   { 
    $captcha=md5(strtolower($_POST['captcha']));    
    if(strcmp($captcha,$_SESSION['hash'])==0)                   // image verification 
    {
        save();
        exit;
    }   

    else
        echo "<br> Captcha did not match<br>";
        echo "<a href='new_user.php'>Please fill the form correctly</a>";
        
   }
   else
      echo "you are not logged in";                             // put header to redirect to new_user.php
}

?>
    </body>
</html>
