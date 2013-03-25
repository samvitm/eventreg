<?php
$connection=mysql_connect("localhost","root","");
    if(!$connection)
    die("error".mysql_error());                                 //initialize session and connect to database
    $dbname='apogee';
    mysql_select_db($dbname,$connection)or die("Error");
    session_start();
    
?>
<html lang='en'>
<head>
    <title>New User</title>   
    
    <script type="text/javascript">
        
    function fName()
    {
        var fn=document.getElementById('fname').value;
        if(!(valid(fn)) || fn.length>15)
        document.getElementsByTagName('abc')[0].innerHTML="Enter Valid Information/Limit-15 characters";
        else
        document.getElementsByTagName('abc')[0].innerHTML="";           
    }
    function lName()
    {
        var ln=document.getElementById('lname').value;
        if(!(valid(ln)) || ln.length>20)
        document.getElementsByTagName('abc')[1].innerHTML="Enter Valid Information/Limit-20 characters";
        else
        document.getElementsByTagName('abc')[1].innerHTML="";
    }   
   
    function checkEmail(){
        var str=document.getElementById('email').value;
        var ans=true;
        var i=str.indexOf('@');
        if(i<4)
        ans=false;
        var j=str.indexOf('.',i);
        if(j<=i+2)
        ans=false;
        if(str.length<j+3)
        ans=false;
        if(i==-1 || j==-1)
        ans=false;        
        if(ans==false)
        document.getElementsByTagName('abc')[3].innerHTML="Please give a valid email-id";
        else
        document.getElementsByTagName('abc')[3].innerHTML="";
    }
    
    function college1()
    {
        var coll=document.getElementById('college').value;
        if(coll.length>100)
        document.getElementsByTagName('abc')[2].innerHTML="Limit-100 char";
        else
        document.getElementsByTagName('abc')[2].innerHTML="";        
    }
    
    function address1()
    {
        var add=document.getElementById('address').value;
        if(add.length>100)
        document.getElementsByTagName('abc')[4].innerHTML="Limit-100 char";
        else
        document.getElementsByTagName('abc')[4].innerHTML="";       
    }
    
    function valid(strin)
    {
        var ans=true;
        strin=strin.toLowerCase();
		if(!strin.length)
		ans=false;
        for(var i=0;i<strin.length;i++)
        if((strin.charAt(i)<97 || strin.charAt(i)>122 )&& (strin.charAt(i)!=' ' || strin.charAt(i)!='.') )
        ans=false;
        return ans;         
    }
    
    function checkForm()
    {
        var s;
        var ans=true;
		var abc=document.getElementsByTagName('input');
		for(var i=0;i<abc.length;i++)
        {
            s=abc[i];
            if(s.value=="")
            ans=false;
        }
        for(var i=0;i<6;i++)
        {
            s=document.getElementsByTagName('abc')[i].innerHTML;
            if(s)
            ans=false;
        }
		
        return ans;
    }    
    function reloadImage()
    {
      document.getElementsByTagName('img')[0].src="blank";
      document.getElementsByTagName('img')[0].src="img.php?"+Math.random();
      alert("this is reload image function");
    }
    
    function confirmPassword()
    {   var pass=document.getElementById('password').value;     
        if(pass==(document.getElementById('confirmnewpassword').value) && pass.length<9)
        document.getElementsByTagName('abc')[5].innerHTML="";
        else
        document.getElementsByTagName('abc')[5].innerHTML="Both Passwords Do Not Match/Limit-8 char";
    }
    
    function writeCookie(name,value,days)
    {
        var expires="";
        if(days)
        {
            var date=new Date();
            date.setTime(date.getTime()+days*24*3600*1000);
            expires="; expires ="+date.toGMTString();
        }
        document.cookie=name+"="+value+expires+"; path=/";
        
    }
    
    function getCookie(name)
    {
    if (document.cookie.length>0)
    {
        start=document.cookie.indexOf(name+"=");
        if (start!=-1)
        {
        start=start + name.length+1;
        end=document.cookie.indexOf(";",start);
        if (end==-1) end=document.cookie.length;
        return unescape(document.cookie.substring(start,end));
        }
    }   
    return "";
    }   
</script>
    
</head>
<body>
    <form action="register.php"  method="POST" onSubmit="return checkForm();">
        <label for='fname'>First Name:</label>
        <input type='text' name='fname' maxlength="15" id='fname' onBlur="fName()" />*<abc></abc><br>
        <label for ='lname'>Last Name:</label>
        <input type='text' name='lname' id='lname' maxlength="20" onBlur="lName()"/>*<abc></abc><br>
        <label for ='sex'>Sex:</label>
        Male<input type='radio' name='sex'  id='sex' value="0" />
        Female<input type='radio' name='sex' checked="yes" id='sex' value="1"/><br>
        <label for ='college'>College:</label>
        <input type='text' maxlength="100" name='college' id='college' onBlur="college1()"/>*<abc></abc><br>
        <label for ='email'> Email:</label>
        <input type='text' name='email' id='email' onBlur="checkEmail()"/><abc></abc><br>
        <label for ='address' >Address:</label>
        <!--type='text' maxlength="100" size="50"-->
        <textarea  name='address' id='address' onBlur="address1()"></textarea></textarea><abc></abc><br>
        <label for ='user'>Username:</label>
        <input type='text' name='user' id='user'/>*<br>
        <label for ='password'>Password:</label>
        <input type='password' name='password' id='password' maxlength="8"/>*<br>
        <label for ='confirmnewpassword'>Confirm new password:</label>
        <input type='password' maxlength="8" name='confirmnewpassword' id='confirmnewpassword' onBlur="confirmPassword()"/>*<abc></abc><br>
        
        <br>
        <?php
        $query= " select * from events ";
        $result=mysql_query($query,$connection);
        while($val=mysql_fetch_array($result))
        {   
            echo "<input type= 'checkbox' name='events[]' value='$val[id]'/>"."$val[name]"."<br>" ;         //retrive events from database and put it into a form
        }
        ?>        
        <img src="img.php" />
        <input type="text" id="captcha" name ='captcha'/>
        <input type='button' onClick="reloadImage()" value ="redraw"/><br>
        <input type='submit' value="Submit"/>        
    </form>
</body>
</html>