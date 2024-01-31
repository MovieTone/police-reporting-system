<?php
	include_once('header.php');
?>

<section class="main-content">
		<h2>Retrieve Incidents</h2>
	</section>
	
	<br>
	
<?php
	if (empty($_SESSION['officer'])) {
		header('Location: loginOfficer.php');
	}
		
	//Connect to the database
	$db = new PDO('mysql:host=localhost;dbname=officer', "root", "");

	// Query the people table
	$query = "SELECT I.Incident_ID, I.Incident_Date, I.Incident_Report, 
			O.Offence_description, O.Offence_maxFine, O.Offence_maxPoints,
			P.People_name, P.People_address, P.People_licence,
			V.Vehicle_type, V.Vehicle_colour, V.Vehicle_licence
			FROM Incident I JOIN People P
			ON I.People_ID = P.People_ID
			JOIN Vehicle V
			ON I.Vehicle_ID = V.Vehicle_ID
			JOIN Offence O
			ON I.Offence_ID = O.Offence_ID";
	
	$stmt = $db->query($query);
	if (empty($stmt) || $stmt->rowCount() == 0) {
		echo("No incident is found in the system.");
	} else {
?>

	<table border="1">
		<tr>
			<th>Incident ID</th>
			<th>Date</th>
			<th>Report</th>
			<th>Offence</th>
			<th>Max Fine</th>
			<th>Max Points</th>
			<th>Person Name</th>
			<th>Person address</th>
			<th>Person license</th>
			<th>Vehicle type</th>
			<th>Vehicle colour</th>
			<th>Vehicle license</th>
			<th>Edit</th>
		</tr>
<?php	
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
?>
		<tr>
			<td><?=$row['Incident_ID']?></td>
			<td><?=$row['Incident_Date']?></td>
			<td><?=$row['Incident_Report']?></td>
			<td><?=$row['Offence_description']?></td>
			<td><?=$row['Offence_maxFine']?></td>
			<td><?=$row['Offence_maxPoints']?></td>
			<td><?=$row['People_name']?></td>
			<td><?=$row['People_address']?></td>
			<td><?=$row['People_licence']?></td>
			<td><?=$row['Vehicle_type']?></td>
			<td><?=$row['Vehicle_colour']?></td>
			<td><?=$row['Vehicle_licence']?></td>
			<td><a href="editIncident.php?incidentId=<?=$row['Incident_ID']?>">Edit</a></td>
		</tr>
<?php
		}
	}
?>
	</table>
	
<?php
	include_once('footer.php');
?>