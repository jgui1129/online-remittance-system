<?php

	session_start();
		if(!isset($_SESSION['ACCESS'])) {
		header("Location: login.php");
	}

	include_once('header.php');
	include_once('sidebar.php');

	echo "<div class='col-md-12 col-md-offset-1'>";
	echo "<br>/";

	$id =  $_GET['tnumber'];

	$xml = new DOMDocument;
	$xml->formatOutput = true;
	$xml->preserveWhiteSpace = false;
	$xml->Load('data.xml');

	$list = $xml->getElementsByTagName("Remittance");

	foreach ($list as $item){
		$i = $item->getElementsByTagName("TNumber")->item(0)->nodeValue;
		if ($i == $id){
			$tnumber = $item->getElementsByTagName("TNumber")->item(0)->nodeValue;
			$sname = $item->getElementsByTagName("Sname")->item(0)->nodeValue;
			$snum = $item->getElementsByTagName("Snum")->item(0)->nodeValue;
			$rname = $item->getElementsByTagName("Rname")->item(0)->nodeValue;
			$rnum = $item->getElementsByTagName("Rnum")->item(0)->nodeValue;
			$status = $item->getElementsByTagName("Status")->item(0)->nodeValue;
			$type = $item->getElementsByTagName("Type")->item(0)->nodeValue;
			$amount = $item->getElementsByTagName("Amount")->item(0)->nodeValue;
		}
	}


	echo  '
	<div data-aos="fade-in">
	<h1><i class="fa fa-pencil-square-o fa-3x"></i> </h1>
	<h2>Tracking Number: '.$tnumber.'</h2>
	<strong> Sender\'s Information </strong><br>
	Name: '.$sname.'<br />
	Contact No. '.$snum.'<br /><br />

	<strong> Receiver\'s Information </strong><br>
	Name: '.$rname.'<br />
	Contact No. '.$rnum.'<br />

	';

	if($type == "MoneyRemittance") {

		echo "<h2> Amount: P " .$amount. "</h2>";
	}

	echo "<h2> Status: " .$status. "</h2><br>";

	if($type == "MoneyRemittance") {
		echo '
	<div class="row">	
	<div class="col-lg-3 col-lg-offset-0 col-md-3 col-md-offset-0" col-sm-3 col-sm-offset-0>	
	<form method="POST" action="success.php">
	<select name="update" class="form-control"> 
		<option value="PENDING">PENDING</option>
		<option value="RECEIVED">RECEIVED</option>
	</select>
	</div>

	<div class="col-lg-1 offset-lg-2 col-md-1 offset-md-2 col-sm-1 offset-sm-2">	
	<input type="submit" value="UPDATE" class="btn btn-info">
	</form>	
	</div>
	</div>
	';

	} else {
		echo '
	<div class="row">	
	<div class="col-lg-3 col-lg-offset-0 col-md-3 col-md-offset-0" col-sm-3 col-sm-offset-0>	
	<form method="POST" action="success.php">
	<select name="update" class="form-control"> 
		<option value="PENDING">PENDING</option>
		<option value="DELIVERED">DELIVERED</option>
	</select>
	</div>

	<div class="col-lg-1 offset-lg-2 col-md-1 offset-md-2 col-sm-1 offset-sm-2">	
	<input type="submit" value="UPDATE" class="btn btn-info">
	</form>	
	</div>
	</div>
	';
	}




	if($type == "MoneyRemittance") {	

		echo '<br/><a href="view-money-remittance.php" class="btn btn-primary">Go back</a>';
	} else {
		echo '<br/><a href="view-package-remittance.php" class="btn btn-primary">Go back</a>';
	}

	echo '


		</div>
	';

	include('footer.php');

?>



