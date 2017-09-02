<?php
	include_once('header.php');
	include_once('sidebar.php');


	$id =  $_GET['tnumber'];

	$xml = new DOMDocument;
	$xml->formatOutput = true;
	$xml->preserveWhiteSpace = false;
	$xml->Load('data.xml');

	$list = $xml->getElementsByTagName("Remittance");

	foreach ($list as $item){
		$i = $item->getElementsByTagName("TNumber")->item(0)->nodeValue;

		if ($i == $id){

			if ($type = $item->getElementsByTagName("Type")->item(0)->nodeValue == "MoneyRemittance") {
			
				$tnumber = $item->getElementsByTagName("TNumber")->item(0)->nodeValue;
				$sname = $item->getElementsByTagName("Sname")->item(0)->nodeValue;
				$snum = $item->getElementsByTagName("Snum")->item(0)->nodeValue;
				$rname = $item->getElementsByTagName("Rname")->item(0)->nodeValue;
				$rnum = $item->getElementsByTagName("Rnum")->item(0)->nodeValue;
				$rem = $item->getElementsByTagName("Rem")->item(0)->nodeValue;
				$pickup = $item->getElementsByTagName("Pickup")->item(0)->nodeValue;
				$entry = $item->getElementsByTagName("Date")->item(0)->nodeValue;
				$status = $item->getElementsByTagName("Status")->item(0)->nodeValue;
				$type = $item->getElementsByTagName("Type")->item(0)->nodeValue;
				$amount = $item->getElementsByTagName("Amount")->item(0)->nodeValue;				
			}else {

				$tnumber = $item->getElementsByTagName("TNumber")->item(0)->nodeValue;
				$sname = $item->getElementsByTagName("Sname")->item(0)->nodeValue;
				$snum = $item->getElementsByTagName("Snum")->item(0)->nodeValue;
				$sem = $item->getElementsByTagName("Sem")->item(0)->nodeValue;
				$sadd = $item->getElementsByTagName("Sadd")->item(0)->nodeValue;
				$rname = $item->getElementsByTagName("Rname")->item(0)->nodeValue;
				$rnum = $item->getElementsByTagName("Rnum")->item(0)->nodeValue;
				$rem = $item->getElementsByTagName("Rem")->item(0)->nodeValue;
				$radd = $item->getElementsByTagName("Radd")->item(0)->nodeValue;
				$size = $item->getElementsByTagName("Size")->item(0)->nodeValue;
				$area = $item->getElementsByTagName("Area")->item(0)->nodeValue;
				$insurance = $item->getElementsByTagName("Insurance")->item(0)->nodeValue;
				$entry = $item->getElementsByTagName("Date")->item(0)->nodeValue;
				$dispatch = $item->getElementsByTagName("Dispatch")->item(0)->nodeValue;
				$delivery = $item->getElementsByTagName("Delivery")->item(0)->nodeValue;
				$status = $item->getElementsByTagName("Status")->item(0)->nodeValue;
				$type = $item->getElementsByTagName("Type")->item(0)->nodeValue;
				$amount = $item->getElementsByTagName("Amount")->item(0)->nodeValue;	

			}
		}
	}


if ($type == "MoneyRemittance") {

	echo '
	<h1>Details</h1>
	<div class="container-fluid">
	<div class="col-md-3">
		<b>Tracking Number:</b><br/><br/>
		<b>Sender\' Name:</b><br/>
		<b>Sender\' Number:</b><br/><br/>
		<b>Receiver\' Name:</b><br/>
		<b>Receiver\' Number:</b><br/><br/>
		<b>Amount:</b><br/>
		<b>Pickup:</b><br/>
		<b>Date of Entry:</b><br/>
		<b>Status:</b><br/>
		<b>type:</b><br/>
	</div>	
	<div class="col-md-6">
		<em>'.$tnumber.'</em><br/><br/>
		<em>'.$sname.'</em><br/>
		<em>'.$snum.'</em><br/><br/>
		<em>'.$rname.'</em><br/>
		<em>'.$rnum.'</em><br/><br/>
		<em>'.$amount.'</em><br/>
		<em>'.$pickup.'</em><br/>
		<em>'.$entry.'</em><br/>
		<em>'.$status.'</em><br/>
		<em>'.$type.'</em><br/>
	</div></div>';

	echo "<br/>";
	echo '<a href="view-money-remittance.php" class="btn btn-primary">Go back</a>';

}else {



}


	include_once('footer.php');
?>