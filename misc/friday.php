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
<?php   
	$whitelisted = false;
	$number = 'q01';
	for($num=1;$num<=6;$num++){if(strcmp ('q0'.$num,$number)==0) $whitelisted=true;}
	if($whitelisted):
		$dbUserName = get_current_user() . '_reader';
		$whichPass = "r"; //flag for which one to use.
		$dbName = 'SWREINHA_UVM_Courses_Testing';
		$thisDatabaseReader = new Database($dbUserName, $whichPass, $dbName);
		$query = rtrim(file_get_contents($number . '.sql')); //prepare the query
		$query = rtrim($query,';'); //remove semicolon (alternatively, set allow semi to true in bob's function)
?>
<h1>Samuel William Reinhardt</h1>
<h2>CS148 - Assignment3.0 - <?php echo strtoupper($number); ?> Output </h2>      
<p> 	Using the following query...

	<?php 
		$counts = countify($query);
		$results = $thisDatabaseReader->select($query, "", $counts['where'], $counts['condition'], $counts['quote'], $counts['symbol'], false, false, true);//running     capitalized code so that table headers aren't chopped oddly if they aren't given aliases
		$prettyCode = prettify($query); //wrap reserved in span
	?>
	<code><?php echo $prettyCode;?><span class='sql-reserved'>;</span></code>
	... we are given the below table, with <?php echo count($results); ?> rows.
	<div class='table-wrap-x'>
	<div class='table-wrap-y'> <!-- this may seem insane, but need for sensical scrollbars on the table. -->
	<div class='table special'>
		<div class='table-row'>
		 <?php 
		foreach (array_keys($results[0]) as $key):?>
			<div class='table-cell table-label'><?php echo preg_replace('/^[^A-Z]+/','',$key); ?></div>
		<?php endforeach; ?>
		</div>
	<?php foreach ($results as $row){?>
		<div class='table-row'>	
		<?php
		foreach($row as $value):
			if (isset($value)){ ?>
				<div class='table-cell'><?php echo $value;?></div>
		<?php } endforeach; ?>
		</div>
	<?php } ?>
	</div>
	</div>
	</div>
</p>
<?php else: ?>
<p>This value is not whitelisted.</p>
<?php endif; ?>
</main>
<?php include('sidebar-right.php'); ?>
</body>
</html>
