<?php
	require("functions.php");
	
	//kas pole sisse loginud
	if(!isset($_SESSION["userId"])){
		header("Location: login.php");
		exit();
	}
	
	//väljalogimine
	if(isset($_GET["logout"])){
		session_destroy();
		header("Location: login.php");
		exit();
	}

	$picsDir = "../../pics/";
	$picFileTypes = ["jpg", "jpeg", "png", "gif"];
	$picFiles = [];
	
	$allFiles = array_slice(scandir($picsDir), 2);
	//var_dump($allFiles);
	foreach ($allFiles as $file){
		$fileType = pathinfo($file, PATHINFO_EXTENSION);
		if (in_array($fileType, $picFileTypes) == true){
			array_push($picFiles, $file);
		}
	}
	
	//$picFiles = array_slice($allFiles, 2);
	//var_dump($picFiles);
	
	$picCount = count($picFiles);
	
	$picNum = mt_rand(0,($picCount -1));
	$picFile = $picFiles[$picNum];
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Veebiprogrammeerimine</title>
</head>
<body>
	<h1><?php echo $_SESSION["userFirstName"] . " " . $_SESSION["userLastName"] ?> </h1>
	<p>See leht on loodud õppetöö raames ning ei sisalda mingit tõsiseltvõetavat sisu.</p>
	<p><a href="?logout=1">Logi välja!</a></p>
	<p><a href="usersinfo.php">Info süsteemi kasutajate kohta.</a></p>
	<img src="<?php echo $picsDir .$picFile; ?>" alt="Tallinna ülikool">
	
</body>
</html>




