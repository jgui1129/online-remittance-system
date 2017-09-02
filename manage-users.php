<?php

	include_once('header.php');
	include_once('adminnavbar.php');
	include_once('sidebar.php');

	if ($_SESSION["access"] != "admin"){
		header("location: dashboard.php");
	}

	$xml = new DOMDocument;
	$xml->formatOutput = true;
	$xml->preserveWhiteSpace = false;
	$xml->Load('users.xml');

	$list = $xml->getElementsByTagName("User");
	echo '<div data-aos="fade-up">';
	echo '<h1>Manage Users &nbsp;&nbsp;<a href="register.php" class="btn btn-primary">Register an Account</a> </h1>';
	echo '<div class="alert alert-info" align="center" style="display: none;"><label id="notification">Successfully updated</label></div>';
	echo "<div id='usersContent'>";
	echo '<table border="5" class="table">
	<tr>
	<th>Name</th>
	<th>Username</th>
	<th>Password</th>
	<th>Access</th>
	<th>Type</th>
	<th>Edit Access</th>
	<th>Edit Level</th>
	<th>Delete</th>
	</tr>';

	foreach ($list as $item) {
			
			$un = $item->getElementsByTagName('Username')->item(0)->nodeValue;
			echo '<tr>
			<td>'.$item->getElementsByTagName('Name')->item(0)->nodeValue.'</td>
			<td>'.$item->getElementsByTagName('Username')->item(0)->nodeValue.'</td>
			<td>'.$item->getElementsByTagName('Password')->item(0)->nodeValue.'</td>
			<td>'.$item->getElementsByTagName('Access')->item(0)->nodeValue.'</td>
			<td>'.$item->getElementsByTagName('Type')->item(0)->nodeValue.'</td>
			<td>
			<select class="form-control" onchange="changeAccess(this.value)">';
			if ($item->getElementsByTagName('Access')->item(0)->nodeValue == "YES"){
				echo '<option value="NO*'.$un.'" >Block</option>
				<option value="YES*'.$un.'" selected>Unblock</option>'; 
			}else {
				echo '<option value="NO*'.$un.'" selected>Block</option>
				<option value="YES*'.$un.'" >Unblock</option>';
			}
				
			echo '</select>
			</td>
			<td>
			<select class="form-control" onchange="changeLevel(this.value)">';

			if ($item->getElementsByTagName('Type')->item(0)->nodeValue == "Admin"){
				echo '<option value="Staff*'.$un.'" >Staff</option>
				<option value="Admin*'.$un.'" selected>Admin</option>';
			}else {
				echo '<option value="Staff*'.$un.'" selected>Staff</option>
				<option value="Admin*'.$un.'" >Admin</option>';
			}
				
			echo '</select>
			</td>
			<td align="center"><button style="height: 35px;" class="btn btn-danger btn-block" value="'.$item->getElementsByTagName('Username')->item(0)->nodeValue.'" onclick="deleteUser(this.value)"><i class="fa fa-trash"></i> delete</button></td>
			</tr>';
			}


	echo '</table></div></div>';
?>


	



<?php
	include_once('footer.php');
?>