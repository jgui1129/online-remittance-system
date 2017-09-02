<?php

	include_once('header.php');
	include_once('adminnavbar.php');
	include_once('sidebar.php');

	
	if ($_SESSION["access"] != "admin"){
		header("location: dashboard.php");
	}
	echo '<div data-aos="fade-right">';
	echo '<h1>View Archive</h1>';

	echo '<div class="alert alert-info" align="center" style="display:none;">Deleted successfully</div>';
	echo "<div id='archiveContent'>";

	$xml = new DOMDocument;
	$xml->formatOutput = true;
	$xml->preserveWhiteSpace = false;
	$xml->Load('data.xml');
	$list = $xml->getElementsByTagName("Remittance");
	
	echo '<table border="5" class="table">
	<tr>
	<th>Type</th>
	<th>Tracking Number</th>
	<th>Sender\'s Name</th>
	<th>Receiver\'s Name</th>
	<th>Amount</th>
	<th>Status</th>
	<th>Delete</th>
	</tr>';

	foreach ($list as $item) {
		
		if ($item->getElementsByTagName('Archive')->item(0)->nodeValue  == 1) {				
			echo '<tr>
			<td>'.$item->getElementsByTagName('Type')->item(0)->nodeValue.'</td>
			<td>'.$item->getElementsByTagName('TNumber')->item(0)->nodeValue.'</td>
			<td>'.$item->getElementsByTagName('Sname')->item(0)->nodeValue.'</td>
			<td>'.$item->getElementsByTagName('Rname')->item(0)->nodeValue.'</td>
			<td>'.$item->getElementsByTagName('Amount')->item(0)->nodeValue.'</td>
			<td>'.$item->getElementsByTagName('Status')->item(0)->nodeValue.'</td>
			<td><button class="btn btn-danger btn-block" value="'.$item->getElementsByTagName('TNumber')->item(0)->nodeValue.'" onclick="deleteCompletely(this.value)"><i class="fa fa-trash"></i> Delete</button></td>
			</tr>';
			}

	}
	echo '</table></div></div>';
?>




<?php
	include_once('footer.php');
?>