<!DOCTYPE html>
<?php
	//ini_set('display_errors', 1);
	include 'common/connectvars.php';
?>
<html lang="en-GB">
	<!--Name: Corey Hemphill
	Date: 8/7/2016
	Class: CS340 Intro. to Databases
	Filename: project_index.php-->
	<head>
		<meta charset = "UTF-8">
		<title>Star Wars Database</title>
		<link rel = "stylesheet" type = "text/css" href = "css/project_defaultCSS.css"/>
	</head>
	<body>
		<div id = "header">
			<h1>Star Wars Database Search Results:</h1>
		</div>
		<?php
			// Check that the connection exists
			if (!$conn) {die('Could not connect');}
			// List all characters
			if (isset($_POST['list_char'])) {
				$query = "SELECT * FROM characters ORDER by id ASC";
				$result = mysqli_query($conn, $query);
				$num_results = mysqli_num_rows($result);
				// Set up table and headers
				echo "<h3 style='color:#ffcc00;margin-bottom:10px;'>characters</h3>";
				echo "<table class = 'data-table'><tr>";
				echo "<th>ID</th><th>First Name</th><th>Last Name</th><th>Homeworld</th><th>Master ID</th>";
				echo "</tr>";
				for($i = 0; $i < $num_results; $i++) {
					$row = mysqli_fetch_array($result);
					echo "<tr><td class = 'table-data'>".$row['id'];
					echo "</td><td class = 'table-data'>".$row['fname'];
					echo "</td><td class = 'table-data'>".$row['lname'];
					echo "</td><td class = 'table-data'>".$row['homeworld'];
					echo "</td><td class = 'table-data'>".$row['master_id'];
					echo "</td></tr>";
				}
				echo "</table>";
				mysqli_close($conn);
			}
			// List all planets
			elseif (isset($_POST['list_planet'])) {
				$query = "SELECT * FROM planets ORDER by id ASC";
				$result = mysqli_query($conn, $query);
				$num_results = mysqli_num_rows($result);
				// Set up table and headers
				echo "<h3 style='color:#ffcc00;margin-bottom:10px;'>planets</h3>";
				echo "<table class = 'data-table'><tr>";
				echo "<th>ID</th><th>Name</th><th>System</th><th>Population</th>";
				echo "</tr>";
				for($i = 0; $i < $num_results; $i++) {
					$row = mysqli_fetch_array($result);
					echo "<tr><td class = 'table-data'>".$row['id'];
					echo "</td><td class = 'table-data'>".$row['name'];
					echo "</td><td class = 'table-data'>".$row['system'];
					echo "</td><td class = 'table-data'>".$row['population'];
					echo "</td></tr>";
				}
				echo "</table>";
				mysqli_close($conn);
			}
			// List all affiliations
			elseif (isset($_POST['list_affil'])) {
				$query = "SELECT * FROM affiliations ORDER by aid ASC";
				$result = mysqli_query($conn, $query);
				$num_results = mysqli_num_rows($result);
				// Set up table and headers
				echo "<h3 style='color:#ffcc00;margin-bottom:10px;'>affiliations</h3>";
				echo "<table class = 'data-table'><tr>";
				echo "<th>ID</th><th>Name</th>";
				echo "</tr>";
				for($i = 0; $i < $num_results; $i++) {
					$row = mysqli_fetch_array($result);
					echo "<tr><td class = 'table-data'>".$row['aid'];
					echo "</td><td class = 'table-data'>".$row['name'];
					echo "</td></tr>";
				}
				echo "</table>";
				mysqli_close($conn);
			}
			// List all active affiliations
			elseif (isset($_POST['list_affilWith'])) {
				$query = "SELECT * FROM affiliatedWith ORDER by cid ASC";
				$result = mysqli_query($conn, $query);
				$num_results = mysqli_num_rows($result);
				// Set up table and headers
				echo "<h3 style='color:#ffcc00;margin-bottom:10px;'>affiliatedWith</h3>";
				echo "<table class = 'data-table'><tr>";
				echo "<th>AID</th><th>CID</th>";
				echo "</tr>";
				for($i = 0; $i < $num_results; $i++) {
					$row = mysqli_fetch_array($result);
					echo "<tr><td class = 'table-data'>".$row['aid'];
					echo "</td><td class = 'table-data'>".$row['cid'];
					echo "</td></tr>";
				}
				echo "</table>";
				mysqli_close($conn);
			}
			// List all episodes
			elseif (isset($_POST['list_episodes'])) {
				$query = "SELECT * FROM episodes ORDER by eid ASC";
				$result = mysqli_query($conn, $query);
				$num_results = mysqli_num_rows($result);
				// Set up table and headers
				echo "<h3 style='color:#ffcc00;margin-bottom:10px;'>episodes</h3>";
				echo "<table class = 'data-table'><tr>";
				echo "<th>ID</th><th>Title</th>";
				echo "</tr>";
				for($i = 0; $i < $num_results; $i++) {
					$row = mysqli_fetch_array($result);
					echo "<tr><td class = 'table-data'>".$row['eid'];
					echo "</td><td class = 'table-data'>".$row['title'];
					echo "</td></tr>";
				}
				echo "</table>";
				mysqli_close($conn);
			}
			// List all appearances
			elseif (isset($_POST['list_appears'])) {
				$query = "SELECT * FROM appearsIn ORDER by eid ASC";
				$result = mysqli_query($conn, $query);
				$num_results = mysqli_num_rows($result);
				// Set up table and headers
				echo "<h3 style='color:#ffcc00;margin-bottom:10px;'>appearsIn</h3>";
				echo "<table class = 'data-table'><tr>";
				echo "<th>EID</th><th>CID</th>";
				echo "</tr>";
				for($i = 0; $i < $num_results; $i++) {
					$row = mysqli_fetch_array($result);
					echo "<tr><td class = 'table-data'>".$row['eid'];
					echo "</td><td class = 'table-data'>".$row['cid'];
					echo "</td></tr>";
				}
				echo "</table>";
				mysqli_close($conn);
			}
			// Character name search
			elseif (isset($_POST['search'])) {
				// Search both first and last name
				if (($_POST['first1'] != NULL) && ($_POST['last1']) != NULL) {
					$firstName = mysqli_real_escape_string($conn, trim($_POST['first1']));
					$lastName = mysqli_real_escape_string($conn, trim($_POST['last1']));;
					$query = "SELECT * FROM characters WHERE fname='$firstName' AND lname='$lastName'";
				}
				// Search last name
				elseif ($_POST['last1'] != NULL) {
					$lastName = mysqli_real_escape_string($conn, trim($_POST['last1']));
					$query = "SELECT * FROM characters WHERE lname='$lastName'";
				}
				// Search first name
				else {
					$firstName = mysqli_real_escape_string($conn, trim($_POST['first1']));
					$query = "SELECT * FROM characters WHERE fname='$firstName'";
				}
				$result = mysqli_query($conn, $query);
				$num_results = mysqli_num_rows($result);
				// Set up table and headers
				echo "<h3 style='color:#ffcc00;margin-bottom:10px;'>Character Search Results</h3>";
				echo "<table class = 'data-table'><tr>";
				echo "<th>ID</th><th>First Name</th><th>Last Name</th><th>Homeworld</th><th>Master ID</th>";
				echo "</tr>";
				for($i = 0; $i < $num_results; $i++) {
					$row = mysqli_fetch_array($result);
					echo "<tr><td class = 'table-data'>".$row['id'];
					echo "</td><td class = 'table-data'>".$row['fname'];
					echo "</td><td class = 'table-data'>".$row['lname'];
					echo "</td><td class = 'table-data'>".$row['homeworld'];
					echo "</td><td class = 'table-data'>".$row['master_id'];
					echo "</td></tr>";
				}
				echo "</table>";
				mysqli_close($conn);
			}
			// Add a planet
			elseif (isset($_POST['add_planet'])) {
				$planetName = mysqli_real_escape_string($conn, trim($_POST['name1']));
				$systemName = mysqli_real_escape_string($conn, trim($_POST['system']));
				$pop = mysqli_real_escape_string($conn, trim($_POST['population']));
				$query = "INSERT INTO planets (name, system, population) VALUES ('$planetName', '$systemName', '$pop')";
				$result = mysqli_query($conn, $query);
				mysqli_close($conn);
			}
			// Add a character
			elseif (isset($_POST['add_char'])) {
				$firstName = mysqli_real_escape_string($conn, trim($_POST['first2']));
				$lastName = mysqli_real_escape_string($conn, trim($_POST['last2']));
				$planet = mysqli_real_escape_string($conn, trim($_POST['homeworld']));
				$mFirst = mysqli_real_escape_string($conn, trim($_POST['mfname1']));
				$mLast = mysqli_real_escape_string($conn, trim($_POST['mlname1']));
				$query = "INSERT INTO characters (fname, lname, homeworld) VALUES ('$firstName', '$lastName', (SELECT id FROM planets WHERE name='$planet'))";
				$result = mysqli_query($conn, $query);
				$query = "UPDATE characters SET master_id=
						(
							SELECT id FROM (SELECT * FROM characters) AS masters
							WHERE fname='$mFirst' AND lname='$mLast'
						)
						WHERE fname='$firstName' AND lname='$lastName'";
				$result = mysqli_query($conn, $query);
				mysqli_close($conn);
			}
			// Add an affiliation
			elseif (isset($_POST['add_affil'])) {
				$affilName = mysqli_real_escape_string($conn, trim($_POST['aname1']));
				$query = "INSERT INTO affiliations (name) VALUES ('$affilName')";
				$result = mysqli_query($conn, $query);
				mysqli_close($conn);
			}
			// Add an episode
			elseif (isset($_POST['add_episode'])) {
				$episodeName = mysqli_real_escape_string($conn, trim($_POST['ename1']));
				$query = "INSERT INTO episodes (title) VALUES ('$episodeName')";
				$result = mysqli_query($conn, $query);
				mysqli_close($conn);
			}
			// Add an affiliatedWith relationship
			elseif (isset($_POST['add_affilWith'])) {
				$affilName = mysqli_real_escape_string($conn, trim($_POST['aname2']));
				$firstName = mysqli_real_escape_string($conn, trim($_POST['cfname1']));
				$lastName = mysqli_real_escape_string($conn, trim($_POST['clname1']));
				$query = "INSERT INTO affiliatedWith (aid, cid) 
						VALUES ((SELECT aid FROM affiliations WHERE name='$affilName'), 
						(SELECT id FROM characters WHERE fname='$firstName' AND lname='$lastName'))";
				$result = mysqli_query($conn, $query);
				mysqli_close($conn);				
			}
			// Add an appearsIn relationship
			elseif (isset($_POST['add_appears'])) {
				$episodeName = mysqli_real_escape_string($conn, trim($_POST['ename2']));
				$firstName = mysqli_real_escape_string($conn, trim($_POST['cfname2']));
				$lastName = mysqli_real_escape_string($conn, trim($_POST['clname2']));
				$query = "INSERT INTO appearsIn (eid, cid) 
						VALUES ((SELECT eid FROM episodes WHERE name='$episodeName'),
						(SELECT id FROM characters WHERE fname='$firstName' AND lname='$lastName'))";
				$result = mysqli_query($conn, $query);
				mysqli_close($conn);				
			}
			// Delete a character
			elseif (isset($_POST['del_char'])) {
				$firstName = mysqli_real_escape_string($conn, trim($_POST['first3']));
				$lastName = mysqli_real_escape_string($conn, trim($_POST['last3']));
				$query = "DELETE FROM characters WHERE fname='$firstName' AND lname='$lastName'";
				$result = mysqli_query($conn, $query);
				mysqli_close($conn);
			}
			// Update a character's master
			elseif (isset($_POST['update_char'])) {
				$firstName = mysqli_real_escape_string($conn, trim($_POST['first4']));
				$lastName = mysqli_real_escape_string($conn, trim($_POST['last4']));
				$mFirstName = mysqli_real_escape_string($conn, trim($_POST['mfirst1']));
				$mLastName = mysqli_real_escape_string($conn, trim($_POST['mlast1']));
				$query = "UPDATE characters SET master_id=
						(
							SELECT id FROM (SELECT * FROM characters) AS masters
							WHERE fname='$mFirstName' AND lname='$mLastName'
						)
						WHERE fname='$firstName' AND lname='$lastName'";
				$result = mysqli_query($conn, $query);
				mysqli_close($conn);
			}
		?>
		<!-- Main Content Container -->
		<div id = "main-content">
			<!-- List all characters from characters table -->
			<div class = "form-container">
				<h3 class = "sub-header">List characters</h3>		
				<hr>
				<form name = "list_characters" action = "project_index.php" method = "post">
					<table class = "char_list">
						<tr>
							<td><input type = "submit" name = "list_char" value = " List characters " style = "margin-top: 10px"></td>
						</tr>
					</table>
				</form>
			</div>
			<!-- List all planets from planets table -->
			<div class = "form-container">
				<h3 class = "sub-header">List planets</h3>		
				<hr>
				<form name = "list_planets" action = "project_index.php" method = "post">
					<table class = "planet_list">
						<tr>
							<td><input type = "submit" name = "list_planet" value = " List planets " style = "margin-top: 10px"></td>
						</tr>
					</table>
				</form>
			</div>
			<!-- List all affiliations from affiliations table -->
			<div class = "form-container">
				<h3 class = "sub-header">List affiliations</h3>
				<hr>
				<form name = "list_affil" action = "project_index.php" method = "post">
					<table class = "affil_list">
						<tr>
							<td><input type = "submit" name = "list_affil" value = " List affiliations " style = "margin-top: 10px"></td>
						</tr>
					</table>
				</form>
			</div>
			<!-- List all active affiliations from affiliatedWith table -->
			<div class = "form-container">
				<h3 class = "sub-header">List affiliatedWith</h3>
				<hr>
				<form name = "list_affilWith" action = "project_index.php" method = "post">
					<table class = "affilWith_list">
						<tr>
							<td><input type = "submit" name = "list_affilWith" value = " List affiliatedWith " style = "margin-top: 10px"></td>
						</tr>
					</table>
				</form>
			</div>
			<!-- List all episodes from episodes table -->
			<div class = "form-container">
				<h3 class = "sub-header">List episodes</h3>
				<hr>
				<form name = "list_episodes" action = "project_index.php" method = "post">
					<table class = "episodes_list">
						<tr>
							<td><input type = "submit" name = "list_episodes" value = " List episodes " style = "margin-top: 10px"></td>
						</tr>
					</table>
				</form>
			</div>
			<!-- List all appearances from appearsIn table -->
			<div class = "form-container">
				<h3 class = "sub-header">List appearsIn</h3>
				<hr>
				<form name = "list_appears" action = "project_index.php" method = "post">
					<table class = "appears_list">
						<tr>
							<td><input type = "submit" name = "list_appears" value = " List appearsIn " style = "margin-top: 10px"></td>
						</tr>
					</table>
				</form>
			</div>
			<!-- Searh for characters by first name, last name, or both -->
			<div class = "form-container">
				<h3 class = "sub-header">Character Search</h3>
				<hr>
				<form name = "search_characters" action = "project_index.php" method = "post">
					<table class = "db-search">
						<tr>
							<th class = "form-head">First Name</th>
						</tr>
						<tr>
							<td class = "form-data">
								<input type = "text" maxlength = "255" name = "first1" id = "first1" placeholder = "First Name" pattern = "([a-zA-Z0-9 ]{2,255})">
							</td>
						</tr>
						<tr>
							<th class = "form-head">Last Name</th>
						</tr>
						<tr>
							<td class = "form-data">
								<input type = "text" maxlength = "255" name = "last1" id = "last1" placeholder = "Last Name" pattern = "([a-zA-Z0-9 ]{2,255})">
							</td>
						</tr>
						<tr>
							<td><input type = "submit" name = "search" value = " Search " style = "margin-top: 10px"></td>
						</tr>
					</table>
				</form>
			</div>
			<!-- Add a planet to planets table -->
			<div class = "form-container">
				<h3 class = "sub-header">Add planet</h3>
				<hr>
				<form name = "add_planet" action = "project_index.php" method = "post">
					<table class = "planet_add">
						<tr>
							<th class = "form-head">Name</th>
						</tr>
						<tr>
							<td class = "form-data">
								<input type = "text" maxlength = "255" name = "name1" id = "name1" placeholder = "Name" pattern = "([a-zA-Z0-9 ]{2,255})">
							</td>
						</tr>
						<tr>
							<th class = "form-head">System</th>
						</tr>
						<tr>
							<td class = "form-data">
								<input type = "text" maxlength = "255" name = "system" id = "system" placeholder = "System" pattern = "([a-zA-Z0-9 ]{2,255})">
							</td>
						</tr>
						<tr>
							<th class = "form-head">Population</th>
						</tr>
						<tr>
							<td class = "form-data">
								<input type = "text" maxlength = "255" name = "population" id = "population" placeholder = "Population" pattern = "([0-9]{1,255})">
							</td>
						</tr>
						<tr>
							<td><input type = "submit" name = "add_planet" value = " Add " style = "margin-top: 10px"></td>
						</tr>
					</table>
				</form>
			</div>
			<!-- Add a character to characters table -->
			<div class = "form-container">
				<h3 class = "sub-header">Add character</h3>
				<hr>
				<form name = "add_char" action = "project_index.php" method = "post">
					<table class = "char_add">
						<tr>
							<th class = "form-head">First Name</th>
						</tr>
						<tr>
							<td class = "form-data">
								<input type = "text" maxlength = "255" name = "first2" id = "first2" placeholder = "First Name" pattern = "([a-zA-Z0-9 ]{2,255})">
							</td>
						</tr>
						<tr>
							<th class = "form-head">Last Name</th>
						</tr>
						<tr>
							<td class = "form-data">
								<input type = "text" maxlength = "255" name = "last2" id = "last2" placeholder = "Last Name" pattern = "([a-zA-Z0-9 ]{0,255})">
							</td>
						</tr>
						<tr>
							<th class = "form-head">Homeworld</th>
						</tr>
						<tr>
							<td class = "form-data">
								<input type = "text" maxlength = "255" name = "homeworld" id = "homeworld" placeholder = "Homeworld Name" pattern = "([a-zA-Z0-9 ]{0,255})">
							</td>
						</tr>						
						<tr>
							<th class = "form-head">Master First Name</th>
						</tr>
						<tr>
							<td class = "form-data">
								<input type = "text" maxlength = "255" name = "mfname1" id = "mfname1" placeholder = "Master First Name" pattern = "([a-zA-Z0-9 ]{0,255})">
							</td>
						</tr>
						<tr>
							<th class = "form-head">Master Last Name</th>
						</tr>
						<tr>
							<td class = "form-data">
								<input type = "text" maxlength = "255" name = "mlname1" id = "mlname1" placeholder = "Master Last Name" pattern = "([a-zA-Z0-9 ]{0,255})">
							</td>
						</tr>
						<tr>
							<td><input type = "submit" name = "add_char" value = " Add " style = "margin-top: 10px"></td>
						</tr>
					</table>
				</form>
			</div>
			<!-- Add an affiliation to affiliations table -->
			<div class = "form-container">
				<h3 class = "sub-header">Add affiliation</h3>
				<hr>
				<form name = "add_affil" action = "project_index.php" method = "post">
					<table class = "affil_add">
						<tr>
							<th class = "form-head">Name</th>
						</tr>
						<tr>
							<td class = "form-data">
								<input type = "text" maxlength = "255" name = "aname1" id = "aname1" placeholder = "Affiliation Name" pattern = "([a-zA-Z0-9 ]{2,255})">
							</td>
						</tr>
						<tr>
							<td><input type = "submit" name = "add_affil" value = " Add " style = "margin-top: 10px"></td>
						</tr>
					</table>
				</form>
			</div>
			<!-- Add an episode to episodes table -->
			<div class = "form-container">
				<h3 class = "sub-header">Add episode</h3>
				<hr>
				<form name = "add_episode" action = "project_index.php" method = "post">
					<table class = "episode_add">
						<tr>
							<th class = "form-head">Name</th>
						</tr>
						<tr>
							<td class = "form-data">
								<input type = "text" maxlength = "255" name = "ename1" id = "ename1" placeholder = "Episode Name" pattern = "([a-zA-Z0-9 ]{2,255})">
							</td>
						</tr>
						<tr>
							<td><input type = "submit" name = "add_episode" value = " Add " style = "margin-top: 10px"></td>
						</tr>
					</table>
				</form>
			</div>
			<!-- Add an active affiliation to affiliatedWith table -->
			<div class = "form-container">
				<h3 class = "sub-header">Add affiliated with</h3>
				<hr>
				<form name = "add_affilWith" action = "project_index.php" method = "post">
					<table class = "affilWith_add">
						<tr>
							<th class = "form-head">Affiliation Name</th>
						</tr>
						<tr>
							<td class = "form-data">
								<input type = "text" maxlength = "255" name = "aname2" id = "aname2" placeholder = "Affiliation Name" pattern = "([a-zA-Z0-9 ]{2,255})">
							</td>
						</tr>
						<tr>
							<th class = "form-head">Character First Name</th>
						</tr>
						<tr>
							<td class = "form-data">
								<input type = "text" maxlength = "255" name = "cfname1" id = "cfname1" placeholder = "First Name" pattern = "([a-zA-Z0-9 ]{2,255})">
							</td>
						</tr>
						<tr>
							<th class = "form-head">Character Last Name</th>
						</tr>
						<tr>
							<td class = "form-data">
								<input type = "text" maxlength = "255" name = "clname1" id = "clname1" placeholder = "Last Name" pattern = "([a-zA-Z0-9 ]{0,255})">
							</td>
						</tr>
						<tr>
							<td><input type = "submit" name = "add_affilWith" value = " Add " style = "margin-top: 10px"></td>
						</tr>
					</table>
				</form>
			</div>
			<!-- Add an appearance to appearsIn table -->
			<div class = "form-container">
				<h3 class = "sub-header">Add appears in</h3>
				<hr>
				<form name = "add_appears" action = "project_index.php" method = "post">
					<table class = "appears_add">
						<tr>
							<th class = "form-head">Episode Name</th>
						</tr>
						<tr>
							<td class = "form-data">
								<input type = "text" maxlength = "255" name = "ename2" id = "ename2" placeholder = "Affiliation Name" pattern = "([a-zA-Z0-9 ]{2,255})">
							</td>
						</tr>
						<tr>
							<th class = "form-head">Character First Name</th>
						</tr>
						<tr>
							<td class = "form-data">
								<input type = "text" maxlength = "255" name = "cfname2" id = "cfname2" placeholder = "First Name" pattern = "([a-zA-Z0-9 ]{2,255})">
							</td>
						</tr>
						<tr>
							<th class = "form-head">Character Last Name</th>
						</tr>
						<tr>
							<td class = "form-data">
								<input type = "text" maxlength = "255" name = "clname2" id = "clname2" placeholder = "Last Name" pattern = "([a-zA-Z0-9 ]{0,255})">
							</td>
						</tr>
						<tr>
							<td><input type = "submit" name = "add_appears" value = " Add " style = "margin-top: 10px"></td>
						</tr>
					</table>
				</form>
			</div>
			<!-- Deleta a character from characters table -->
			<div class = "form-container">
				<h3 class = "sub-header">Delete character</h3>
				<hr>
				<form name = "del_char" action = "project_index.php" method = "post">
					<table class = "char_del">
						<tr>
							<th class = "form-head">First Name</th>
						</tr>
						<tr>
							<td class = "form-data">
								<input type = "text" maxlength = "255" name = "first3" id = "first3" placeholder = "First Name" pattern = "([a-zA-Z0-9 ]{2,255})">
							</td>
						</tr>
						<tr>
							<th class = "form-head">Last Name</th>
						</tr>
						<tr>
							<td class = "form-data">
								<input type = "text" maxlength = "255" name = "last3" id = "last3" placeholder = "Last Name" pattern = "([a-zA-Z0-9 ]{0,255})">
							</td>
						</tr>
						<tr>
							<td><input type = "submit" name = "del_char" value = " Delete " style = "margin-top: 10px"></td>
						</tr>
					</table>
				</form>
			</div>
			<!-- Update a character's master_id -->
			<div class = "form-container">
				<h3 class = "sub-header">Update character's master</h3>
				<hr>
				<form name = "update_char" action = "project_index.php" method = "post">
					<table class = "char_update">
						<tr>
							<th class = "form-head">Character First Name</th>
						</tr>
						<tr>
							<td class = "form-data">
								<input type = "text" maxlength = "255" name = "first4" id = "first4" placeholder = "Character First Name" pattern = "([a-zA-Z0-9 ]{2,255})">
							</td>
						</tr>
						<tr>
							<th class = "form-head">Character Last Name</th>
						</tr>
						<tr>
							<td class = "form-data">
								<input type = "text" maxlength = "255" name = "last4" id = "last4" placeholder = "Character Last Name" pattern = "([a-zA-Z0-9 ]{2,255})">
							</td>
						</tr>
						<tr>
							<th class = "form-head">Master First Name</th>
						</tr>
						<tr>
							<td class = "form-data">
								<input type = "text" maxlength = "255" name = "mfirst1" id = "mfirst1" placeholder = "Master First Name" pattern = "([a-zA-Z0-9 ]{2,255})">
							</td>
						</tr>
						<tr>
							<th class = "form-head">Master Last Name</th>
						</tr>
						<tr>
							<td class = "form-data">
								<input type = "text" maxlength = "255" name = "mlast1" id = "mlast1" placeholder = "Master Last Name" pattern = "([a-zA-Z0-9 ]{0,255})">
							</td>
						</tr>
						<tr>
							<td><input type = "submit" name = "update_char" value = " Update " style = "margin-top: 10px"></td>
						</tr>
					</table>
				</form>
			</div>
		</div>
		<!-- Contact/Course Info & Cert Logos -->
		<div id = "footer">
			<p class = "foot">By Corey Hemphill - hemphilc@oregonstate.edu - CS340 - Summer 2016</p>
			<p class = "foot">
				<a href = "http://www.w3.org/html/logo/">
				<img src = "http://www.w3.org/html/logo/badge/html5-badge-h-css3-semantics.png" 
				width = "165" height = "64" alt = "HTML5 Powered with CSS3 / Styling, and Semantics" 
				title = "HTML5 Powered with CSS3 / Styling, and Semantics"></a>
				<a href="http://jigsaw.w3.org/css-validator/check/referer">
				<img style="border:0;width:88px;height:31px"
				src="http://jigsaw.w3.org/css-validator/images/vcss"
				alt="Valid CSS!"/></a>
			</p>
		</div>
	</body>
</html>