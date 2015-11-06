<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang=en>
<head>
        <meta charset=utf-8>
        <title>CS148 Assignment3.0</title>
        <meta name="description" content="Homework Assignment 3.0 for CS148">
        <meta name="author" content="Samuel William Reinhardt">

	<?php 	require_once( "../bin/Database.php"); 	
		require_once("../bin/prettyCode.php"); 
		require_once("../bin/countCode.php"); ?>

        <link rel='stylesheet' type="text/css" href='../../style.css'>
        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
</head>
<body>
<?php include('../../sidebar-left.php'); ?>
<main>
<h1>Samuel William Reinhardt</h1>
<h2>CS148 - Advising ?> Form </h2>      
<p> 
	<h2>Start a four year plan.</h2>
	<form>
		<input type='text' name='userid' placeholder='UVM Student Id'>
		<fieldset class='year'>
		<legend>Year #</legend>
		<fieldset class='semester'>
		<legend>Semester</legend>
		<fieldset class='class'>
			<legend>Class</legend>
			<input type='text' placeholder='Department'>
			<input type='text' placeholder='Course NUmber'>
		</fieldset>
		</fieldset>
		</fieldset>
	</form>
</p>
</main>
<?php include('sidebar-right.php'); ?>
</body>
</html>
