 <?php
$servername = "localhost";
$username = "rutvikpatel7";
$password = "Rutvik@6303";

// Create connection
$conn = mysqli_connnect($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
	echo "non";
}
echo "Connected successfully";
?> 
