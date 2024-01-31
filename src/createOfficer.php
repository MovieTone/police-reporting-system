<?php
	include_once('header.php');
	
	if (empty($_SESSION['admin'])) {
		header('Location: loginAdmin.php');
	}
	
	if (isset($_POST['password'])) {
		$username = htmlspecialchars($_POST['username']);
		$password = htmlspecialchars($_POST['password']);
		
		//Connect to the database
		$db= new PDO('mysql:host=localhost;dbname=officer', "root", "");

		// Query the officer table, check if credentials are valid
		$query = "INSERT Officer (Username, Password) VALUES (?, ?)";
		$stmt = $db->prepare($query);
		$stmt->execute([$username, $password]);
	}
?>
	
	<section class="main-content">
		<h2>Create an Officer Account</h2>
	</section>
	
	<form action="createOfficer.php" method="post" onsubmit="">
		<div class="login-container">
			<label for="username"><b>Username</b></label>
			<input type="text" placeholder="Enter Officer Username" name="username" id="username" required>
			<br><br>
			<label for="password"><b>Password</b></label>
			<input type="password" placeholder="Enter New Officer's Password" name="password" id="password" required>
			<br><br>
				
<?php	
			if (isset($_POST['username'])) {
				if ($stmt->rowCount()) {
					echo('The officer account has been successfully created');
				} else {
					// Error
					echo('Could not create an account. Try again');
				}
			}
?>
			<button type="submit">Save</button>
		</div>
	</form>

<?php
	include_once('footer.php');
?>