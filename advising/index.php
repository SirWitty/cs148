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
	if(isset($_GET['limit']) && ctype_digit(strval($_GET['limit'])))
		$limit = $_GET['limit'];
	else
		$limit = 10;
	if(isset($_GET['startRecord']) && ctype_digit(strval($_GET['startRecord'])))
	 	$offset = $_GET['startRecord'];
        else
                $offset = 0;
		
	for($num=1;$num<=6;$num++){if(strcmp ('q0'.$num,$number)==0) $whitelisted=true;}
	if($whitelisted):
		$dbUserName = get_current_user() . '_reader';
		$whichPass = "r"; //flag for which one to use.
		$dbName = 'SWREINHA_advising';
		$thisDatabaseReader = new Database($dbUserName, $whichPass, $dbName);
		$query = rtrim(file_get_contents($number . '.sql')); //prepare the query
		$query = rtrim($query,';'); //remove semicolon (alternatively, set allow semi to true in bob's function)
		//$query .= ' '.$offset.', '.$limit;
?>
<h1>Samuel William Reinhardt</h1>
<h2>CS148 - Assignment3.0 - <?php echo strtoupper($number); ?> Output </h2>      
<p> 	Using the following query...

	<?php
		$values = array($offset, $limit); 
		$counts = countify($query);
		$results = $thisDatabaseReader->select($query, $values, $counts['where'], $counts['condition'], $counts['quote'], $counts['symbol'], false, false, true);//running     capitalized code so that table headers aren't chopped oddly if they aren't given aliases
		$prettyCode = prettify($query); //wrap reserved in span
	?>
	<code><?php echo $prettyCode;?><span class='sql-reserved'>;</span></code>
	... we are given the below table, with <?php echo count($results); ?> rows.
	<div class='table-wrap-x'>
	<div class='table-wrap-y'> <!-- this may seem insane, but need for sensical scrollbars on the table. -->
	<table class='table special'>
		<tr class='table-row'>
		 <?php 
		foreach (array_keys($results[0]) as $key):?>
			<th class='table-cell table-label'><?php echo preg_replace('/^[^A-Z]+/','',$key); ?></th>
		<?php endforeach; ?>
		</tr>
	<?php foreach ($results as $row){?>
		<tr class='table-row'>	
		<?php
		foreach($row as $value):
			if (isset($value)){ ?>
				<td class='table-cell'><?php echo $value;?></td>
		<?php } endforeach; ?>
		</tr>
	<?php } ?>
	</table>
	<div class='table-nav'>
		<a href='?limit=<?php echo $limit; ?>&startRecord=<?php echo $offset-$limit; ?>'>Back</a>
		<a href='?limit=<?php echo $limit; ?>&startRecord=<?php echo ($offset+$limit > count($results))?$offset+$limit:count($results); ?>'>Next</a>
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
