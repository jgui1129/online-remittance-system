<?php

	include_once('header.php');
	include_once('adminnavbar.php');
	include_once('sidebar.php');

	$xml = new DOMDocument;
	$xml->formatOutput = true;
	$xml->preserveWhiteSpace = false;
	$xml->Load('users.xml');
	$un = $_SESSION["username"];

	$list = $xml->getElementsByTagName("User");

		foreach ($list as $item){
			$i = $item->getElementsByTagName("Username")->item(0)->nodeValue;

			if ($i == $un){	
				 $fullname = $item->getElementsByTagName('Name')->item(0)->nodeValue;
				 $password = $item->getElementsByTagName('Password')->item(0)->nodeValue;
				 $access = $item->getElementsByTagName('Type')->item(0)->nodeValue;
				 break;
			}
		}


?>


		<div data-aos="fade-right">
		<br />
		<div class="row col-lg-12 col-md-12 col-sm-12">
		<div class="col-lg-5 col-md-4 col-sm-4">	
		<h1><i class="fa fa-user"></i> <b id="origUsername"><?php echo $_SESSION["username"];?></b>'s profile </h1>
		<br />
		<div class="alert alert-info" style="display: none;">Successfully updated...<br>If you change the login details, make sure you use the updated login information.</div>	
		<table class="table" width="50%">
		<tr><td>Name: </td>
		<td><input type="text" id="name" class="form-control" value="<?php echo $fullname; ?>"></td></tr>
		<tr><td>Username: </td>
		<td><input type="text" id="username" class="form-control" value="<?php echo $i; ?>"> </td></tr>
		<tr><td>Password: </td>
		<td><input type="text" id="password" class="form-control" value="<?php echo $password; ?>"></td></tr>
		<tr><td>Level of Access:</td>
		<td><input type="text" class="form-control" value="<?php echo $access; ?>" disabled></td></tr>
		</table><br /></div></div>	

		<div class="row col-lg-12 col-md-12 col-sm-12">
		<div class="col-lg-8 col-md-8 col-sm-12">	
		<button class="btn btn-primary" onclick="updateInformation()">Update Information</button>
		</div></div>

		</div>


<?php
	include_once('footer.php');
?>