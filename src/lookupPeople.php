<?php
	include_once('header.php');
?>

<section class="main-content">
		<h2>Look Up People</h2>
	</section>
	
	<form action="lookupPeople.php" method="get">
		<div class="container-medium">
			<label for="name"><b>Name</b></label>
			<input type="text" placeholder="Enter Name" name="name" id="name">
			<br><br>
			<label for="license"><b>License number</b></label>
			<input type="text" placeholder="Enter License Number" name="license" id="license">
			<br><br>
			<button type="submit">Search</button>
		</div>
	</form>
	
	<br>
	
<?php
	if (empty($_SESSION['officer'])) {
		header('Location: loginOfficer.php');
	}
	
	if (isset($_GET['name']) || isset($_GET['license']) ) {
		$name = htmlspecialchars($_GET['name']);
		$license = htmlspecialchars($_GET['license']);
		
		//Connect to the database
		$db = new PDO('mysql:host=localhost;dbname=officer', "root", "");

		// Query the people table
		$query = "SELECT * FROM People WHERE ";
		if (!empty($name)) {
			$query .= "People_name LIKE '%$name%' ";
			if (!empty($license)) {
				 $query .= "AND People_licence LIKE '%$license%'";
			}
		} elseif (!empty($license)) {
			$query .= "People_licence LIKE '%$license%'";
		}
		
		$stmt = $db->query($query);
		if (empty($stmt) || $stmt->rowCount() == 0) {
			echo("No person is found in the system.");
		} else {
?>
	
		<table border="1">
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Address</th>
				<th>License Number</th>
			</tr>
<?php	
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
?>
			<tr>
				<td><?=$row['People_ID']?></td>
				<td><?=$row['People_name']?></td>
				<td><?=$row['People_address']?></td>
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