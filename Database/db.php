<?php
function OpenCon()
 {
 $dbhost = "localhost";
 $dbuser = "rp783";
 $dbpass = "Shilpa@6303";
 $db = "sql1.njit.edu";
 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
 
  $sql = "SELECT FirstName, LastName, UserName FROM User"; // Your columns name and table name at the end 
  $result = $conn->query($sql);


  if ($result->num_rows > 0) {
    // output data of each row
    echo "<table>";
      echo "<tr>";
          echo "<th>FirstName</th>";
          echo "<th>LastName</th>";
          echo "<th>UserName</th>";
          //echo "<th>Password</th>";
      echo "</tr>";
    while($row = $result->fetch_assoc()) {    
      echo "<tr>";
          echo "<td>" . $row['FirstName'] . "</td>";
          echo "<td>" . $row['LastName'] . "</td>";
          echo "<td>" . $row['UserName'] . "</td>";
          //echo "<td>" . $row['Password'] . "</td>";
      echo "</tr>";

      }
  } else {
    echo "0 results";
  }

 return $conn;
 }

 echo "Success!";
 
function CloseCon($conn)
 {
 $conn -> close();
 }
   
?>