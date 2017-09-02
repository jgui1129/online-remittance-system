<?php
	include_once('header.php');
	include_once('adminnavbar.php');
	include_once('sidebar.php');
?>

<br /><br />

<center>

	<div data-aos="zoom-out-down"> 
	<div class="col-md-12">
	<div class="col-md-6 col-md-offset-3">	
	<i class="fa fa-search fa-5x" aria-hidden="true"></i>
	<h1> Claim Remittance</h1>
	<input type="text" id="tnumber" name="number" class="form-control input-lg " placeholder="enter tracking number to claim">
	<br />
	<button class="btn btn-primary" onclick="searchTnumber()">Search Details</button>
	<br/><br/>
	</div></div>
	</center>
	<div class="row">
	<div class="col-md-8 col-md-offset-2">
	<div id="displayDetails" class="formDesign" style="display: none"></div>
	</div></div>



<?php





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
<strong> Amount: </strong> '."$moneyprice".' <br />
<strong> STATUS: </strong>  '."$status".'
</div>
</div>


<div clas="row">
<br />
<div class="col-lg-3 col-lg-offset-3 col-md-3 col-md-offset-3 col-sm-3 col-sm-offset-3">
<h3> Sender\'s Info: </h3>
Name : '."$s".' <br />
Contact No: '."$sno".' 
</div>

<div class="col-lg-3  col-md-3 col-sm-3 ">
<h3> Receiver\'s Info: </h3>
Name : '."$r".' <br />
Contact No: '."$rno".' <br />
Email: '."$rem".'

</div>
</div>


<div class="rows">
<div class="col-lg-9 col-lg-offset-3 col-md-9 col-md-offset-3 col-sm-9 col-sm-offset-3">

<h3> Other Info: </h3>
<strong> Preferred Pickup Branch: </strong> '."$branch".' <br />
<strong>Date of entry:</strong>  '."$entrydate".'


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
<strong> MODE: </strong> Package remittance <br />
<strong> STATUS: </strong>  '."$status".'
</div>
</div>


<div clas="row">
<br />
<div class="col-lg-3 col-lg-offset-3 col-md-3 col-md-offset-3 col-sm-3 col-sm-offset-3">
<h3> Sender\'s Info: </h3>
Name : '."$s".' <br />
Contact No: '."$sno".' <br />
Email: '."$sem".' <br />
Address: '."$sadd".' <br />
</div>

<div class="col-lg-3  col-md-3 col-sm-3 ">
<h3> Receiver\'s Info: </h3>
Name : '."$r".' <br />
Contact No: '."$rno".' <br />
Email: '."$rem".' <br />
Address: '."$radd".' <br />

</div>
</div>


<div class="rows">
<div class="col-lg-9 col-lg-offset-3 col-md-9 col-md-offset-3 col-sm-9 col-sm-offset-3">

<h3> Other Info: </h3>
<strong> Preferred Pickup Branch: </strong>  Tayuman, Manila Branch <br />
<strong>Date of entry:</strong>  '."$entrydate".' <br />
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

			if ($archive == 1) {
			echo '
			<div data-aos="fade-zoom-in"
     		data-aos-easing="ease-in-back"
     		data-aos-offset="0">
			<center>
			<br /> <br />
			<h2> Already in the archive.<h2>  <h5>Please ask assistance to  the admin if you need that information.</h5>
			</center>
			</div>

			';
		}



}
	

	include('footer.php');

?>