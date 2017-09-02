<?php
		
	include_once('header.php');
	include_once('adminnavbar.php');
	include_once('sidebar.php');
	
?>
<br /><br />
	
	<div data-aos="fade-right" style="padding-left: 50px;">
	<div class="rows col-lg-10 col-md-8 col-sm-10">
	<div class="col-lg-5">

	<h1> Create new account. </h1>
	<div class="alert alert-danger" style="display: none;">Username already exist.</div>
	<label>Name:</label>
	<input type="text" id="fname" class="form-control"> 
	</div></div>

	<div class="rows col-lg-10 col-md-8 col-sm-10">
	<div class="col-lg-5">
	<br />
	<label>Username:</label>
	<input type="text" id="username" class="form-control"> <br />
	</div></div>

	<div class="rows col-lg-10 col-md-8 col-sm-10">
	<div class="col-lg-5">
	<label>Password:</label>
	<input type="password" id="password" class="form-control"> <br />
	</div></div>

	<div class="rows col-lg-6 col-md-6 col-sm-10">
	<div class="col-lg-5">
	<select id="type" class="form-control">
		<option value="Staff">Staff</option>
		<option value="Admin">Admin</option>
	</select> <br />
	</div></div>

	<div class="rows col-lg-10 col-md-10 col-sm-10">
	<div class="col-lg-10">
	<br />
	<button class="btn btn-primary" onclick="registerAccount()">Register </button>


<a href="manage-users.php">  
	<input type="button" value="GO BACK" class="btn btn-danger"> 
</a>

</div></div>

</div>
	
<?php

	include('footer.php');

?>

