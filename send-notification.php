<?php


	include_once('header.php');
	include_once('sidebar.php');

$xml = new DOMDocument;
$xml->formatOutput = true;
$xml->preserveWhiteSpace = false;
$xml->Load('data.xml');

$tn = $_GET['trackingNumber'];
$item = $xml->getElementsByTagName("Remittance");

	$count = 0;
	$match = 0;
	foreach ($item as $list) {
		if ($list->getElementsByTagName("TNumber")->item(0)->nodeValue == 1493057082) {
			 $match = $count;
		}
		$count++;
	}

$item = $xml->getElementsByTagName("Remittance")->item($match);
$TNumber = $item->getElementsByTagName("TNumber")->item(0)->nodeValue;
$amount = $item->getElementsByTagName("Amount")->item(0)->nodeValue;
$num = $item->getElementsByTagName("Rnum")->item(0)->nodeValue;
$rem = $item->getElementsByTagName("Rem")->item(0)->nodeValue;
$pb = $item->getElementsByTagName("Pickup")->item(0)->nodeValue;

$content = 'You have a money remittance ready to be picked up. Check your email for more details about the tracking no. and the pick-up branch.

Do not reply. This is a computer-generated message.';

	
	include "smsGateway.php";
	$smsGateway = new SmsGateway('jgui1129.jg@gmail.com', '123456');

	$deviceID = 33360;
	$numbers = $num;
	$message = $content;
	$result = $smsGateway->sendMessageToNumber($numbers, $message, $deviceID);



$hostname = "smtp.gmail.com";
$sender = "jgui1129.jg@gmail.com";
$mail_password = "";
$to = $rem;
$body = '<h1>Good day from BSUexpress!</h1> 
		<h3>Here are the details of the money remittance.</h3> <br> 

	<b>Tracking Number:</b> '.$TNumber.' <br>
	<b>Amount:</b> '.$amount.' <br>
	<b>Pick-up Branch: </b> '.$pb.' 

	<br><br><br><br>

	Do not reply. This is a computer-generated message.';

require 'PHPMailer-master/PHPMailerAutoload.php';
$mail = new PHPMailer;
/*$mail->SMTPDebug = 1; */
$mail->isSMTP();
$mail->Host = $hostname;
$mail->SMTPAuth = true;
$mail->Username = $sender;                
$mail->Password = $mail_password;
$mail->SMTPSecure = 'tls';
$mail->Port = 587;
$mail->setFrom('noreply@noreply.com', 'BSUexpress');
$mail->addAddress($to);
$mail->isHTML(true);

$mail->Subject = 'BSUexpress Remittance';
$mail->Body    = $body;

$mail->send(); 

echo '
	<br /><br />
	<div class="container">
	<center>
	<div data-aos="fade-down"
     data-aos-anchor-placement="top-bottom">

	<h1><i class="fa fa-thumbs-o-up fa-4x" aria-hidden="true"></i></h1> </div>
	<div data-aos="zoom-out"
     data-aos-anchor-placement="top">	
	<h1>Thank you for trusting us!</h1>
	<h3>Notification was successfully sent. Here is your tracking number </h3>
	<h1><i class="fa  fa-hand-o-right" aria-hidden="true"></i> '.$TNumber.' <i class="fa  fa-hand-o-left" aria-hidden="true"></i></h1></div>
	<br />
<div data-aos="zoom-in"
     data-aos-anchor-placement="top" data-aos-duration="1500">	

	<a href="details.php?trackingNumber='.$TNumber.'"><input type="button" class="btn btn-lg btn-warning" value="REVIEW DETAILS">
	</center>
	</div>
	';


	include_once('footer.php');
?>

