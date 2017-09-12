<?php
	//see on kommentaar, järgmisena paar muutujad
	$myName = "Kalmer";
	$myFamilyName = "Kaarjas";
	//vaatame, mis kell on ja määrame päeva osa
	$hourNow = date("H");
//	echo $hourNow;
	$partOfDay = "";
	if($hourNow < 8)
	{
		$partOfDay = "varajane hommik";
	}
	if($hourNow >= 8 and $hourNow < 16)
	{
		$partOfDay = "koolipäev";
	}
	if($hourNow >= 16)
	{
		$partOfDay = "vaba aeg";
	}		
//	echo $partOfDay;

//vaatame, kaua koolipäeva lõpuni aega jäänud
	$timeNow = strtotime(date("d.m.Y H:i:s"));
//	echo $timeNow;
	$schoolDayEnd = strtotime(date("d.m.Y"." "."15:45"));
//	echo $schoolDayEnd;
	$toTheEnd = $schoolDayEnd - $timeNow;
	echo (round($toTheEnd / 60));
?>

<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <title>Kalmer Kaarjas veebiprogrammeerimine</title>
</head>
<body>
    <h1>
		<?php
			echo $myName ." " .$myFamilyName;
		?>
	veebiprogrammeerimine</h1>
		<p>See leht on loodud õppetöö raames ning ei sisalda mingit tõsiseltvõetavat sisu.</p>
    <h2>Informatsioon</h2>
        <p>Esimene info.</p>
        <p>Teine info.</p>
        <p>Kolmas info.</p>
	<?php
		echo "<p>See on esimene jupp PHP abil väljastatud tektsti!</p>";
		echo "<p>Täna on ";
		echo date("d.m.Y"),", kell lehe avamisel oli " .date("H.i.s");
		echo ", käes on ".$partOfDay.".</p>";
//		echo "<p>Koolipäeva lõpuni on".(round($toTheEnd / 60))." ""minutit"."</p>";
	?>
</body>
</html>
