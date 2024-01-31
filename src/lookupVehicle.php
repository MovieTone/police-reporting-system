<?php
	include_once('header.php');
?>

<section class="main-content">
		<h2>Look Up Vehicles</h2>
	</section>
	
	<form action="lookupVehicle.php" method="get">
		<div class="container-medium">
			<label for="license"><b>License plate</b></label>
			<input type="text" placeholder="Enter License Number" name="license" id="license" required>
			<br><br>
			<button type="submit">Search</button>
		</div>
	</form>
	
	<br>
	
<?php
	if (empty($_SESSION['officer'])) {
		header('Location: loginOfficer.php');
	}
	
	if (isset($_GET['license']) ) {
		$license = htmlspecialchars($_GET['license']);
		
		//Connect to the database
		$db = new PDO('mysql:host=localhost;dbname=officer', "root", "");

		// Query the people table
		$query = "SELECT V.Vehicle_ID, V.Vehicle_type, V.Vehicle_colour, V.Vehicle_licence,
				P.People_name, P.People_licence
				FROM Vehicle V JOIN Ownership 
				ON V.Vehicle_ID = Ownership.Vehicle_ID 
				JOIN People P ON Ownership.People_ID = P.People_ID
				WHERE Vehicle_licence = '$license'";
		
		$stmt = $db->query($query);
		if (empty($stmt) || $stmt->rowCount() == 0) {
			echo("No vehicle is found in the system.");
		} else {
?>
	
		<table border="1">
			<tr>
				<th>ID</th>
				<th>Type</th>
				<th>Colour</th>
				<th>License Plate</th>
				<th>Owner's Name</th>
				<th>Owner's License Number</th>
			</tr>
<?php	
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
?>
			<tr>
				<td><?=$row['Vehicle_ID']?></td>
				<td><?=$row['Vehicle_type']?></td>
				<td><?=$row['Vehicle_colour']?></td>
				<td><?=$row['Vehicle_licence']?></td>
				<td><?=$row['People_name']?></td>
				<td><?=$row['People_licence']?></td>
			</tr>
<?php
			}
		}
	}
?>
	</table>
	
<?php
	include_once('footer.php');
?>