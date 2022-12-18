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
	$HighScore = $request['HighScore'];
	$username = $request['UserName'];

	

	if (mysqli_connect_errno())
	{
		return "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	else
	{
		echo "Successfully connected to MySQL\nQuerying...\n";
		$query = "INSERT INTO Score_Table (HighScore, UserName) VALUES ('$HighScore','$username')";
		$InsertScore = mysqli_query($conn, $query);
		if ($InsertScore)
		{
			echo "added\n";
			return 'added';
		}
		else
		{
			echo mysqli_error($conn) . "\n not added\n";
			return 'notAdded';
		}
	}
	echo "nothing from database";
	return 'notAdded';
}

$server = new rabbitMQServer("./rmq/localscore.ini","testServer");
echo "Server started" . PHP_EOL;
$server->process_requests('requestProcessor');
exit();  
?>

