<!-- whole page is divided into three blocks of code if required each block can be put into one function-->
<?php
// connecting to database ans starting session variables
session_start();
$connection=mysql_connect("localhost","root","");
    if(!$connection)
    die("error".mysql_error());
    $dbname='apogee';
    mysql_select_db($dbname,$connection)or die("Error");
    
    if(isset($_POST['user']))
    $_SESSION['user']=$_POST['user'];
    
?>
<html>
    <body>
     <?php
       //check if redirected from login page
        if(!isset($_SESSION['user']))
       {
       
        echo "You are not  logged in";                  //check if user is logged out and trying to access home page
        exit(0);
       
       }
       if(isset($_POST['user']))
       {
        $user=strtolower($_POST['user']);
        $query= " select * from login where user = '$user' ;";
        $result=mysql_query($query,$connection);
        $res=mysql_fetch_array($result);
        
        if(md5($_POST['pass'])==$res['pass'])                                   //password match
          {
                //echo "You have been successfully logged in "."<br>";
                $_SESSION['user']=$_POST['user'];
                                
          }
            
        else
            {
                 echo "Incorrect username or password"."<a href='./login_new.php'> Go to Login </a>";           //if error in password or username
                 exit(0);                                                                                       // stop running scripts
            } 
       }    
    ?>
    
         <br>
         
        <a href="./logout.php" >Logout </a></br>                <!--Navigation-->
              
    </body>
</html>

  