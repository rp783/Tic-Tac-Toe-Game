<?php 
require("./nav.php");
?>
<!-- Required JavaScript Link -->
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
		    <div class="center">
        <h1>Register</h1>
        <form method="post">
            <div class="textField">
                <input type="text" name="firstname" required>
								<label for="firstname">First Name</label>
						</div>
            <div class="textField">
                <input type="text" name="lastname" required>
								<label for="lastname">Last Name</label>
						</div>
            <div class="textField">
                <input type="text" name="username" required>
                <label for="username">Username</label>
            </div>
            <div class="textField">
		<input type="password" name="password" required>
                <label for="password">Password</label>
	    </div>

		<div class="textField">
		<input type="email" name="email" required>
                <label for="email">Email</label>
	    </div>

            <input type="submit" value="Register">
        </form>
    </div>


				</body>
<?php
require_once('./rmq/path.inc');
require_once('./rmq/get_host_info.inc');
require_once('./rmq/rabbitMQLib.php');


$client = new rabbitMQClient("./rmq/register.ini", "testServer");
if (isset($_POST['firstname']) 
	and isset($_POST['lastname']) 
	and isset($_POST['username']) 
	and isset($_POST['password'])
	and isset($_POST['email']))
{

		$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
		$request = array(
			'firstname'=>$_POST['firstname'], 
			'lastname'=>$_POST['lastname'],
			'username'=>$_POST['username'],
			'password'=>$password,
			'email'=>$_POST['email'],
			'type'=>'register');
			
		$response = $client->send_request($request);
		
	switch ($response)
	{
		case 'created':
			echo 'Successfully created. Redirecting to login page';
			header("Location: Login.php");
			exit();
		case 'notCreated':
			echo 'Username already taken. Please re-enter different username in 3 seconds';
			header("Location: Registration.php");
			exit();
	}
}
/*else
{
	echo "Please fill in all fields to proceed";
}*/

?>
</html>
<?php
require_once "./footer.php";

?>