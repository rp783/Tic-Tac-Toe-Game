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
    
    $firstname = '';
	$lastname = '';
	$username ='';
	$password = '';
    $email='';

	if (mysqli_connect_errno())
	{
		return "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	else
	{
		echo "Successfully connected to MySQL\nQuerying...\n";
		$query = "SELECT * FROM UserTable WHERE (FirstName,LastName, UserName, Password, Email) = ('$firstname', '$lastname', '$username', '$password', '$email')";
		$getProfile = mysqli_query($conn, $query);
		$result = mysqli_num_rows($getProfile);

        $request = array(
            'FirstName' => $firstname,
            'LastName' => $lastname,
            'UserName' => $username,
            'Password' => $password,
            'Email' => $email);
            return $request;
        switch($request)
        {
            case "request";
            echo "send informaton";
            return $request;
        } 

        
    }

}

$server = new rabbitMQServer("./rmq/profileToDB.ini","testServer");
echo "Server started" . PHP_EOL;
$server->process_requests('requestProcessor');
exit();
?>

