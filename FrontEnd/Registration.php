<?php
require 'nav.php';
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

            <input type="submit" value="Register">
        </form>
    </div>


				</body>
<?php
