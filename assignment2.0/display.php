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
</head>
<body>
<section class='sidebar left-sidebar'>
        <?php include '../../filesystem.php'; ?>
</section>
<main>
	<?php 
		if (!empty($_GET)) {
            		$_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
            		foreach ($_GET as $key => $value) {
                		$_GET[$key] = sanitize($value, false);
            		}
        	}
		$whitelisted = false;
		$number = htmlspecialchars($_GET["number"]);
		for($num=1;$num<10;$num++){if(strcmp ('q0'.$num,$number)==0) $whitelisted=true;}
		for($num=10;$num<=12;$num++){if(strcmp ('q'.$num,$number)==0) $whitelisted=true;}
		if($whitelisted):
			$dbUserName = get_current_user() . '_reader';
		        $whichPass = "r"; //flag for which one to use.
	        	$dbName = DATABASE_NAME;
				
			$stmt = $dbConnection->prepare('SELECT * FROM employees WHERE name = ?');
	?>
        <h1>Samuel William Reinhardt</h1>
	<h2>CS148 - Assignment2.0 - <?php echo strtoupper($number); ?> Output </h2>      
        <p> 	
		<code><?php echo file_get_contents('q' . $num . '.sql');?></code>
		<div class='table'>
		<?php //foreach(data-row):?>
			<div class='table-row'>
			<?php //foreach(data-value): ?>
				<div class='table-cell'><?php //echo value; ?></div>
			<?php //endforeach; ?>
			</div>
		<?php //endforeach; ?>
		</div>
        </p>
	<?php else: ?>
	<p>This value is not whitelisted.</p>
	<?php endif; ?>
</main>

<section class='sidebar right-sidebar image-view'></section>
</body>
</html>
