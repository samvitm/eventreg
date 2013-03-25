<?php
    session_start();
    
    $connection=mysql_connect("localhost","root","");
    if(!$connection)
    die("error".mysql_error());                             //connect to database and initialize for session variables
    $dbname='apogee';
    mysql_select_db($dbname,$connection)or die("crap");
      
      if(!isset($_SESSION['user']))
       {
            echo "You are not  logged in";              //check id user is logged out
            exit(0);
       }
    
?>
<html>
    <body>
        Edit events: 
        <form action='edited_events.php' method='POST'>
<?php        



$query= " select * from events ";

$result=mysql_query($query,$connection);                            //retrieve all events from database and display

  while($val=mysql_fetch_array($result))
{   
    $value=check($val['id']);
    echo "<input type= 'checkbox' name='events[]' value='$val[id]' '$value' />"."$val[name]"."<br>" ;       // event checkbox is checked if 
}                                                                                                           // user has already registered for the event

function check( $id )               //this fuction is to check whether the user has registered for the particular event or not
{
    $connection=mysql_connect("localhost","root","");
    if(!$connection)
    die("error".mysql_error());
    $dbname='apogee';
    mysql_select_db($dbname,$connection)or die(mysql_error()." crap");                     // connect to database 

  $query= "select events from login where user= '$_SESSION[user]';" ;
  $result=mysql_query($query,$connection);
  $result=mysql_fetch_array($result);                                               // retrieve the events that the user has registered for
  $events=explode(" ",$result['events']);
   
   foreach ($events as $event)
    {
     
     if(!strcmp($id,$event))
     return "checked";                                                              // check if the user has registered for the particular event
     else
     continue;
    }
}
?>
        <input type="submit" value="Edit" />            <!-- End of form -->
    </form>

        </body>
    </html>

