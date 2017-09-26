<?php
	$myName = "Kalmer";
	$myFamilyName = "Kaarjas";
	$signupEmail = "";
	$signupPassword = "";
	$loginEmail = "";
	$loginPassword = "";
	$myBirthYear;
	$ageNotice = "";
	if(isset($_POST["signupPassword"]))
	{
		$signupEmail = $_POST["signupEmail"];
		$signupPassword = $_POST["signupPassword"];
		$ageNotice = "<p>REG Email: " . $signupEmail . " Parool: " . $signupPassword . "</p>";
	}
	if(isset($_POST["loginPassword"]))
	{
		$loginEmail = $_POST["loginEmail"];
		$loginPassword = $_POST["loginPassword"];
		$ageNotice = "<p>LOG IN Email: " . $loginEmail . " Parool: " . $loginPassword . "</p>";
	}
/*	if(isset($_POST["login"]))
	{
		if($loginEmail == $signupEmail)
		{
			if($loginPassword == $signupPassword)
			{
				echo ("Töötab");
			}
		}
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
	<h2>Kasutaja registreerimine</h2>
	<form method="POST">
		<label>Teie eesnimi:</label><br>
			<input type="text" name="sigupFirstName"><br>
			<label>Teie perekonnanimi:</label><br>
			<input type="text" name="signupFamilyName"><br>
			Teie sugu:<br>		
			<label>Mees:</label>
			<input type="radio" name="gender" value="1">
			<label>Naine:</label>
			<input type="radio" name="gender" value="2"><br>
			<label>Teie email:</label><br>
			<input type="email" name="signupEmail"><br>
			<label>Teie parool:</label><br>
			<input type="password" name="signupPassword"><br>
			<input type="submit" name="register" value="Registreeri"><br>
	</form>
	<h2>Sisselogimine</h2>
	<form method="POST">
			<label>Sisestage email:</label><br>
			<input type="email" name="loginEmail"><br>
			<label>Sisestage parool:</label><br>
			<input type="password" name="loginPassword"><br>
			<input type="submit" name="login" value="Logi">
	</form>
	<?php
	if($ageNotice != "")
	{
		echo ($ageNotice);
	}
	?>
</body>
</html>
