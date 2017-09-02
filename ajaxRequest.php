<?php
if (!isset($_SESSION)){
        session_start();
    }


if (isset($_GET["searchTnumberHome"])){

	$id =  $_GET['searchTnumberHome'];

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
					$archive = $item->getElementsByTagName("Archive")->item(0)->nodeValue;
					break;
					

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
					$archive = $item->getElementsByTagName("Archive")->item(0)->nodeValue;
					break;

				}
			}else {
				$type = "notfound";
			}
		}

		if ($type == "MoneyRemittance"){
			echo '
			<h2>'.$tnumber.'</h2>
			<label>Mode: '.$type.'</label><br/>
			<label>Status: '.$status.'</label><br/>
			<label>Preferred Pickup Branch: '.$pickup.'</label>

			';
		}else if ($type == "PackageRemittance") {
			echo '
			<h2>'.$tnumber.'</h2>
			<label>Mode: '.$type.'</label><br/>
			<label>Status: '.$status.'</label><br/>
			<label>Dispatch Date '.$dispatch.'</label><br/>
			<label>Expected Delivery Date '.$delivery.'</label><br/>

			';
		}else {
			echo "<label>Tracking number not found in our system. <br/>Please double check your Tracking Number or ask our personnel for assistance.</label>";
		}
}    

if (isset($_GET["loadArchive"])){

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
	echo '</table>';
}

if (isset($_GET["deleteCompletely"])){

		$id =  $_GET['deleteCompletely'];

		$xml = new DOMDocument;
		$xml->formatOutput = true;
		$xml->preserveWhiteSpace = false;
		$xml->Load('data.xml');

		$list = $xml->getElementsByTagName("Remittance");

		foreach ($list as $item){
			$i = $item->getElementsByTagName("TNumber")->item(0)->nodeValue;

			if ($i == $id) {
				$item->parentNode->removeChild($item);
				break;
			}
		}
		$xml->Save("data.xml");

}

if (isset($_GET["usernameToDelete"])){

	$un = $_GET["usernameToDelete"];
	$xml = new DOMDocument;
	$xml->formatOutput = true;
	$xml->preserveWhiteSpace = false;
	$xml->Load('users.xml');
	$list = $xml->getElementsByTagName("User");


	foreach($list as $item){

		$x = $item->getElementsByTagName('Username')->item(0)->nodeValue;

		if ($x == $un){
			$item->parentNode->removeChild($item);
			break;
		}
	}

	$xml->Save('users.xml');

	echo $un . " was successfully deleted in the list.";

}


if (isset($_GET["loadUsers"])){

	$xml = new DOMDocument;
	$xml->formatOutput = true;
	$xml->preserveWhiteSpace = false;
	$xml->Load('users.xml');
	$list = $xml->getElementsByTagName("User");

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
			<td align="center"><button style="height: 35px;" class="btn btn-danger btn-block" value="'.$item->getElementsByTagName('Username')->item(0)->nodeValue.'" onclick="deleteUser(this.value)"><i class="fa fa-trash" ></i></button></td>
			</tr>';
			}


	echo '</table>';

}

if (isset($_GET["changeLevel"]) && isset($_GET["action"])){

	$username = $_GET["changeLevel"];
	$action = $_GET["action"];

		$xml = new DOMDocument;
		$xml->formatOutput = true;
		$xml->preserveWhiteSpace = false;
		$xml->Load('users.xml');

		$list = $xml->getElementsByTagName("User");

		foreach ($list as $item){
			$i = $item->getElementsByTagName("Username")->item(0)->nodeValue;

			if ($i == $username){	
				 $item->getElementsByTagName('Type')->item(0)->nodeValue = $action;
				 break;
			}
		}

		$xml->Save('users.xml');

		echo $username." level of access was successfully changed to ".$action;


}


if (isset($_GET["changeAccess"]) && isset($_GET["action"])) {

	$username = $_GET["changeAccess"];
	$action = $_GET["action"];

		$xml = new DOMDocument;
		$xml->formatOutput = true;
		$xml->preserveWhiteSpace = false;
		$xml->Load('users.xml');

		$list = $xml->getElementsByTagName("User");

		foreach ($list as $item){
			$i = $item->getElementsByTagName("Username")->item(0)->nodeValue;

			if ($i == $username){	
				 $item->getElementsByTagName('Access')->item(0)->nodeValue = $action;
				 break;
			}
		}

		$xml->Save('users.xml');

		if ($action == "NO"){
			$action = "Blocked";
		}else {
			$action = "Unblocked";
		}

		echo $username." access was successfully changed to ".$action;

}

if (isset($_GET["printReceipt"])){

	$id =  $_GET['printReceipt'];

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
					$charge = $item->getElementsByTagName("Charge")->item(0)->nodeValue;
					$archive = $item->getElementsByTagName("Archive")->item(0)->nodeValue;
					break;
					

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
					$charge = $item->getElementsByTagName("Charge")->item(0)->nodeValue;
					$archive = $item->getElementsByTagName("Archive")->item(0)->nodeValue;
					break;

				}
			}
		}

		if ($type == "MoneyRemittance") {


			echo '<div class="container">

			<h2><i class="fa fa-truck"></i> BSUexpress </h2>

			<h3>Tracking Number: '.$tnumber.' </h3>
			<div class="row col-lg-12 col-md-12 col-sm-12">
			<div class="col-lg-4 col-md-4 col-sm-4">
			<table width="50%" class="table table-striped">
			<tr><th align="left"> <h4>Amount: '.$amount.'</h4></th></tr>
			</table>
			</div></div>

			<div class="rows col-lg-12 col-md-12 col-sm-12">
			<div class="col-lg-6 col-md-6">
			<table width="50%" class="table table-striped">
			<tr><th align="left"> Sender\'s Information</th>
			<th align="left"> Receiver\'s Information </th></tr>

			<tr><td>Name: '.$sname.' </td>
			<td> Name: '.$rname.' </td></tr>

			<tr><td>Contact No: '.$snum.' </td>
			<td> Contact No: '.$rnum.' </td></tr>

			<tr><td></td>
			<td>Email: '.$rem.' </td></tr>

			</table>
			</div></div>


			<div class="rows col-lg-12 col-md-12 col-sm-12">
			<div class="col-lg-3 col-md-3">

			<table width="20%" class="table">
			<tr><th align="left"> <h4>Charge: </h4></th>
			<th align="left"> <h4>P '.$charge.' </h4></th></tr>
			</table>

			</div></div>

			</div>

			';

		}else {


			echo '
			<h2><i class="fa fa-truck"></i> BSUexpress </h2>

			<h3 style="padding-left: 30px;">Tracking Number: '.$tnumber.' </h3>
			<div class="col-lg-12 col-md-12 col-sm-12">
			<div class="col-lg-12 col-md-6 col-sm-6">
			<table width="100%" class="table table-striped">
			<tr><th align="left"> <h4>Package Size: '.$size.' | Destination: '.$area.'</h4></th></tr>
			</table>
			</div></div>

			<div class="col-lg-12 col-md-12 col-sm-12">
			<div class="col-lg-12 col-md-8">
			<table width="100%" class="table table-striped">
			<tr><th align="left"> Sender\'s Information</th>
			<th align="left"> Receiver\'s Information </th></tr>

			<tr><td>Name: '.$sname.' </td>
			<td> Name: '.$rname.' </td></tr>

			<tr><td>Address: '.$sadd.' </td>
			<td>Address: '.$radd.' </td></tr>

			<tr><td>Email: '.$sem.'</td>
			<td> Email: '.$rem.'</td></tr>

			<tr><td>Contact No: '.$snum.' </td>
			<td> Contact No: '.$rnum.' </td></tr>


			</table>
			</div></div>


			<div class="col-lg-12 col-md-12 col-sm-12">
			<div class="col-lg-10 col-md-4">
			<br />
			<table width="100%" class="table">
			<tr><td><strong>Charge:</strong> </td>
			<td>P '.$charge.' (Delivery Charge) </td></tr>
			<tr><td align="right"> +</td>
			<td> P '.$insurance.'  (Insurance)</td></tr>
			<tr><th align="left"> Total Charge:</th>
			<th align="left"> P '.($charge+$insurance).'  </th></tr>
			</table>

			</div></div>';


		}

}

if (isset($_GET["setSessionUn"]) && isset($_GET["setSessionAccess"])){
	$_SESSION["username"] = $_GET["setSessionUn"];
	$_SESSION["access"] = $_GET["setSessionAccess"];
}

if (isset($_GET["usernameToBlock"])){

	$id = $_GET["usernameToBlock"];
	$xml = new DOMDocument;
	$xml->formatOutput = true;
	$xml->preserveWhiteSpace = false;
	$xml->Load('users.xml');

	$list = $xml->getElementsByTagName("User");

	foreach ($list as $item){
		$i = $item->getElementsByTagName("Username")->item(0)->nodeValue;

		if ($i == $id){	
			 $item->getElementsByTagName('Access')->item(0)->nodeValue = "NO";
			 break;
		}
	}

	$xml->Save('users.xml');



}

if (isset($_GET["loginAccount"]) && isset($_GET["pw"])){

	//get first the data from get request galing sa js
	$un = $_GET["loginAccount"]; // username
	$pw = $_GET["pw"];


	//initiate dom document
	$xml = new DOMDocument;
	$xml->formatOutput = true;
	$xml->preserveWhiteSpace = false;
	$xml->Load('users.xml');
	$count = 0;
	$list = $xml->getElementsByTagName("User");

	// pang loop lahat ng laman ng users.xml
	foreach ($list as $item){
			$i = $item->getElementsByTagName("Username")->item(0)->nodeValue;
			$p = $item->getElementsByTagName("Password")->item(0)->nodeValue;
			$type = $item->getElementsByTagName("Type")->item(0)->nodeValue;
			$a = $item->getElementsByTagName("Access")->item(0)->nodeValue;

			//kada loop may if statement
			if ($i == $un){ // ung $i ung nag lalaman ng username
				$count = 1; // eto ung magsasabi na existing ung username/ 0 kapag wla, para lang masabi maya na not found ung username kung skali
				if ($p == $pw && $a == "NO"){ // eto kung tama ung pw at ung access ay block
					echo "block"; // eecho lang un block tpos mag aalert sa js base dun sa if xhr.responseText == "block" 
				}
				else if ($p != $pw && $a == "NO") { // eto kapag ung mali ung password at ung access is block
					echo "block";
				}
				else if ($p != $pw && $a == "YES") { // eto kpag mali ung password tpos may access// mag iincrement ung ctr sa js kpag staff/ sa admin hindi

					if ($type != "Admin"){
						echo "staffIncorrectPassword";
					}else {
						echo "adminIncorrectPassword";
					}

				//eto kpag tama ung password 
				}else if ($p == $pw) {
					if ($a == "NO"){
						echo "block";// kapag tama ung password tpos block mag aalert ulit (duplicate XD)
					} else if ($a == "YES" && $type == "Admin"){ // eto kpag tama ung password ng admin 
						echo "admin"; // mag eecho tpos ggawin ung kpag xhr.responseText == "admin"
					}else {
						echo "staff"; // eto naman ung sa staff
					}
				}
					break; // mahalaga to pra d na mag run once na nag true ung isa sa mga if statements
				}
			}

	if ($count == 0) {
		echo "notfound"; // ssbhn lang na not found, ggwin ung if xhr.responseText == "notfound"
	}

}



if (isset($_GET["name"]) && isset($_GET["username"]) && isset($_GET["password"]) && isset($_GET["type"])){

	$n = $_GET["name"];
	$un = $_GET["username"];
	$pw = $_GET["password"];
	$type = $_GET["type"];

	$xml = new DOMDocument;
	$xml->formatOutput = true;
	$xml->preserveWhiteSpace = false;
	$xml->Load('users.xml');
	$exist = False;
	$list = $xml->getElementsByTagName("User");

	foreach ($list as $item){
		$i = $item->getElementsByTagName("Username")->item(0)->nodeValue;
		if ($i== $un){
			$exist = True;
			break;
		}		
	}

	if ($exist) {
		echo "existing";
	}else {

		$item = $xml->createElement('User');
		$item->appendChild($xml->createElement('Name',$n));
		$item->appendChild($xml->createElement('Username',$un));
		$item->appendChild($xml->createElement('Password',$pw));
		$item->appendChild($xml->createElement('Type',$type));
		$item->appendChild($xml->createElement('Access',"YES"));
		$xml->getElementsByTagName('Users')->item(0)->appendChild($item);
		$xml->Save('users.xml');

	}




}


if (isset($_GET['trackingNumber']) && isset($_GET['sender']) && isset($_GET['sno']) && isset($_GET['receiver']) && isset($_GET['rno']) && isset($_GET['remail']) && isset($_GET['amount']) && isset($_GET['charge']) && isset($_GET['bpickup'])) {

	$xml = new DOMDocument;
	$xml->formatOutput = true;
	$xml->preserveWhiteSpace = false;
	$xml->Load('data.xml');

	$trackingNumber = $_GET['trackingNumber'];
	$sender = $_GET['sender'];
	$sno = $_GET['sno'];
	$receiver = $_GET['receiver'];
	$rno = $_GET['rno'];
	$remail = $_GET['remail'];
	$amount = $_GET['amount'];
	$charge = $_GET['charge'];
	$bpickup = $_GET['bpickup'];
	$income = $_GET['amount'] + $_GET['charge'];
	$time = date('l, F d, Y');

	$rem = $xml->createElement('Remittance');
	$item = $xml->createElement('MoneyRemittance');
	$item->appendChild($xml->createElement('TNumber',$trackingNumber));
	$item->appendChild($xml->createElement('Sname',$sender));
	$item->appendChild($xml->createElement('Snum',$sno));
	$item->appendChild($xml->createElement('Rname',$receiver));
	$item->appendChild($xml->createElement('Rnum',$rno));
	$item->appendChild($xml->createElement('Rem',$remail));
	$item->appendChild($xml->createElement('Amount',$amount));
	$item->appendChild($xml->createElement('Charge',$charge));
	$item->appendChild($xml->createElement('Pickup',$bpickup));
	$item->appendChild($xml->createElement('Income',$income));
	$item->appendChild($xml->createElement('Date',$time));
	$item->appendChild($xml->createElement('Status',"PENDING"));
	$item->appendChild($xml->createElement('Archive',0));
	$item->appendChild($xml->createElement('Type',"MoneyRemittance"));
	$rem->appendChild($item);
	$xml->getElementsByTagName('Remittances')->item(0)->appendChild($rem);
	$xml->Save('data.xml');

	$num = $rno;
	$content = 'You have a money remittance ready to be picked up. Check your email for more details about the tracking no. and the pick-up branch. 
Tracking Number = '.$trackingNumber.'.

Do not reply. This is a computer-generated message.';

	
	include_once("smsGateway.php");
	$smsGateway = new SmsGateway('jgui1129.jg@gmail.com', '123456');

	$deviceID = 33360;
	$numbers = $num;
	$message = $content;
	$result = $smsGateway->sendMessageToNumber($numbers, $message, $deviceID);



	$hostname = "smtp.gmail.com";
	$sender = "jgui1129.jg@gmail.com";
	$mail_password = "jeric09192194122";
	$to = $remail;
	$body = '<h1>Good day from BSUexpress!</h1> 
			<h3>Here are the details of the money remittance.</h3> <br> 

		<b>Tracking Number:</b> '.$trackingNumber.' <br>
		<b>Amount:</b> '.$amount.' <br>
		<b>Pick-up Branch: </b> '.$bpickup.' 

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




	}if (isset($_GET['trackingNumber']) && isset($_GET['sender']) && isset($_GET['sno']) && isset($_GET['semail']) && isset($_GET['sadd']) && isset($_GET['receiver']) 
		&& isset($_GET['rno']) && isset($_GET['remail']) && isset($_GET['size']) && isset($_GET['area']) && isset($_GET['amount']) && isset($_GET['charge']) && isset($_GET['insurance'])) {


	$xml = new DOMDocument;
	$xml->formatOutput = true;
	$xml->preserveWhiteSpace = false;
	$xml->Load('data.xml');

	$trackingNumber = $_GET['trackingNumber'];
	$sender = $_GET['sender'];
	$sno = $_GET['sno'];
	$sem = $_GET['semail'];
	$sadd = $_GET['sadd'];
	$receiver = $_GET['receiver'];
	$rno = $_GET['rno'];
	$rmail = $_GET['remail'];
	$radd = $_GET['radd'];
	$size = $_GET['size'];
	$area = $_GET['area'];
	$amount = $_GET['amount'];
	$charge = $_GET['charge'];
	$insurance = $_GET['insurance'];
	$income = $_GET['amount'] + $_GET['charge'];
	$time = date('l, F d, Y');
	$time_one = date('l, F d, Y');
	$time_two = date('l, F d, Y', strtotime('+1 days,'));
	$time_three = date('l, F d, Y', strtotime('+3 days,'));


	$rem = $xml->createElement('Remittance');
	$item = $xml->createElement('PackageRemittance');
	$item->appendChild($xml->createElement('TNumber',$trackingNumber));
	$item->appendChild($xml->createElement('Sname',$sender));
	$item->appendChild($xml->createElement('Snum',$sno));
	$item->appendChild($xml->createElement('Sem',$sem));
	$item->appendChild($xml->createElement('Sadd',$sadd));
	$item->appendChild($xml->createElement('Rname',$receiver));
	$item->appendChild($xml->createElement('Rnum',$rno));
	$item->appendChild($xml->createElement('Rem',$rmail));
	$item->appendChild($xml->createElement('Radd',$radd));
	$item->appendChild($xml->createElement('Size',$size));
	$item->appendChild($xml->createElement('Area',$area));
	$item->appendChild($xml->createElement('Amount',$amount));
	$item->appendChild($xml->createElement('Charge',$charge));
	$item->appendChild($xml->createElement('Insurance',$insurance));
	$item->appendChild($xml->createElement('Income',$income));
	$item->appendChild($xml->createElement('Date',$time));
	if ($area == "NCR"){
		$item->appendChild($xml->createElement('Dispatch',$time_two));
		$item->appendChild($xml->createElement('Delivery',$time_two));
	}else {
		$item->appendChild($xml->createElement('Dispatch',$time_two));
		$item->appendChild($xml->createElement('Delivery',$time_three));
	}
	$item->appendChild($xml->createElement('Status',"PENDING"));
	$item->appendChild($xml->createElement('Archive',0));
	$item->appendChild($xml->createElement('Type',"PackageRemittance"));
	$rem->appendChild($item);
	$xml->getElementsByTagName('Remittances')->item(0)->appendChild($rem);
	$xml->Save('data.xml');


	$num = $rno;
	$content = 'BSUexpress: 

You have a package remittance sent by '.$sender.'	and will be delivered on '.$time_three.'.

Package Tracking Number : '.$trackingNumber.'

Do not reply. This is a computer-generated message.';


	include_once("smsGateway.php");
	$smsGateway = new SmsGateway('jgui1129.jg@gmail.com', '123456');

	$deviceID = 33360;
	$numbers = $num;
	$message = $content;
	$result = $smsGateway->sendMessageToNumber($numbers, $message, $deviceID);


	$hostname = "smtp.gmail.com";
	$sender = "jgui1129.jg@gmail.com";
	$mail_password = "jeric09192194122";
	$to = $rmail;
	$body = '<h1>Good day from BSUexpress!</h1> 
			<h3>Here are the details of the package '.$trackingNumber.'.</h3> <br> 

		<b>Status:  </b> PENDING <br>
		<b>Date of Dispatch: </b> '.$time_two.' <br>
		<b>Expected Delivery:  </b> '.$time_three.'

		<br><br><br>

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
	$mail->Body = $body;

	$mail->send(); 



}if (isset($_GET["viewDetails"])){

		$id =  $_GET['viewDetails'];

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
		<div class="col-md-12">
		<div class="formDesign">
			<b>Tracking Number:</b> <em>'.$tnumber.'</em><br/>
			<b>Type:</b> <em>'.$type.'</em><br/><br/>
			<b>Sender\'s Name:</b> <em>'.$sname.'</em><br/>
			<b>Sender\'s Number:</b> <em>'.$snum.'</em><br/><br/>
			<b>Receiver\'s Name:</b> <em>'.$rname.'</em><br/>
			<b>Receiver\'s Number:</b> <em>'.$rnum.'</em><br/><br/>
			<b>Amount:</b> <em>'.$amount.'</em><br/>
			<b>Pickup:</b> <em>'.$pickup.'</em><br/>
			<b>Date of Entry:</b> <em>'.$entry.'</em><br/>
			<b>Status:</b> <em>'.$status.'</em><br/>
			
		</div>
		</div>';

	}else {

		
		echo '
		<div class="col-md-12">
		<div class="formDesign">
			<b>Tracking Number:</b> <em>'.$tnumber.'</em><br/>
			<b>Type:</b> <em>'.$type.'</em><br/><br/>
			<b>Sender\'s Name:</b> <em>'.$sname.'</em><br/>
			<b>Sender\'s Number:</b> <em>'.$snum.'</em><br/>
			<b>Sender\'s Email:</b> <em>'.$sem.'</em><br/>
			<b>Sender\'s Address:</b> <em>'.$sadd.'</em><br/><br/>
			<b>Receiver\'s Name:</b> <em>'.$rname.'</em><br/>
			<b>Receiver\'s Number:</b> <em>'.$rnum.'</em><br/>
			<b>Receiver\'s Email:</b> <em>'.$rem.'</em><br/>
			<b>Receiver\'s Address:</b> <em>'.$radd.'</em><br/><br/>

			<b>Package Size:</b> <em>'.$size.'</em><br/>
			<b>Delivery Location:</b> <em>'.$area.'</em><br/>
			<b>Declared Value:</b> <em>'.$amount.'</em><br/>
			<b>Insurance:</b> <em>'.$insurance.'</em><br/><br/>

			<b>Date of Entry:</b> <em>'.$entry.'</em><br/>
			<b>Date of Dispatch:</b> <em>'.$dispatch.'</em><br/>
			<b>Date of Delivery:</b> <em>'.$delivery.'</em><br/>
			<b>Status:</b> <em>'.$status.'</em><br/>
			
		</div>
		</div>';

	}
}

if (isset($_GET["editRemittance"])) {

	
	$id =  $_GET['editRemittance'];

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
	<div class="formDesign">
	<h3><i class="fa fa-pencil-square-o fa-3x"></i> Tracking Number: '.$tnumber.'</h3>
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

	echo "<h2> Status: " .$status. "</h2>";

	if($type == "MoneyRemittance") {
		echo '
	<div class="row">	
	<div class="col-md-10">
	<select name="update" class="form-control" id="updateChoice"> 
		<option value="PENDING">PENDING</option>
		<option value="RECEIVED">RECEIVED</option>
	</select>
	</div>

	<div class="col-md-12">	
	<br/>
	<button class="btn btn-primary" value="'.$tnumber.'" onclick="updateStatus(this.value)">Update Money Status</button>
	</div>
	</div>
	';

	} else {
		echo '
	<div class="row">	
	<div class="col-md-10">
	<select name="update" class="form-control" id="updateChoice"> 
		<option value="PENDING">PENDING</option>
		<option value="DELIVERED">DELIVERED</option>
	</select>
	</div>

	<div class="col-md-12">
	<br/>	
	<button class="btn btn-primary" value="'.$tnumber.'"" onclick="updateStatus(this.value)">Update Package Status</button>
	</div>
	</div>
	';
	}


}


if (isset($_GET["edit"]) && isset($_GET["choice"])) {

	$id = $_GET["edit"];
	$choice = $_GET["choice"];
	$xml = new DOMDocument('1.0','utf-8');
	$xml->formatOutput = true;
	$xml->preserveWhiteSpace = true;
	$xml->Load('data.xml');

	$list = $xml->getElementsByTagName("Remittance");

	foreach ($list as $item){
		$i = $item->getElementsByTagName("TNumber")->item(0)->nodeValue;

		if ($i == $id){	
			 $item->getElementsByTagName('Status')->item(0)->nodeValue = $choice;
			 echo $item->getElementsByTagName('Type')->item(0)->nodeValue;
		}
	}

	$xml->Save('data.xml');


}

if (isset($_GET["displayMoneyRemittance"])) {

	$xml = new DOMDocument;
	$xml->formatOutput = true;
	$xml->preserveWhiteSpace = false;
	$xml->Load('data.xml');
	$list = $xml->getElementsByTagName("MoneyRemittance");

	echo '<table border="5" class="table">
	<tr>
	<th>Tracking Number</th>
	<th>Sender\'s Name</th>
	<th>Receiver\'s Name</th>
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
			<td>'.$item->getElementsByTagName('Status')->item(0)->nodeValue.'</td>
			<td><button value="'.$item->getElementsByTagName('TNumber')->item(0)->nodeValue.'" id="details" onclick="viewDetails(this.value)">Details</button></td>';

			if ($_SESSION["access"] == "admin") {
				echo '<td><button value="'.$item->getElementsByTagName('TNumber')->item(0)->nodeValue.'" onclick="editRemittance(this.value)">Edit</button></td>';		
			}
			
			echo '<td><button value="'.$item->getElementsByTagName('TNumber')->item(0)->nodeValue.'" onclick="deleteRemittance(this.value)">Delete</button></td>
			</tr>';
		}
	}
	echo '</table>';

}


if (isset($_GET["displayPackageRemittance"])) {

	$xml = new DOMDocument;
	$xml->formatOutput = true;
	$xml->preserveWhiteSpace = false;
	$xml->Load('data.xml');
	$list = $xml->getElementsByTagName("PackageRemittance");

		echo '<table border="5" class="table">
	<tr>
	<th>Tracking Number</th>
	<th>Sender\'s Name</th>
	<th>Receiver\'s Name</th>
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
			<td>'.$item->getElementsByTagName('Status')->item(0)->nodeValue.'</td>
			<td><button value="'.$item->getElementsByTagName('TNumber')->item(0)->nodeValue.'" id="details" onclick="viewDetails(this.value)">Details</button></td>';

			if ($_SESSION["access"] == "admin") {
				echo '<td><button value="'.$item->getElementsByTagName('TNumber')->item(0)->nodeValue.'" onclick="editRemittance(this.value)">Edit</button></td>';		
			}
			
			echo '<td><button value="'.$item->getElementsByTagName('TNumber')->item(0)->nodeValue.'" onclick="deleteRemittance(this.value)">Delete</button></td>
			</tr>';
		}
	}
	echo '</table>';

}



 if (isset($_GET["moveToArchive"])){


	$id = $_GET["moveToArchive"];
	$xml = new DOMDocument('1.0','utf-8');
	$xml->formatOutput = true;
	$xml->preserveWhiteSpace = true;
	$xml->Load('data.xml');

	$list = $xml->getElementsByTagName("Remittance");

	foreach ($list as $item){
		$i = $item->getElementsByTagName("TNumber")->item(0)->nodeValue;

		if ($i == $id){	
			 $item->getElementsByTagName('Archive')->item(0)->nodeValue = "1";
			 echo $item->getElementsByTagName('Type')->item(0)->nodeValue;
		}
	}

	$xml->Save('data.xml');

 }


 if (isset($_GET["lookupTNumber"])){


	$id =  $_GET['lookupTNumber'];

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
					$archive = $item->getElementsByTagName("Archive")->item(0)->nodeValue;
					break;
					

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
					$archive = $item->getElementsByTagName("Archive")->item(0)->nodeValue;
					break;

				}
			}else {
				$type = "notfound";
			}
		}

		if ($type == "PackageRemittance"){

		
		echo '
			<div class="row">
			<div class="col-md-6">
			<h3 class="border"><b>Tracking Number:</b> <em>'.$tnumber.'</em></h3>
			</div>
			<div class="col-md-6">
			<br/>
			<div style="border-left: 2px black solid; padding-left: 20px;">
			<b>Type:</b> <em>'.$type.'</em><br/>
			<b>Status:</b> <em>'.$status.'</em><br/>
			</div>
			</div></div>
			<hr/>
			<div class="row">
			<div class="col-md-6">
			<h3>Sender\'s Information</h3>
			<b>Name:</b> <em>'.$sname.'</em><br/>
			<b>Number:</b> <em>'.$snum.'</em><br/>
			<b>Email:</b> <em>'.$sem.'</em><br/>
			<b>Address:</b> <em>'.$sadd.'</em>
			<h3>Receiver\' Information</h3>
			<b>Name:</b> <em>'.$rname.'</em><br/>
			<b>Number:</b> <em>'.$rnum.'</em><br/>
			<b>Email:</b> <em>'.$rem.'</em><br/>
			<b>Address:</b> <em>'.$radd.'</em><br/><br/>
			</div>
			<div class="col-md-6">
			<h3>Package\'s Details</h3>
			<b>Package Size:</b> <em>'.$size.'</em><br/>
			<b>Delivery Location:</b> <em>'.$area.'</em><br/>
			<b>Declared Value:</b> <em>'.$amount.'</em><br/>
			<b>Insurance:</b> <em>'.$insurance.'</em><br/><br/>

			<b>Date of Entry:</b> <em>'.$entry.'</em><br/>
			<b>Date of Dispatch:</b> <em>'.$dispatch.'</em><br/>
			<b>Date of Delivery:</b> <em>'.$delivery.'</em><br/><br/>
			</div></div>';
		}else if ($type == "MoneyRemittance"){

			echo '
			<div class="row">
			<div class="col-md-6">
			<h3 class="border"><b>Tracking Number:</b> <em>'.$tnumber.'</em></h3>
			</div>
			<div class="col-md-6">
			<br/>
			<div style="border-left: 2px black solid; padding-left: 20px;">
			<b>Type:</b> <em>'.$type.'</em><br/>
			<b>Status:</b> <em>'.$status.'</em><br/>
			</div>
			</div></div>
			<hr/>
			<div class="row">
			<div class="col-md-6">
			<h3>Sender\'s Information</h3>
			<b>Name:</b> <em>'.$sname.'</em><br/>
			<b>Number:</b> <em>'.$snum.'</em><br/>
			<h3>Receiver\'s Information</h3>
			<b>Name:</b> <em>'.$rname.'</em><br/>
			<b>Number:</b> <em>'.$rnum.'</em><br/>
			<b>Email:</b> <em>'.$rem.'</em><br/>
			</div>
			<div class="col-md-6">
			<h3>Remittance\'s Details</h3>
			<b>Amount:</b> <em>'.$amount.'</em><br/>
			<b>Pickup:</b> <em>'.$pickup.'</em><br/>
			<b>Date of Entry:</b> <em>'.$entry.'</em><br/><br/>
			</div>';

		}else {
			echo "<center><h2>Not found.</h2></center>";
		}


 }

 if (isset($_GET["searchTnumber"])) {

		$id =  $_GET['searchTnumber'];

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
					$archive = $item->getElementsByTagName("Archive")->item(0)->nodeValue;
					break;
					

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
					$archive = $item->getElementsByTagName("Archive")->item(0)->nodeValue;
					break;

				}
			}else {
				$type = "notfound";
			}
		}

			if ($type == "MoneyRemittance" && $archive == "1") {

				echo "<center><h2>Item was already in the archived.</h2></center>";
			}

			else if ($type == "PackageRemittance" && $archive == "1") {

				echo "<center><h2>Item was already in the archived.</h2></center>";
			}


			else if ($type == "MoneyRemittance" && $status == "PENDING") {

		echo '
			<div class="row">
			<div class="col-md-6">
			<h3 class="border"><b>Tracking Number:</b> <em>'.$tnumber.'</em></h3>
			</div>
			<div class="col-md-6">
			<br/>
			<div style="border-left: 2px black solid; padding-left: 20px;">
			<b>Type:</b> <em>'.$type.'</em><br/>
			<b>Status:</b> <em>'.$status.'</em><br/>
			</div>
			</div></div>
			<hr/>
			<div class="row">
			<div class="col-md-6">
			<h3>Sender\'s Information</h3>
			<b>Name:</b> <em>'.$sname.'</em><br/>
			<b>Number:</b> <em>'.$snum.'</em><br/>
			<h3>Receiver\'s Information</h3>
			<b>Name:</b> <em>'.$rname.'</em><br/>
			<b>Number:</b> <em>'.$rnum.'</em><br/>
			<b>Email:</b> <em>'.$rem.'</em><br/>
			</div>
			<div class="col-md-6">
			<h3>Remittance\'s Details</h3>
			<b>Amount:</b> <em>'.$amount.'</em><br/>
			<b>Pickup:</b> <em>'.$pickup.'</em><br/>
			<b>Date of Entry:</b> <em>'.$entry.'</em><br/><br/>
			<button class="btn btn-primary" onclick="claimMoneyRemittance('.$tnumber.')">Claim Remittance</button>
			</div>';

	}else if ($type == "MoneyRemittance" && $status == "RECEIVED") {

			echo "<center><h2>Money Remittance was already claimed.</h2></center>";

	}else if ($type == "PackageRemittance" && $status == "DELIVERED") {

			echo "<center><h2>Package Remittance was already claimed.</h2></center>";

	}else if ($type == "PackageRemittance" && $status == "PENDING"){

		
		echo '
			<div class="row">
			<div class="col-md-6">
			<h3 class="border"><b>Tracking Number:</b> <em>'.$tnumber.'</em></h3>
			</div>
			<div class="col-md-6">
			<br/>
			<div style="border-left: 2px black solid; padding-left: 20px;">
			<b>Type:</b> <em>'.$type.'</em><br/>
			<b>Status:</b> <em>'.$status.'</em><br/>
			</div>
			</div></div>
			<hr/>
			<div class="row">
			<div class="col-md-6">
			<h3>Sender\'s Information</h3>
			<b>Name:</b> <em>'.$sname.'</em><br/>
			<b>Number:</b> <em>'.$snum.'</em><br/>
			<b>Email:</b> <em>'.$sem.'</em><br/>
			<b>Address:</b> <em>'.$sadd.'</em>
			<h3>Receiver\' Information</h3>
			<b>Name:</b> <em>'.$rname.'</em><br/>
			<b>Number:</b> <em>'.$rnum.'</em><br/>
			<b>Email:</b> <em>'.$rem.'</em><br/>
			<b>Address:</b> <em>'.$radd.'</em><br/><br/>
			</div>
			<div class="col-md-6">
			<h3>Package\'s Details</h3>
			<b>Package Size:</b> <em>'.$size.'</em><br/>
			<b>Delivery Location:</b> <em>'.$area.'</em><br/>
			<b>Declared Value:</b> <em>'.$amount.'</em><br/>
			<b>Insurance:</b> <em>'.$insurance.'</em><br/><br/>

			<b>Date of Entry:</b> <em>'.$entry.'</em><br/>
			<b>Date of Dispatch:</b> <em>'.$dispatch.'</em><br/>
			<b>Date of Delivery:</b> <em>'.$delivery.'</em><br/><br/>
			<button class="btn btn-primary" onclick="claimPackageRemittance('.$tnumber.')">Claim Package</button>
			</div></div>';

	}else if ($type == "notfound") {
		
			echo "<center><h2>Not found.</h2></center>";
	}
	
		
}


	if (isset($_GET["claimMoneyRemittance"])) {

		$id = $_GET["claimMoneyRemittance"];
		$xml = new DOMDocument('1.0','utf-8');
		$xml->formatOutput = true;
		$xml->preserveWhiteSpace = true;
		$xml->Load('data.xml');

		$list = $xml->getElementsByTagName("Remittance");

		foreach ($list as $item){
			$i = $item->getElementsByTagName("TNumber")->item(0)->nodeValue;
			$rname = $item->getElementsByTagName("Rname")->item(0)->nodeValue;
			$rnum = $item->getElementsByTagName("Rnum")->item(0)->nodeValue;

			if ($i == $id){	
				 $item->getElementsByTagName('Status')->item(0)->nodeValue = "RECEIVED";
				 break;
			}
		}

		echo "<center><h2>Money Remittance claimed successfully</h2></center>";

		$xml->Save('data.xml');


	$num = $rnum;
	$content = ''.$rname.' has received and picked up your money remittance. Thank you for using BSUexpress.

Do not reply. This is a computer-generated message.';


	include_once("smsGateway.php");
	$smsGateway = new SmsGateway('jgui1129.jg@gmail.com', '123456');

	$deviceID = 33360;
	$numbers = $num;
	$message = $content;
	$result = $smsGateway->sendMessageToNumber($numbers, $message, $deviceID);


	}


		if (isset($_GET["claimPackageRemittance"])) {

		$id = $_GET["claimPackageRemittance"];
		$xml = new DOMDocument('1.0','utf-8');
		$xml->formatOutput = true;
		$xml->preserveWhiteSpace = true;
		$xml->Load('data.xml');

		$list = $xml->getElementsByTagName("Remittance");

		foreach ($list as $item){
			$i = $item->getElementsByTagName("TNumber")->item(0)->nodeValue;
			$rname = $item->getElementsByTagName("Rname")->item(0)->nodeValue;
			$rnum = $item->getElementsByTagName("Rnum")->item(0)->nodeValue;

			if ($i == $id){	
				 $item->getElementsByTagName('Status')->item(0)->nodeValue = "DELIVERED";
				 break;
			}
		}

		echo "<center><h2>Package Remittance claimed successfully</h2></center>";

		$xml->Save('data.xml');



	$num = $rnum;
	$content = 'Your package '.$i.' has been received by '.$rname.'. Thank you for using BSUexpress.

Do not reply. This is a computer-generated message.';


	include_once("smsGateway.php");
	$smsGateway = new SmsGateway('jgui1129.jg@gmail.com', '123456');

	$deviceID = 33360;
	$numbers = $num;
	$message = $content;
	$result = $smsGateway->sendMessageToNumber($numbers, $message, $deviceID);



	}


if (isset($_GET["searchMoneyTNumber"])) {

	$xml = new DOMDocument;
	$xml->formatOutput = true;
	$xml->preserveWhiteSpace = false;
	$xml->Load('data.xml');
	$list = $xml->getElementsByTagName("MoneyRemittance");

	$id = $_GET["searchMoneyTNumber"];

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

	$found = False;

	foreach ($list as $item) {
		
		if ($item->getElementsByTagName('Archive')->item(0)->nodeValue  == 0 && $item->getElementsByTagName('TNumber')->item(0)->nodeValue  == $id) {				
			
			$found = True;
		}

	}


	if ($found && $id != ""){

			foreach ($list as $item) {
				
				if ($item->getElementsByTagName('Archive')->item(0)->nodeValue  == 0 && $item->getElementsByTagName('TNumber')->item(0)->nodeValue  == $id) {				
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
					break;
					}
			}

	}else if ($found == False && $id != "") {

		echo "<center><h1 class='formDesign'>Search item not found</h1></center>";

	}else if ($found == False && $id == ""){

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



	}


	echo "</table></div>";

}




if (isset($_GET["searchPackageTNumber"])) {


	$xml = new DOMDocument;
	$xml->formatOutput = true;
	$xml->preserveWhiteSpace = false;
	$xml->Load('data.xml');
	$list = $xml->getElementsByTagName("PackageRemittance");

	$id = $_GET["searchPackageTNumber"];

	echo '<table border="5" class="table">
	<tr>
	<th>Tracking Number</th>
	<th>Sender\'s Name</th>
	<th>Receiver\'s Name</th>
	<th>Status</th>
	<th>Details</th>';

	if ($_SESSION["access"] == "admin") {
		echo '<th>Edit</th>';	
	}
	
	echo '<th>Delete</th>
	</tr>';

	$found = False;

	foreach ($list as $item) {
		
		if ($item->getElementsByTagName('Archive')->item(0)->nodeValue  == 0 && $item->getElementsByTagName('TNumber')->item(0)->nodeValue  == $id) {				
			
			$found = True;
		}

	}


	if ($found && $id != ""){

			foreach ($list as $item) {
				
				if ($item->getElementsByTagName('Archive')->item(0)->nodeValue  == 0 && $item->getElementsByTagName('TNumber')->item(0)->nodeValue  == $id) {				
					echo '<tr>
					<td>'.$item->getElementsByTagName('TNumber')->item(0)->nodeValue.'</td>
					<td>'.$item->getElementsByTagName('Sname')->item(0)->nodeValue.'</td>
					<td>'.$item->getElementsByTagName('Rname')->item(0)->nodeValue.'</td>
					<td>'.$item->getElementsByTagName('Status')->item(0)->nodeValue.'</td>
					<td><button value="'.$item->getElementsByTagName('TNumber')->item(0)->nodeValue.'" id="details" onclick="viewDetails(this.value)">Details</button></td>';
					if ($_SESSION["access"] == "admin") {
						echo '<td><button value="'.$item->getElementsByTagName('TNumber')->item(0)->nodeValue.'" onclick="editRemittance(this.value)">Edit</button></td>';	
					}
					
					echo '<td><button value="'.$item->getElementsByTagName('TNumber')->item(0)->nodeValue.'" onclick="deleteRemittance(this.value)">Delete</button></td>
					</tr>';
					break;
					}
			}

	}else if ($found == False && $id != "") {

		echo "<center><h1 class='formDesign'>Search item not found</h1></center>";

	}else if ($found == False && $id == ""){

		foreach ($list as $item) {
		
			if ($item->getElementsByTagName('Archive')->item(0)->nodeValue  == 0) {				
				echo '<tr>
				<td>'.$item->getElementsByTagName('TNumber')->item(0)->nodeValue.'</td>
				<td>'.$item->getElementsByTagName('Sname')->item(0)->nodeValue.'</td>
				<td>'.$item->getElementsByTagName('Rname')->item(0)->nodeValue.'</td>
				<td>'.$item->getElementsByTagName('Status')->item(0)->nodeValue.'</td>
				<td><button value="'.$item->getElementsByTagName('TNumber')->item(0)->nodeValue.'" id="details" onclick="viewDetails(this.value)">Details</button></td>';

				if ($_SESSION["access"] == "admin"){
					echo '<td><button value="'.$item->getElementsByTagName('TNumber')->item(0)->nodeValue.'" onclick="editRemittance(this.value)">Edit</button></td>';
				}

				echo '<td><button value="'.$item->getElementsByTagName('TNumber')->item(0)->nodeValue.'" onclick="deleteRemittance(this.value)">Delete</button></td>
				</tr>';
				}

			}



	}


	echo "</table></div>";

}

if (isset($_GET["updateName"]) && isset($_GET["updateUsername"]) && isset($_GET["updatePassword"]) && isset($_GET["orig"])) {


	$id = $_GET["orig"];
	$xml = new DOMDocument;
	$xml->formatOutput = true;
	$xml->preserveWhiteSpace = false;
	$xml->Load('users.xml');

	$list = $xml->getElementsByTagName("User");

	foreach ($list as $item){
		$i = $item->getElementsByTagName("Username")->item(0)->nodeValue;

		if ($i == $id){	
			 $item->getElementsByTagName('Username')->item(0)->nodeValue = $_GET["updateUsername"];
			 $item->getElementsByTagName('Password')->item(0)->nodeValue = $_GET["updatePassword"];
			 $item->getElementsByTagName('Name')->item(0)->nodeValue = $_GET["updateName"];
			 break;
		}
	}

	$xml->Save('users.xml');



}




?>