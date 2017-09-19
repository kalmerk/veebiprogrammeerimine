<?php
	$picsDir = "../../pics/";
	$picFiles = [];
	$allFiles = scandir($picsDir);;
	$picFiles = array_slice($allFiles, 2);
	$picCount = count($picFiles);
	$picNum = mt_rand(0, ($picCount -1));
	$picFile = $picFiles[$picNum];
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
