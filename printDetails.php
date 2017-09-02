<?php

	session_start();
		if(!isset($_SESSION['ACCESS'])) {
		header("Location: login.php");
	}
	include('header.php');

	if($_SESSION['LEVEL'] ==  "ADMIN") {
			include('nav.php');
		}else {
			include('navStaff.php');
		}

	include('connection.php');
	$print = $_SESSION['TRACK'];

	$sql = "SELECT * from remittance WHERE TNUMBER = '$print'";
	$result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_array($result);

	$trackid = $row['TNUMBER'];
	$s = $row['SNAME'];
	$sno = $row['SNUM'];
	$sem = $row['SEM'];
	$sadd = $row['SADD'];
	$r = $row['RNAME'];
	$rno = $row['RNUM'];
	$rem = $row['REM'];
	$radd = $row['RADD'];
	$mamount = $row['MAMOUNT'];
	$pamount = $row['PAMOUNT'];
	$del = $row['DELTO'];
	$size = $row['PSIZE'];
	$insur = $row['INSUR'];
	$income = $row['INCOME'];
	$dval = $row['DVAL'];




$message1 = '

<div class="container">

<div id="divToPrint"> 

<h2><i class="fa fa-truck"></i> BSUexpress </h2>

<h3>Tracking Number: '.$trackid.' </h3>
<div class="row col-lg-12 col-md-12 col-sm-12">
<div class="col-lg-6 col-md-6 col-sm-6">
<table width="60%" class="table table-striped">
<tr><th align="left"> <h4>Package Size: '.$size.' | Destination: '.$del.'</h4></th></tr>
</table>
</div></div>

<div class="rows col-lg-12 col-md-12 col-sm-12">
<div class="col-lg-8 col-md-8">
<table width="60%" class="table table-striped">
<tr><th align="left"> Sender\'s Information</th>
<th align="left"> Receiver\'s Information </th></tr>

<tr><td>Name: '.$s.' </td>
<td> Name: '.$r.' </td></tr>

<tr><td>Address: '.$sadd.' </td>
<td>Address: '.$radd.' </td></tr>

<tr><td>Email: '.$sem.'</td>
<td> Email: '.$rem.'</td></tr>

<tr><td>Contact No: '.$sno.' </td>
<td> Contact No: '.$rno.' </td></tr>


</table>
</div></div>


<div class="rows col-lg-12 col-md-12 col-sm-12">
<div class="col-lg-4 col-md-4">
<br />
<table width="70%" class="table">
<tr><td><strong>Charge:</strong> </td>
<td>P '.$pamount.' (Delivery Charge) </td></tr>
<tr><td align="right"> +</td>
<td> P '.$insur.'  (Insurance)</td></tr>
<tr><th align="left"> Total Charge:</th>
<th align="left"> P '.$income.'  </th></tr>
</table>

</div></div>

</div> 

<div class="rows col-lg-12 col-md-12 col-sm-12">
<div class="col-lg-2  col-md-2 col-sm-2">
<br />
<input type="button" class="btn btn-warning btn-block" onclick="PrintDiv()"; value="PRINT">

</div></div>
</div>

';


$message2 = '

<div class="container">

<div id="divToPrint"> 

<h2><i class="fa fa-truck"></i> BSUexpress </h2>

<h3>Tracking Number: '.$trackid.' </h3>
<div class="row col-lg-12 col-md-12 col-sm-12">
<div class="col-lg-4 col-md-4 col-sm-4">
<table width="50%" class="table table-striped">
<tr><th align="left"> <h4>Amount: '.$trackid.'</h4></th></tr>
</table>
</div></div>

<div class="rows col-lg-12 col-md-12 col-sm-12">
<div class="col-lg-6 col-md-6">
<table width="50%" class="table table-striped">
<tr><th align="left"> Sender\'s Information</th>
<th align="left"> Receiver\'s Information </th></tr>

<tr><td>Name: '.$s.' </td>
<td> Name: '.$r.' </td></tr>

<tr><td>Contact No: '.$sno.' </td>
<td> Contact No: '.$rno.' </td></tr>

<tr><td></td>
<td>Email: '.$rem.' </td></tr>

</table>
</div></div>


<div class="rows col-lg-12 col-md-12 col-sm-12">
<div class="col-lg-3 col-md-3">

<table width="20%" class="table">
<tr><th align="left"> <h4>Charge: </h4></th>
<th align="left"> <h4>P '.$income.' </h4></th></tr>
</table>

</div></div>

</div>


<div class="rows col-lg-12 col-md-12 col-sm-12">
<div class="col-lg-2  col-md-2 col-sm-2">
<input type="button" class="btn btn-warning btn-block" onclick="PrintDiv()"; value="PRINT">
</div></div>



</div>

';


	if ($mamount != 0) {
		 echo $message2;
	} else {
		echo $message1;
	}





	include('footer.php');
?>

<div id="divToPrint" style="display:none;">
  <div style="width:200px;height:300px;background-color:teal;">
           <?php echo 'html'; ?>      
  </div>
</div>