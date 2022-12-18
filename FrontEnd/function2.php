<?php

function getprofile(){
$client = new rabbitMQClient("./rmq/profile.ini", "testServer");
$firstname = "";
$lastname = "";
$username = "";
$password = "";
$email= "";
    $request = array(
        'firstname'=>$firstname, 
        'lastname'=>$lastname,
        'username'=>$username,
        'password'=>$password,
        'email'=>$email,
        'type'=>'updateuser');
    $response = $client->send_request($request);
    switch ($response)
	{
		case 'updated':
			echo 'Successfully Updated';
            header("Location: ./profile.php");
    
}
}

?>
