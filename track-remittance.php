<?php
	
	include('header.php');
	include('navbar.php');

?>

<br /><br /><br /><br /><br />

<center>

<i class="fa fa-search fa-5x" aria-hidden="true"></i>

	<h1> Tracking Number Lookup </h1>
	<br />

	<div class="container">

	<div class="col-lg-6 col-lg-offset-3">	
	<input type="text" id="tnumber" name="number" class="form-control input-lg " placeholder="Search Details via Tracking Number">
	<br />
	<button class="btn btn-lg btn-primary" onclick="searchTnumberHome()">Search Remittance</button>
	</div>

	<div class="row">
	<div class="col-md-8 col-md-offset-2">
	<br/>
	<div id="displayDetails" class="formDesign" style="display: none"></div>
	</div></div>

	</div>

</center>


<?php



	include_once('connection.php');

	if(isset($_POST['number'])) {

		$number = $_POST['number'];
		$sql = "SELECT * FROM remittance WHERE TNUMBER = '$number'"; 
		$result = mysqli_query($conn,$sql);
		$temp = mysqli_fetch_array($result);

		$tn = $temp['TNUMBER']; 
		$s = $temp['SNAME']; 
		$sno = $temp['SNUM']; 
		$sadd = $temp['SEM']; 
		$sem = $temp['SADD']; 
		$r = $temp['RNAME']; 
		$rno = $temp['RNUM']; 
		$rem = $temp['REM']; 
		$radd = $temp['RADD']; 
		$moneyprice = $temp['MAMOUNT']; 
		$packageprice = $temp['PAMOUNT']; 
		$branch = $temp['PBR']; 
		$dispatchdate = $temp['CHARDDIS']; 
		$deliveryddate = $temp['CHARDDEL']; 
		$entrydate = $temp['CHARRDATE']; 
		$status = $temp['STATUS']; 
		$archive = $temp['ARCHIVE'];

		$ok = mysqli_affected_rows($conn);

		/*echo $ok;*/

		if($moneyprice > 0 && $archive == 0) {


echo '
<div data-aos="fade-zoom-in"
     data-aos-easing="ease-in-back"
     data-aos-offset="0">

<div class="container">

<br />
<div class="rows">
<div class="col-lg-9 col-lg-offset-3 col-md-9 col-md-offset-3 col-sm-9 col-sm-offset-3">
<strong> Tracking Number: </strong>  '."$tn".' <br />
<strong> MODE: </strong> Money remittance <br />
<strong> STATUS: </strong>  '."$status".'
</div>
</div>

<div class="rows">
<div class="col-lg-9 col-lg-offset-3 col-md-9 col-md-offset-3 col-sm-9 col-sm-offset-3">

<h3> Other Info: </h3>
<strong> Preferred Pickup Branch: </strong> '."$branch".' <br />


</div>
</div>
</div>

</div>

<br /> <br /> <br /> <br />
	
';

		}

		if($packageprice > 0 && $archive == 0){



echo '

<div data-aos="fade-zoom-in"
     data-aos-easing="ease-in-back"
     data-aos-offset="0">
<div class="container">

<br />
<div class="rows">
<div class="col-lg-9 col-lg-offset-3 col-md-9 col-md-offset-3 col-sm-9 col-sm-offset-3">
<strong> Tracking Number: </strong>  '."$tn".' <br />
<strong> STATUS: </strong>  '."$status".'
</div>
</div>

<div class="rows">
<div class="col-lg-9 col-lg-offset-3 col-md-9 col-md-offset-3 col-sm-9 col-sm-offset-3">

<h3> Other Info: </h3>
<strong>Dispatch Date:</strong>  '."$dispatchdate".' <br />	
<strong>Expected Delivery Date:</strong> '."$deliveryddate".'

<br /> <br /> <br /> <br />

</div>
</div>
</div>

</div>
	
';


		}

		if ($ok == 0) {
			echo '
			<div data-aos="fade-zoom-in"
     		data-aos-easing="ease-in-back"
     		data-aos-offset="0">
			<center>
			<br /> <br />
			<h2> No result found.<h2>  <h5>Please double check your tracking number.</h5>
			</center>
			</div>

			';
		}



}
	

	include('footer.php');

?>