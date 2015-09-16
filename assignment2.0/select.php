<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang=en>
<head>
        <meta charset=utf-8>
        <title>CS148 Assignment2.0</title>
        <meta name="description" content="Homework Assignment 2.0 for CS148">
        <meta name="author" content="Samuel William Reinhardt">

        <link rel='stylesheet' type="text/css" href='../../style.css'>
        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<?php require_once('../bin/prettyCode.php'); ?>
</head>
<body>
<?php include('sidebar-left.php'); ?>
<main>
        <h1>Samuel William Reinhardt</h1>
	<h2>CS148 - Assignment2.0</h2>      
        <p> These SQL queries are designed to be used on the UVM_Courses database.
		<ul>
		<?php for($number=1; $number <= 12; $number++):
			$num = $number;
			if ($number<10) $num = '0' . $num; ?>
			<li>q<?php echo $num ?>. <a href='display.php?number=q<?php echo $num; ?>'>SQL query results.</a> <code><?php echo prettify(file_get_contents('q' . $num . '.sql'));?></code></li>			
		<?php endfor; ?>
		</ul>
        </p>
</main>
<?php include('sidebar-right.php'); ?>
</body>
</html>
