<?php
	include_once('header.php');
	
	if (empty($_SESSION['officer'])) {
		header('Location: loginOfficer.php');
	}
	
	if (isset($_POST['new_password'])) {
		$new_password = htmlspecialchars($_POST['new_password']);
		$old_password = htmlspecialchars($_POST['old_password']);
		$officer = $_SESSION['officer'];
		
		//Connect to the database
		$db= new PDO('mysql:host=localhost;dbname=officer', "root", "");

		// Query the officer table, check if credentials are valid
		$query = "UPDATE Officer SET Password = ? WHERE Username = ? AND Password = ?";
		$stmt = $db->prepare($query);
		$stmt->execute([$new_password, $officer, $old_password]);
	}
?>
	
	<section class="main-content">
		<h2>Change Password</h2>
	</section>
	
	<form action="changePassword.php" method="post" onsubmit="return confirm('Confirm changes?');">
		<div class="login-container">
			<label for="password"><b>Current Password</b></label>
			<input type="password" placeholder="Enter Password" name="old_password" id="old_password" required>
			<br><br>
			<label for="password"><b>New Password</b></label>
			<input type="password" placeholder="Enter Password" name="new_password" id="new_password" required>
			<br><br>
			<button type="submit">Save</button>
		</div>
	</form>
	
<?php	
	if (isset($_POST['new_password'])) {
		if ($stmt->rowCount()) {
			// New password has been successfully saved
			echo('New password has been successfully saved');
		} else {
			// New password has not been saved
			echo('Invalid current password. Try again');
		}
	}
?>

<?php
	include_once('footer.php');
?>