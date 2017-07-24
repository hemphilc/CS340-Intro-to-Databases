<!--Name: Corey Hemphill
	Date: 8/7/2016
	Filename: connectvars.php-->
<?php
	$dbhost = 'oniddb.cws.oregonstate.edu';
	$dbname = 'hemphilc-db';
	$dbuser = 'hemphilc-db';
	$dbpass = '4jRiPSR1D229ZQNR';
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)
		or die("Error connecting to database server");
?>