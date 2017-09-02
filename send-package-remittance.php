<?php

	include_once('header.php');
	include_once('adminnavbar.php');
	include_once('sidebar.php');

	if (!isset($_SESSION["TrackingNumber"])) {
		$_SESSION['TrackingNumber'] = time();	
	}
	
?>
	<div data-aos="fade-left">
	<div class="col-md-12">
	<br/>	
	<div class="alert alert-success" style="display: none;">
		<h1>Transaction Successful</h1>	
		<b>Tracking Number: <span id="transactionVal"><script type="text/javascript"></script></span></b><br/>
		<b>Charge:  <span id="chargeVal"></span></b><br/><br/>
		<button class="btn btn-primary"  onclick="openModal()">Print receipt</button> <button  class="btn btn-primary" id="newTransaction">New Transaction</button> <button  class="btn btn-primary" id="closeWindow">Close window</button>
	</div>

	<div class="alert alert-danger" style="display: none;">
		<h1>Some contents are missing</h1>		
		<button id="closeWindowAlert"  class="btn btn-primary">Close window</button>
	</div>

	<div class="row">
	<div class="col-md-6">
	<label><i class="fa fa-send"></i> Send Package Remittance</label>
	<h1 class="titleDesign">Tracking Number: <span id="trackingNumber"><script type="text/javascript"></script></span></h1>
	</div>
	<div class="col-md-6">
	</div></div>
	<hr/>

	<div class="col-md-5">
	<h2> <i class="fa fa-user" aria-hidden="true"></i> Sender's Info </h2> 	<hr align="left" width="80%">

	<label> Sender's Name: </label>
	<input type="text" class="form-control" name="sender" id="sender" onblur="validate(this)" required> <br />

	<label> Contact No: </label>
	<input type="number"  class="form-control" name="sno" id="sno" onblur="validate(this)" required> <br />

	<label> Email: </label>
	<input type="text" class="form-control" name="semail" id="semail" onblur="validate(this)" required> <br />

	<label> Address: </label>
	<input type="text" class="form-control" name="sadd" id="sadd" onblur="validate(this)" required><br />

	<h2><i class="fa fa-user" aria-hidden="true"></i>  Receiver's Info </h2> <hr align="left" width="80%">

	<label>Receiver's Name: </label>
	<input type="text" class="form-control" name="receiver" id="receiver" onblur="validate(this)" required> <br />

	<label> Contact No: </label>
	<input type="number" class="form-control" name="rno" id="rno" onblur="validate(this)" required> <br />

	<label> Email Address: </label>
	<input type="email" class="form-control" name="remail" id="remail" onblur="validate(this)" required> <br />

	<label> Address: </label>
	<input type="text"  class="form-control"name="radd" id="radd" onblur="validate(this)" required><br />
	</div>
	<div class="col-md-5">
	<h2><i class="fa fa-rub" aria-hidden="true"></i> Amount </h2>
	<hr align="left" width="80%">

	<label>Size of Box: </label>
	<select name="size" id="size" onchange="validate(this)" required class="form-control">
		<option>Choose Size</option>
		<option value="1">Small</option>
		<option value="2">Medium</option>
		<option value="3">Large</option>
		<option value="4">Extra Large</option>
	</select><br/>

	<label>Destination</label>
	<select name="area" id="area" onchange="validate(this)" required class="form-control">
		<option>Choose Destination</option>
		<option value="1">NCR</option>
		<option value="2">North Luzon</option>
		<option value="3">South Luzon</option>
		<option value="4">Visayas</option>
		<option value="5">Mindanao</option>
	</select><br/>

	<label> Declared Value: </label>
	<input type="text" name="amount" id="amount" onblur="validate(this)" required class="form-control"> <br />

	<input type="button" name="submit" value="SUBMIT" id="btnSendPackage" class="btn btn-primary">
	</div>

<div id="divToPrint" style="display:none;">
  <div style="width:200px;height:300px;background-color:teal;">
           <?php echo 'html'; ?>      
  </div>
</div>

<?php
	include_once('modal.php');
	include_once('footer.php');
?>