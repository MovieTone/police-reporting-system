<?php
	include_once('header.php');
	
	if (isset($_POST['username'])) {
		$admin = htmlspecialchars($_POST['username']);
		$password = htmlspecialchars($_POST['password']);
		
		//Connect to the database
		$db= new PDO('mysql:host=localhost;dbname=officer', "root", "");

		// Query the admin table, check if credentials are valid
		$query = "SELECT COUNT(*) FROM Administrator WHERE Username = '$admin' AND Password = '$password'";
		$login_result = $db->query($query)->fetchColumn();
		
		if ($login_result > 0) {
			// Successfully logged in
			$_SESSION['officer'] = '';
			$_SESSION['admin'] = $admin;
			
			// redirect to home
			header('Location: index.php');
		} 
	}
?>
	
	<section class="main-content">
		<h2>Log In as Administrator</h2>
	</section>
	
	<form action="loginAdmin.php" method="post">
		<div class="login-container">
			<label for="username"><b>Username</b></label>
			<input type="text" placeholder="Enter Username" name="username" id="username" required>
			<br><br>
			<label for="password"><b>Password</b></label>
			<input type="password" placeholder="Enter Password" name="password" id="password" required>
			<br><br>
<?php	
			if (isset($_POST['username'])) {
				echo("<br>Invalid credentials<br>");
			}
?>
			<button type="submit">Login</button>
		</div>
	</form>


<?php
	include_once('footer.php');
?>