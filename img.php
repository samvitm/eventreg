<?php
       session_start();
       function randomString()        
       {
        $str="";
        for($i=0;$i<5;$i++)
        {
            $num=rand(49,90);
            while(!($num<=57 || $num>64))
            $num=rand(49,90);
            $str.=chr($num);           
        }
        return $str;        
       }
       $random_string=randomString();
       $str=md5(strtolower($random_string));      
       
       $_SESSION['hash']=$str; 
       
       $char1=substr($random_string,0,1);
       $char2=substr($random_string,1,1);
       $char3=substr($random_string,2,1);
       $char4=substr($random_string,3,1);
       $char5=substr($random_string,4,1);
       
       $image = imagecreatetruecolor(150,70);
       $bgcolor = imagecolorallocate($image,219,240,252);
       imagefilledrectangle($image, 0, 0, 300, 300, $bgcolor);
       
       $textcolor1=imagecolorallocate($image,244,126,77);
       $textcolor2=imagecolorallocate($image,0,173,95);
       $textcolor3=imagecolorallocate($image,56,87,167);
       $textcolor4=imagecolorallocate($image,143,68,154);
       $textcolor5=imagecolorallocate($image,237,17,99);
       
       $angle1 = rand(-20, 20);
       $angle2 = rand(-20, 20);
       $angle3 = rand(-20, 20);
       $angle4 = rand(-20, 20);
       $angle5 = rand(-20, 20);
       
       $font1 = "fonts/".rand(2, 10).".ttf";
       $font2 = "fonts/".rand(2, 10).".ttf";
       $font3 = "fonts/".rand(2, 10).".ttf";
       $font4 = "fonts/".rand(2, 10).".ttf";
       $font5 = "fonts/".rand(2, 10).".ttf";
       $size=30;
       
       imagettftext($image, $size, $angle1, 10, $size+15, $textcolor1, $font1, $char1);
       imagettftext($image, $size, $angle2, 35, $size+15, $textcolor2, $font2, $char2);
       imagettftext($image, $size, $angle3, 60, $size+15, $textcolor3, $font3, $char3);
       imagettftext($image, $size, $angle4, 85, $size+15, $textcolor4, $font4, $char4);
       imagettftext($image, $size, $angle5, 110, $size+15, $textcolor5, $font5, $char5);
       header('Content-type: image/png');
       $filename='./image.png';
       //imagepng($image,$filename,0,NULL);
       imagepng($image); 
       imagedestroy($image);
       
    ?>