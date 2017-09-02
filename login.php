
<?php
	include_once('header.php');
	include_once('navbar.php');
?>

<br/><br/><br/><br/><br/>

	<div class="container">

	<div data-aos="fade-right">	

	<div class="rows col-lg-10 col-md-7 col-sm-10">
	<div class="col-lg-5">
	
	<h1> LOG-IN </h1>
	<div class="alert alert-danger" style="display: none;">Invalid Username</div>
	<label> Username: </label>
	<input type="text" id="username" class="form-control"> <br />
	</div>
	</div>

	<div class="rows col-lg-10 col-md-7 col-sm-10">
	<div class="col-lg-5">
	<label> Password: </label>
	<input type="password" id="password" class="form-control"> <br />
	</div>
	</div>


	<div class="rows col-lg-10 col-md-10 col-sm-10">
	<div class="col-lg-10">
	<button class="btn btn-primary" onclick="loginAccount()">LOG-IN</button>

	</div>
	</div>
	</div>


<?php
	
	include('footer.php');
	
?>
	
