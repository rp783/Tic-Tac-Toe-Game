<?php session_start(); 
require 'nav.php';
?>

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
