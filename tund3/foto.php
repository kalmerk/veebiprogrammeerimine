<?php
	$picsDir = "../../pics/";
	$picFileTypes = ["jpg", "jpeg", "png", "gif"];
	$picFiles = [];
	$allFiles = array_slice(scandir($picsDir), 2);
	foreach($allFiles as $file) 
	{
		$fileType =  pathinfo($file, PATHINFO_EXTENSION);
		if(in_array($fileType, $picFileTypes) == true)
		{
			array_push($picFiles, $file);
		}
	}
//	$picFiles = array_slice($allFiles, 2);
	$picCount = count($picFiles);
	$picNum = mt_rand(0, ($picCount -1));
	$picFile = $picFiles[$picNum];
//	var_dump($picFiles);
?>

<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <title>Kalmer Kaarjas veebiprogrammeerimine</title>
		<style>
			a:hover 
			{
				color:green;
			}	
		</style>
</head>
<body>
    <h1>Foto</h1>
	<hr>
		<p>See leht on loodud õppetöö raames ning ei sisalda mingit tõsiseltvõetavat sisu.</p>
		<img src="<?php echo $picsDir . $picFile; ?>" alt="Tallinna Ülikool">
	<hr>
</body>
</html>
