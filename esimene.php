<?php
	//see on kommentaar, järgmisena paar muutujad
	$myName = "Kalmer";
	$myFamilyName = "Kaarjas";
	
	$monthNamesEt = ["jaanuar", "veebruar", "märts", "aprill", "mai", "juuni", "juuli", "august", "september", "oktoober", "november", "detsember"];
	
//	var_dump($monthNamesEt);
//	echo($monthNamesEt[11]);
	$monthNow = $monthNamesEt[date("n")-1];
//	echo($monthNow);
//	vaatame, mis kell on ja määrame päeva osa
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

//	vaatame, kaua koolipäeva lõpuni aega jäänud
	$timeNow = strtotime(date("d.m.Y H:i:s"));
//	echo $timeNow;
	$schoolDayEnd = strtotime(date("d.m.Y"." "."15:45"));
//	echo $schoolDayEnd;
	$toTheEnd = $schoolDayEnd - $timeNow;
//	echo (round($toTheEnd / 60));

//	tegeleme vanusega
	$myBirthYear;
	$ageNotice = "";
//	var_dump($_POST);
	if(isset($_POST["birthYear"]))
	{
		$myBirthYear = $_POST["birthYear"];
		$myAge = date("Y") - $_POST["birthYear"];
//		echo $myAge;
		$ageNotice = "<p>Teie vanus on ligikaudu " . $myAge . " aastat.</p>";
		
		$ageNotice .= "<p>Olete elanud järgnevatel aastatel:</p>";
		$ageNotice .= "\n<ul> \n";
		
		$yearNow = date("Y");
		for($i = $myBirthYear; $i <= $yearNow; $i++)
		{
			//echo ("<li>" . $i . "</li>");
			$ageNotice .= "<li>" .$i . "</li>\n";
		}
			$ageNotice .= "</ul>\n";		
	}
	//teeme tsükli
/*	for($i = 0; $i < 50; $i++)
	{
		echo "ha";
	}*/	
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
		veebiprogrammeerimine
	</h1>
		<p>See leht on loodud õppetöö raames ning ei sisalda mingit tõsiseltvõetavat sisu.</p>
	<?php
		echo "<p>See on esimene jupp PHP abil väljastatud tektsti!</p>";
		echo "<p>Täna on ";
		echo date("d. ") . $monthNow . date(" Y"),", kell lehe avamisel oli " .date("H.i.s");
		echo ", käes on ".$partOfDay.".</p>";
	?>
	
	<h2>Natuke aastaarvudest</h2>
	<form method="POST">
		<label>Teie sünniaasta:</label>
		<input type="number" name="birthYear" min="1900" max="2017" value="<?php echo $myBirthYear; ?>">
		<input type="submit" name="submitBirthYear" value="Kinnita">
	</form>
	<?php
		if($ageNotice != "")
		{
			echo ($ageNotice);
		}
	?>
</body>
</html>
