<?php
	include_once('header.php');
	
	if (empty($_SESSION['officer'])) {
		header('Location: loginOfficer.php');
	}
	
	//Connect to the database
	$db= new PDO('mysql:host=localhost;dbname=officer', "root", "");
	
	// Query the people table
	$query = "SELECT * FROM People";
	
	$stmt4 = $db->query($query);
	
	if (isset($_POST['make'])) {
		$make = htmlspecialchars($_POST['make']);
		$model = htmlspecialchars($_POST['model']);
		$colour = htmlspecialchars($_POST['colour']);
		$plate = htmlspecialchars($_POST['plate']);
		
		// Insert into Vehicle table
		$query = "INSERT INTO Vehicle (Vehicle_type, Vehicle_colour, Vehicle_licence) 
				VALUES (?, ?, ?)";
		$stmt = $db->prepare($query);
		$stmt->execute([$make . ' ' . $model, $colour, $plate]);
		
		$vehicle_id = $db->lastInsertId();
		
		if (!empty($_POST['owner'])) {
			$people_id = htmlspecialchars($_POST['owner']);
		} else if (!empty($_POST['name']) && !empty($_POST['address']) && !empty($_POST['license'])) {
			$name = htmlspecialchars($_POST['name']);
			$address = htmlspecialchars($_POST['address']);
			$license = htmlspecialchars($_POST['license']);
		
			$query = "INSERT INTO People (People_name, People_address, People_licence) 
					VALUES (?, ?, ?)";
			$stmt2 = $db->prepare($query);
			$stmt2->execute([$name, $address, $license]);
			
			$people_id = $db->lastInsertId();
		}
		
		$query = "INSERT INTO Ownership (People_ID, Vehicle_ID) 
		VALUES (?, ?)";
		$stmt3 = $db->prepare($query);
		$stmt3->execute([$people_id, $vehicle_id]);
	}
?>
	
	<section class="main-content">
		<h2>Add a Vehicle</h2>
	</section>
	
	<form action="addVehicle.php" method="post">
		<div class="container">
			<label for="make"><b>Vehicle Make</b></label>
			<input type="text" placeholder="Enter Vehicle Make" name="make" id="make" required>
			<br><br>
			<label for="model"><b>Vehicle Model</b></label>
			<input type="text" placeholder="Enter Vehicle Model" name="model" id="model" required>
			<br><br>
			<label for="colour"><b>Vehicle Colour</b></label>
			<input type="text" placeholder="Enter Vehicle Colour" name="colour" id="colour" required>
			<br><br>
			<label for="plate"><b>Vehicle License Plate Number</b></label>
			<input type="text" placeholder="Enter License Plate Number" name="plate" id="plate" required>
			<br><br>
			
			<label for="owner"><b>Vehicle Owner</b></label>
			<br><br>
			<select name="owner" id="owner" size="5" required>
<?php 
			while ($row = $stmt4->fetch(PDO::FETCH_ASSOC)) {
?>
				<option value="<?=$row['People_ID']?>"><?=$row['People_name'] . ' (' . $row['People_licence'] . ')'?></option>
<?php
			}
?>
			</select><br><br>
			<p>Can't find the owner? Add a new one below:</p>
			<label for="name"><b>Owner's Name</b></label>
			<input type="text" placeholder="Enter Owner's Name" name="name" id="name">
			<br><br>
			<label for="address"><b>Owner's Address</b></label>
			<input type="text" placeholder="Enter Owner's Address" name="address" id="address">
			<br><br>
			<label for="license"><b>Owner's License Number</b></label>
			<input type="text" placeholder="Enter Driving License Number" name="license" id="license">
			<br><br>
			<button type="submit">Add</button>
		</div>
	</form>
	
<?php	
	if (isset($_POST['make'])) {
		if ($stmt->rowCount()) {
			// The data has been successfuly created
			echo('The data has been successfuly created');
		} else {
			// Error
			echo('Something went wrong. Try again');
		}
	}
?>

<?php
	include_once('footer.php');
?>

<script>
	var inp1 = document.getElementById("name");
	var inp2 = document.getElementById("address");
	var inp3 = document.getElementById("license");
	inp1.oninput = function () {
		var typedIn = this.value != "" || inp2.value != "" || inp3.value != "";
		document.getElementById("owner").disabled = typedIn;
		document.getElementById("name").required = typedIn;
		document.getElementById("address").required = typedIn;
		document.getElementById("license").required = typedIn;
	};
	inp2.oninput = function () {
		var typedIn = this.value != "" || inp2.value != "" || inp3.value != "";
		document.getElementById("owner").disabled = typedIn;
		document.getElementById("name").required = typedIn;
		document.getElementById("address").required = typedIn;
		document.getElementById("license").required = typedIn;
	};
	inp3.oninput = function () {
		var typedIn = this.value != "" || inp1.value != "" || inp2.value != "";
		document.getElementById("owner").disabled = typedIn;
		document.getElementById("name").required = typedIn;
		document.getElementById("address").required = typedIn;
		document.getElementById("license").required = typedIn;
	};
</script>
