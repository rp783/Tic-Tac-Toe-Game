<?php session_start(); 
require("./nav.php");
?>


</head>
<body>
    <div class="center">
        <h1>Login</h1>
        <form method="post">
            <div class="textField">
                <input type="text" name="username" required>
                <label for="username">Username</label>
            </div>
            <div class="textField">
		<input type="password" name="password" required>
                <label for="password">Password</label>
            </div>
            <input type="submit" value="Login">
        </form>
    </div>
</body>
<?php
require_once('./rmq/path.inc');
require_once('./rmq/get_host_info.inc');
require_once('./rmq/rabbitMQLib.php');

$client = new rabbitMQClient("./rmq/login.ini", "testServer");
if (isset($_SESSION['username']))
{
	echo "<meta http-equiv='refresh' content='2;URL=index.php'>";
}

if (isset($_POST['username']) and isset($_POST['password']))
{
	$request = array('username'=>$_POST['username'], 'password'=>$_POST['password'], 'type'=>'login');
	$response = $client->send_request($request);
	switch ($response['msg'])
	{
		case 'Username or password are invalid. Please retry':
			echo "<meta http-equiv='refresh' content='2;URL=Login.php'>";
			exit();
		case 'Verified credentials':
			$_SESSION['isVerified'] = true;
			$_SESSION['username'] = $_POST['username'];
			unset($_POST);
			echo "<meta http-equiv='refresh' content='2;URL=Index.php'>";
			exit();
	}
}
?>
</html>


