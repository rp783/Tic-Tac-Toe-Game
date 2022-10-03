<?php
function OpenCon()
 {
 $dbhost = "localhost";
 $dbuser = "rp783";
 $dbpass = "Shilpa@6303";
 $db = "sql1.njit.edu";
 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
 
 return $conn;
 }

 echo "Success!";
 
function CloseCon($conn)
 {
 $conn -> close();
 }
   
?>