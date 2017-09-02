<?php
	include_once('header.php');
	include_once('adminnavbar.php');
	include_once('sidebar.php');

?>

<br />

<center>

<div data-aos="zoom-out-down">
	<div class="col-md-12">
	<div class="col-md-6 col-md-offset-3">	
	<i class="fa fa-search fa-5x" aria-hidden="true"></i>
	<h1> Tracking Number Lookup </h1>
	<input type="text" id="tnumber" name="number" class="form-control input-lg ">
	<br />
	<button class="btn btn-primary" onclick="lookupTNumber()">Search Details</button>
	<br/><br/
	</div></div>
	</center>
	<div class="row">
	<div class="col-md-8 col-md-offset-2">
	<div id="displayDetails" class="formDesign" style="display: none"></div>
	</div></div>



<?php

	include('footer.php');

?>