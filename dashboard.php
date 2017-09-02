<?php

	include_once('header.php');
	include_once('adminnavbar.php');
	include_once('sidebar.php');
	echo "<label>Access Level: ". $_SESSION["access"]."</label>";
	echo '<br/><div align="right" ><h2><span class="titleDesign">'.$time_one = date("l, F d, Y") .'</span></h2></div>';

		$a = '<h2>Success is simple. Do what is right, the right way, at the right time.</h2>';
		$b = '<h2>The best years of your life are the ones in which you decide your problems are your own. You do not blame them on your mother, the ecology, or the president. You realize that you control your own destiny.</h2>';
		$c = '<h2>Success is not measured by what you accomplish, but by the opposition you have encountered, and the courage with which you have maintained the struggle against overwhelming odds.</h2>';
		$d = '<h2>Never limit yourself because of others limited imagination; never limit others because of your own limited imagination.”</h2>';
		$e = '<h2>“In a moment of decision, the best thing you can do is the right thing to do, the next best thing is the wrong thing, and the worst thing you can do is nothing.</h2>';
		$g = '<h2>Aim for success, not perfection. Never give up your right to be wrong, because then you will lose the ability to learn new things and move forward with your life. Remember that fear always lurks behind perfectionism.</h2>';
		$h = '<h2>If you do not value your time, neither will others. Stop giving away your time and talents. Value what you know and start charging for it.</h2>';

		$quotes = array($a,$b,$c,$d,$e,$g,$h);
		echo '
			
			<center>
			<div data-aos="fade-up">
			<h1><i class="fa fa-truck fa-2x"></i></h1>
			<span style="font-size: 3em">BSUexpress </span>
			<p style="font-size: 1.5em">Quotes inspiration of the day</p></div><br>';	
		echo '<div style="width: 50%"><div data-aos="fade-up"
     data-aos-duration="1500">'.$quotes[array_rand($quotes)].'</div></div>';
     	echo '';


?>






<?php
	include_once('footer.php');
?>