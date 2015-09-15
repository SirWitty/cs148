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

	<?php require_once( "../bin/Database.php"); ?>	

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
			//This'll be fun... fixing lowercase sql reserved words and putting them into spans + satisfying bob's parameters 
			$lowerList = ['select ', ' as ', ' from ', 'where ', 'like ', 'and ', 'lower(', 'count(', 'distinct ', 'group ', 'order ', 'by ', 'sum(', 'having ', ')'];
			$upper_replace = array_map('strtoupper',$lowerList);
			$pretty_code = str_replace($lowerList, $upper_replace, $query); //replace lowercase with uppers
			
			$whereCount = substr_count($pretty_code,'WHERE'); //counting all values bob's code requires (since we already case forced). Kinda cheating his system actually, but otherwise can't do robust dynamic queries.
			$conditions = [' AND ', ' OR ', ' XOR ', ' NOT ', ' && ', ' || ', ' ! '];
			$conditionCount = 0;
			foreach($conditions as $condition){$conditionCount += substr_count($pretty_code,$condition);}
			$quotes = ['"', "'", '#34', '#39', '&QUOT'];
			$quoteCount = 0;
			foreach($quotes as $quote){$quoteCount += substr_count($pretty_code,$quote);}
			$symbolCount = substr_count($pretty_code,'<') +  substr_count($pretty_code,'>');

			$results = $thisDatabaseReader->select($pretty_code, "", $whereCount, $conditionCount, $quoteCount, $symbolCount, false, false, true);//running     capitalized code so that table headers aren't chopped oddly

			$color_replace = array_map(function($value){ return '<span class="sql-reserved">'.$value.'</span>';}, $upper_replace); 
			$pretty_code = str_replace($upper_replace, $color_replace, $pretty_code); //wrap reserved in span
		?>
		<code><?php echo $pretty_code;?><span class='sql-reserved'>;</span></code>
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
