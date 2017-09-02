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
	$xml->Load('data.xml');
	$list = $xml->getElementsByTagName("Remittance");
	$claimedRemittance = 0;
	$PendingRemittance = 0;
	$DeliveredPackage = 0;
	$PendingPackage = 0;
	$time = date('l, F d, Y');
	$i = 0;
	$m = 0;

	foreach ($list as $item) {

		$archive = $item->getElementsByTagName("Archive")->item(0)->nodeValue; 
		$type = $item->getElementsByTagName("Type")->item(0)->nodeValue;
		$stat = $item->getElementsByTagName("Status")->item(0)->nodeValue;
		$charge = $item->getElementsByTagName("Charge")->item(0)->nodeValue;
		$date = $item->getElementsByTagName("Date")->item(0)->nodeValue;

		if ($type == "PackageRemittance"){
			$insurance = $item->getElementsByTagName("Insurance")->item(0)->nodeValue;		
		}
		
		if ($time == $date) {
			if ($type == "MoneyRemittance") {
				$i += $charge;
			}else {
				$i += ($charge + $insurance);
			}
		}else {
			if ($type == "MoneyRemittance") {
				$m += $charge;
			}else {
				$m += ($charge + $insurance);
			}
		}

		if ($type == "MoneyRemittance" && $archive == 0) {
			if ($stat == "PENDING") {
				$PendingRemittance++;
			}else {
				$claimedRemittance++;
			}
		}else if ($type == "PackageRemittance" && $archive == 0) {
			if ($stat == "PENDING") {
				$PendingPackage++;
			}else {
				$DeliveredPackage++;
			}
		}

	}
?>



<div data-aos="fade-down"  style="padding-left: 50px;">
<br/><br/>
<div align="right"><h2><span class="formDesign"><?php echo $time; ?></span></h2></div>
<h1><i class="fa fa-laptop"></i> REPORTS PAGE</h1>

<br />

<div class="col-md-4">
<h4>Money Remittance Details</h4>
Claimed remittances: <?php echo $claimedRemittance; ?> <br />
Pending remittances: <?php echo $PendingRemittance; ?> <br />
Total money remittances:  <?php echo ($claimedRemittance + $PendingRemittance); ?>

<br /><br />
<h4>Package Remittance Details</h4>
Delivered packages:  <?php echo $DeliveredPackage; ?><br />
Pending packages: <?php echo $PendingPackage; ?><br />
Total package remittances: <?php echo ($PendingPackage + $DeliveredPackage); ?> <br /><br />
</div>

<div class="col-md-5">
<h4>INCOME</h4>
This Day: P <?php echo $i; ?><br />
This Month: P <?php echo $m; ?><br />
This Year: P <?php echo ($i+$m); ?><br />

<br /><br />
<a href="pdf.php"><input type="button" class="btn btn-primary" value="View Detailed Reports"></a> 

</div>
</div>




<?php
	include_once('footer.php');
?>