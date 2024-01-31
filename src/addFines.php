<?php
	include_once('header.php');
	
	if (empty($_SESSION['admin'])) {
		header('Location: loginAdmin.php');
	}
	
	//Connect to the database
	$db= new PDO('mysql:host=localhost;dbname=officer', "root", "");
	
	// Query the incident table
	$query = "SELECT * FROM Incident";
	$stmt2 = $db->query($query);
	
	if (isset($_POST['amount'])) {
		$amount = htmlspecialchars($_POST['amount']);
		$points = htmlspecialchars($_POST['points']);
		$incident_id = htmlspecialchars($_POST['incident']);

		// Query the officer table, check if credentials are valid
		$query = "INSERT INTO Fines (Fine_Amount, Fine_Points, Incident_ID) 
				VALUES (?, ?, ?)";
		$stmt = $db->prepare($query);
		$stmt->execute([$amount, $points, $incident_id]);
	}
?>
	
	<section class="main-content">
		<h2>Add a Fine</h2>
	</section>
	
	<form action="addFines.php" method="post" onsubmit="">
		<div class="container">
			<label for="amount"><b>Fine Amount ($)</b></label>
			<input type="number" placeholder="Enter Fine Amount" name="amount" id="amount" required>
			<br><br>
			<label for="points"><b>Fine Points</b></label>
			<input type="number" placeholder="Enter Fine Points" name="points" id="points" required>
			<br><br>
			
			<select name="incident" id="incident" size="10" required>
<?php 
			while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)) {
?>
				<option value="<?=$row['Incident_ID']?>"><?=$row['Incident_ID'] 
					. ': ' . $row['Incident_Date'] . ' (' . $row['Incident_Report'] . ')'?>
				</option>
<?php
			}
?>
			</select><br><br>
				
<?php	
			if (isset($_POST['amount'])) {
				if ($stmt->rowCount()) {
					echo('The fine has been successfully added');
				} else {
					// Error
					echo('Could not add a fine. Try again');
				}
			}
?>

			<button type="submit">Save</button>
		</div>
	</form>


<?php
	include_once('footer.php');
?>