<?php

	require('tcpdf/tcpdf.php');
	include('connection.php');

	$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'PDF_FORMAT', true, 'UTF-8',false);

	$pdf->SetAutoPageBreak(true,15);
	$pdf->AddPage();

	$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

	$htmlheader = "BSUexpress ™<br>";
	$pdf->WriteHTML($htmlheader);
	


	$xml = new DOMDocument;
	$xml->formatOutput = true;
	$xml->preserveWhiteSpace = false;
	$xml->Load('data.xml');
	$list = $xml->getElementsByTagName("Remittance");

	$pdf->SetFont('','B',8);
	
	$htmlContent = '<br/>
	<h2>Pending Package Remittance </h2>
	<table border="5" class="designtable" width="100%">
	<tr>
	<th>Sender\'s Name</th>
	<th>Receiver\'s Name</th>
	<th>Declared Value</th>
	<th>Date of Entry</th></tr><br>';

	foreach ($list as $item) {

		$archive = $item->getElementsByTagName("Archive")->item(0)->nodeValue; 
		$i = $item->getElementsByTagName("Type")->item(0)->nodeValue;
		$stat = $item->getElementsByTagName("Status")->item(0)->nodeValue;
		
		if ($i == "PackageRemittance" && $archive == 0 && $stat == "PENDING") {
			$htmlContent .='
			<tr>
			<td>'.$item->getElementsByTagName("Sname")->item(0)->nodeValue.' </td>
			<td>'.$item->getElementsByTagName("Rname")->item(0)->nodeValue.' </td>
			<td>'.$item->getElementsByTagName("Amount")->item(0)->nodeValue.' </td>
			<td>'.$item->getElementsByTagName("Date")->item(0)->nodeValue.' </td></tr>'	;
		}
	}

	$htmlContent1 = '<br/>
	<h2>Delivered Package Remittance </h2>
	<table border="5" class="designtable" width="100%">
	<tr>
	<th>Sender\'s Name</th>
	<th>Receiver\'s Name</th>
	<th>Declared Value</th>
	<th>Date of Entry</th></tr><br>';

	foreach ($list as $item) {

		$archive = $item->getElementsByTagName("Archive")->item(0)->nodeValue; 
		$i = $item->getElementsByTagName("Type")->item(0)->nodeValue;
		$stat = $item->getElementsByTagName("Status")->item(0)->nodeValue;
		
		if ($i == "PackageRemittance" && $archive == 0 && $stat == "DELIVERED") {
			$htmlContent1 .='
			<tr>
			<td>'.$item->getElementsByTagName("Sname")->item(0)->nodeValue.' </td>
			<td>'.$item->getElementsByTagName("Rname")->item(0)->nodeValue.' </td>
			<td>'.$item->getElementsByTagName("Amount")->item(0)->nodeValue.' </td>
			<td>'.$item->getElementsByTagName("Date")->item(0)->nodeValue.' </td></tr>'	;
		}
	}

	$htmlContent2 = '<br/>
	<h2>Pending Money Remittance </h2>
	<table border="5" class="designtable" width="100%">
	<tr>
	<th>Sender\'s Name</th>
	<th>Receiver\'s Name</th>
	<th>Declared Value</th>
	<th>Date of Entry</th></tr><br>';

	foreach ($list as $item) {

		$archive = $item->getElementsByTagName("Archive")->item(0)->nodeValue; 
		$i = $item->getElementsByTagName("Type")->item(0)->nodeValue;
		$stat = $item->getElementsByTagName("Status")->item(0)->nodeValue;
		
		if ($i == "MoneyRemittance" && $archive == 0 && $stat == "PENDING") {
			$htmlContent2 .='
			<tr>
			<td>'.$item->getElementsByTagName("Sname")->item(0)->nodeValue.' </td>
			<td>'.$item->getElementsByTagName("Rname")->item(0)->nodeValue.' </td>
			<td>'.$item->getElementsByTagName("Amount")->item(0)->nodeValue.' </td>
			<td>'.$item->getElementsByTagName("Date")->item(0)->nodeValue.' </td></tr>'	;
		}
	}

	$htmlContent3 = '<br/>
	<h2>Claimed Money Remittance </h2>
	<table border="5" class="designtable" width="100%">
	<tr>
	<th>Sender\'s Name</th>
	<th>Receiver\'s Name</th>
	<th>Declared Value</th>
	<th>Date of Entry</th></tr><br>';

	foreach ($list as $item) {

		$archive = $item->getElementsByTagName("Archive")->item(0)->nodeValue; 
		$i = $item->getElementsByTagName("Type")->item(0)->nodeValue;
		$stat = $item->getElementsByTagName("Status")->item(0)->nodeValue;
		
		if ($i == "MoneyRemittance" && $archive == 0 && $stat == "RECEIVED") {
			$htmlContent3 .='
			<tr>
			<td>'.$item->getElementsByTagName("Sname")->item(0)->nodeValue.' </td>
			<td>'.$item->getElementsByTagName("Rname")->item(0)->nodeValue.' </td>
			<td>'.$item->getElementsByTagName("Amount")->item(0)->nodeValue.' </td>
			<td>'.$item->getElementsByTagName("Date")->item(0)->nodeValue.' </td></tr>'	;
		}
	}






	$pdf->WriteHTML($htmlContent);
	$pdf->WriteHTML($htmlContent1);
	$pdf->WriteHTML($htmlContent2);
	$pdf->WriteHTML($htmlContent3);
	$pdf->Output();





?>