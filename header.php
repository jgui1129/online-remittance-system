<?php

if (!isset($_SESSION)){
        session_start();
    }
    date_default_timezone_set('Asia/Manila');
?>

<!DOCTYPE html>
<html>
<head>
	<title>BSUexpress</title>
	<link rel="stylesheet" type="text/css" href="assets/css/mediaquery.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="assets/css/aos.css">
	<script type="text/javascript" src="assets/js/aos.js"></script>
</head>
<body>

  <script>
    AOS.init({
      duration: 1000,
      once: true
    });
  </script>
