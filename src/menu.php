<!-- Menu -->
<ul class="navbar">
	<li><a href="index.php">Home</a></li>
	
	<!-- Officer -->
<?php
	if (!empty($_SESSION['officer'])) {
?>
		<li><a href="lookupPeople.php">Search People</a></li>
		<li><a href="lookupVehicle.php">Search Vehicles</a></li>
		<li><a href="addVehicle.php">Add a Vehicle</a></li>
		<li><a href="report.php">Report an Incident</a></li>
		<li><a href="retrieveIncidents.php">Display Incidents</a></li>
		<li><a href="changePassword.php">Change Password</a></li>
		<!-- Admin -->
<?php
	}
	else if (!empty($_SESSION['admin'])) {
?>
		<li><a href="createOfficer.php">Create an Officer Account</a></li>
		<li><a href="addFines.php">Add Fines</a></li>
<?php
	}
	else {
?>
		<li><a href="loginOfficer.php">Officer Log In</a></li>
		<li><a href="loginAdmin.php">Adminstrator Log In</a></li>
<?php
	}
?>
	<li><a href="logOut.php">Log Out</a></li>
</ul>