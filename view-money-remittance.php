<?php

	include_once('header.php');
	include_once("adminnavbar.php");
	include_once('sidebar.php');

	$xml = new DOMDocument;
	$xml->formatOutput = true;
	$xml->preserveWhiteSpace = false;
	$xml->Load('data.xml');
	echo '<div data-aos="fade-up">';
	echo '<div class="col-md-7">';
	echo "<h1>Money Remittances</h1>";
	echo "<hr/>";
	echo '<div class="col-md-5"><b><i class="fa fa-search fa-2x"></i> &nbsp; &nbsp; Search Tracking Number</b></div>';
	echo '<div class="col-md-4"> <input type="text" class="form-control" id="searchTNumber"></div>';
	echo '<div class="col-md-3"> <button class="btn btn-primary" onclick="searchMoneyTNumber()">Search</button></div>';
	echo "<br/><br/><br/>";
	$list = $xml->getElementsByTagName("MoneyRemittance");
	echo "<div id='tableContent'>";
	echo '<table border="5" class="table">
	<tr>
	<th>Tracking Number</th>
	<th>Sender\'s Name</th>
	<th>Receiver\'s Name</th>
	<th>Amount</th>
	<th>Status</th>
	<th>Details</th>';
	
	if ($_SESSION["access"] == "admin") {
		echo '<th>Edit</th>';		
	}

	echo '<th>Delete</th>
	</tr>';

	foreach ($list as $item) {
		
		if ($item->getElementsByTagName('Archive')->item(0)->nodeValue  == 0) {				
			echo '<tr>
			<td>'.$item->getElementsByTagName('TNumber')->item(0)->nodeValue.'</td>
			<td>'.$item->getElementsByTagName('Sname')->item(0)->nodeValue.'</td>
			<td>'.$item->getElementsByTagName('Rname')->item(0)->nodeValue.'</td>
			<td>'.$item->getElementsByTagName('Amount')->item(0)->nodeValue.'</td>
			<td>'.$item->getElementsByTagName('Status')->item(0)->nodeValue.'</td>
			<td><button value="'.$item->getElementsByTagName('TNumber')->item(0)->nodeValue.'" id="details" onclick="viewDetails(this.value)">Details</button></td>';

			if ($_SESSION["access"] == "admin") {
					echo '<td><button value="'.$item->getElementsByTagName('TNumber')->item(0)->nodeValue.'" onclick="editRemittance(this.value)">Edit</button></td>';		
			}

			echo '<td><button value="'.$item->getElementsByTagName('TNumber')->item(0)->nodeValue.'" onclick="deleteRemittance(this.value)">Delete</button></td>
			</tr>';
			}

	}
	echo '</table></div></div>';
	echo '<div class="col-md-5">';
	echo "<h1>Details</h1>";
	echo "<hr/>";
	echo "<div class='alert alert-success' style='display: none;'>Successfully Updated.</div>";
	echo "<div id='content'>";
	echo "</div>";
	echo "</div>";
?>


	

<?php
	include_once('footer.php');
?>