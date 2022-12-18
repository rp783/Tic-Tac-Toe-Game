<?php
require_once("./nav2.php");
require('./rmq/path.inc');
require('./rmq/get_host_info.inc');
require('./rmq/rabbitMQLib.php');

?>

<?php
/*
$client = new rabbitMQClient("./rmq/profile.ini", "testServer");
    $request = array(
        'username' => $_SESSION['username'],
        'type'=>'request');
    $response = $client->send_request($request);
    switch ($response)
	{
		case 'request':
			echo 'Successfully Updated';

    
}
*/


?>


<html>
<body>
    <div class="center">
        <h1>Profile</h1>
        <form method="post">
            <div class="textField">
                <input type="text" name="firstname" required value= "<?php getfirstname(); ?>">
                <label for="firstname">First Name</label>
            </div>
            <div class="textField">
                <input type="text" name="lastname" required value= "<?php getlastname(); ?>">
                <label for="lastname">Last Name</label>
            </div>
            
            <div class="textField">
                <input type="text" name="username" required value= "<?php getusername(); ?>">
                <label for="username">Username</label>
            </div>
            <div class="textField">
		        <input type="password" name="password" required value= "<?php getpassword(); ?>">
                <label for="password">Password</label>
            </div>
            <div class="textField">
                <input type="text" name="email" required value= "<?php getemail(); ?>">
                <label for="email">Email</label>
            </div>
            <input type="submit" value="Save">
        </form>
    </div>
</body>
</html>


