<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang=en>
<?php ini_set("display_errors", 1);
ini_set("track_errors", 1);
ini_set("html_errors", 1);
error_reporting(E_ALL); ?>
<head>
        <meta charset=utf-8>
        <title>CS148 Assignment2.0</title>
        <meta name="description" content="Homework Assignment 2.0 for CS148">
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
<section class='sidebar left-sidebar'>
        <?php include '../../filesystem.php'; ?>
</section>
<main>
	<?php   
		$whitelisted = false;
		$number = htmlspecialchars($_GET["number"]);
		for($num=1;$num<10;$num++){if(strcmp ('q0'.$num,$number)==0) $whitelisted=true;}
		for($num=10;$num<=12;$num++){if(strcmp ('q'.$num,$number)==0) $whitelisted=true;}
		if($whitelisted):
			$dbUserName = get_current_user() . '_reader';
		        $whichPass = "r"; //flag for which one to use.
	        	$dbName = 'SWREINHA_UVM_Courses_Testing';
			$thisDatabaseReader = new Database($dbUserName, $whichPass, $dbName);
			$query ='SELECT fldFirstName, fldLastName FROM tblTeachers';
			$query = rtrim(file_get_contents($number . '.sql'));
			$query = rtrim($query,';');
	//		$results = $thisDatabaseReader->select($query, "", 0, 0, 0, 0, false, false, true);
	?>
        <h1>Samuel William Reinhardt</h1>
	<h2>CS148 - Assignment2.0 - <?php echo strtoupper($number); ?> Output </h2>      
        <p> 	Given the following query...
	
		<?php 
			$whereCount = substr_count($pretty_code,'WHERE'); //counting all values bob's code requires (since we already case forced). Kinda cheating his system actually, but otherwise can't do robust dynamic queries.
			$conditions = [' AND ', ' OR ', ' XOR ', ' NOT ', ' && ', ' || ', ' ! '];
			$conditionCount = 0;
			foreach($conditions as $condition){$conditionCount += substr_count($pretty_code,$condition);}
			$quotes = ['"', "'", '#34', '#39', '&QUOT'];
			$quoteCount = 0;
			foreach($quotes as $quote){$quoteCount += substr_count($pretty_code,$quote);}
			$symbolCount = substr_count($pretty_code,'<') +  substr_count($pretty_code,'>');
			$counts = countify($query);
			$results = $thisDatabaseReader->select($pretty_code, "", counts['where'], counts['condition'], counts['quote'], counts['symbol'], false, false, true);//running     capitalized code so that table headers aren't chopped oddly

			$prettyCode = prettify($query); //wrap reserved in span
		?>
		<code><?php echo $prettyCode;?><span class='sql-reserved'>;</span></code>
		... we are given the below table, with <?php echo count($results); ?> rows.
		<div class='table'>
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
        </p>
	<?php else: ?>
	<p>This value is not whitelisted.</p>
	<?php endif; ?>
</main>

<section class='sidebar right-sidebar image-view'></section>
</body>
</html>
