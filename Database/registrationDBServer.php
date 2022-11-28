#!/usr/bin/php
<?php
require_once('./rmq/path.inc');
require_once('./rmq/get_host_info.inc');
require_once('./rmq/rabbitMQLib.inc');
function requestProcessor($request)
{

	echo "received request".PHP_EOL;
	$host = 'localhost';
	$user = 'rutvikpatel7';
	$pass = 'Rutvik@6303';
	$db = 'ProjectDB';
	$conn = mysqli_connect($host, $user, $pass, $db);
	$firstname = $request['firstname'];
	$lastname = $request['lastname'];
	$username = $request['username'];
	$password = $request['password'];
    $email=$request['email']; 
	

	if (mysqli_connect_errno())
	{
		return "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	else
	{
		echo "Successfully connected to MySQL\nQuerying...\n";
		$query = "INSERT INTO UserTable (FirstName,LastName, UserName, Password, Email) VALUES ('$firstname', '$lastname', '$username', '$password', '$email')";
		$createUser = mysqli_query($conn, $query);
		if ($createUser)
		{
			echo "created\n";
			return 'created';
		}
		else
		{
			echo mysqli_error($conn) . "\n not created\n";
			return 'notCreated';
		}
	}
	echo "nothing from database";
	return 'notCreated';
}

$server = new rabbitMQServer("./rmq/registerToDB.ini","testServer");
echo "Server started" . PHP_EOL;
$server->process_requests('requestProcessor');
exit();
?>

