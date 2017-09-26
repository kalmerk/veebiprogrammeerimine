<?php
	require("../../../config.php");
	$loginEmail = "";
	
	$signupFirstName = "";
	$signupFamilyName = "";
	$signupEmail = "";
	$gender = "";
	$signupBirthDay = null;
	$signupBirthMonth = null;
	$signupBirthYear = null;
	$signupBirthDate = null;
	
	$signupFirstNameError = "";
	$signupFamilyNameError = "";
	$signupBirthDayError = "";
	$signupGenderError = "";
	$signupEmailError = "";
	$signupPasswordError = "";
	
	//kas on kasutajanimi sisestatud
	if (isset ($_POST["loginEmail"]))
	{
		if (empty ($_POST["loginEmail"]))
		{
			$loginEmailError ="NB! Ilma selleta ei saa sisse logida!";
		} 
		else 
		{
			$loginEmail = $_POST["loginEmail"];
		}
	}
	//kontrollime, kas kirjutati eesnimi
	if (isset ($_POST["signupFirstName"]))
	{
		if (empty ($_POST["signupFirstName"]))
		{
			$signupFirstNameError ="NB! Väli on kohustuslik!";
			//echo $signupFirstNameError;
		} 
		else 
		{
			$signupFirstName = $_POST["signupFirstName"];
		}
	}
	//kontrollime, kas kirjutati perekonnanimi
	if (isset ($_POST["signupFamilyName"]))
	{
		if (empty ($_POST["signupFamilyName"]))
		{
			$signupFamilyNameError ="NB! Väli on kohustuslik!";
		} 
		else 
		{
			$signupFamilyName = $_POST["signupFamilyName"];
		}
	}
	//kas on sünnikuupäev määratud	
	if (isset ($_POST["signupBirthDay"]))
	{
		$signupBirthDay = $_POST["signupBirthDay"];
		//echo $signupBirthDay;
	}
	//kas kuu määratud
	if(isset($_POST["signupBirthMonth"]))
	{
		$signupBirthMonth = intval($_POST["signupBirthMonth"]);
	}
	if (isset ($_POST["signupBirthYear"]))
	{
		$signupBirthYear = $_POST["signupBirthYear"];
		//echo $signupBirthYear;
	}
	//kontroll, kas kuupäev on õige
	if(isset($_POST["signupBirthDay"]) and isset($_POST["signupBirthMonth"]) and isset ($_POST["signupBirthYear"]))
	{
		if(checkdate(intval($_POST["signupBirthMonth"]), intval($_POST["signupBirthDay"]), intval($_POST["signupBirthYear"])))
		{
			$birthDate = date_create($_POST["signupBirthMonth"] ."/" .$_POST["signupBirthDay"]. "/" .$_POST["signupBirthYear"]);
			$signupBirthDate = date_format($birthDate, "Y-m-d");
			echo $signupBirthDate; 
		}
		else
		{
			$signupBirthDayError = "Viga sünnikuupäeva sisestamisel!";
			echo $signupBirthDayError; 
		}	
	}
	//kontrollime, kas kirjutati kasutajanimeks email
	if (isset ($_POST["signupEmail"]))
	{
		if (empty ($_POST["signupEmail"]))
		{
			$signupEmailError ="NB! Väli on kohustuslik!";
		} 
		else 
		{
			$signupEmail = $_POST["signupEmail"];
		}
	}
	
	if (isset ($_POST["signupPassword"]))
	{
		if (empty ($_POST["signupPassword"]))
		{
			$signupPasswordError = "NB! Väli on kohustuslik!";
		} 
		else 
		{
			if (strlen($_POST["signupPassword"]) < 8)
			{
				$signupPasswordError = "NB! Liiga lühike salasõna, vaja vähemalt 8 tähemärki!";
			}
		}
	}
	
	if (isset($_POST["gender"]) && !empty($_POST["gender"]))
	{ //kui on määratud ja pole tühi
		$gender = intval($_POST["gender"]);
		} 
		else 
		{
			$signupGenderError = " (Palun vali sobiv!) Määramata!";
	}
	//uue kasutaja andmebaasi lisamine
	if(empty($signupFirstNameError) and empty($signupFamilyNameError) and empty($signupBirthDayError) and empty($signupGenderError) and empty($signupEmailError) and empty($signupPasswordError) and !empty($signupBirthDate))
	{
		echo "Hakkan kasutajat salvestama!";
		$signupPassword = hash("sha512", $_POST["signupPassword"]);
		//ühendus serveriga
		$database = "if17_kaarkalm_3";
		$mysqli = new mysqli($serverHost, $serverUsername, $serverPassword, $database);
		//käsk serverile
		$stmt = $mysqli->prepare("INSERT INTO vpusers (firstname, lastname, birthday, gender, email, password) VALUES (?, ?, ?, ?, ?, ?)");
		echo $mysqli->error;
		//seome õiged andmed
		//s - string ehk tekst
		//i - integer ehk täisarv
		//d - decimal ehk float
		$stmt->bind_param("sssiss", $signupFirstName, $signupFamilyName, $signupBirthDate, $gender, $signupEmail, $signupPassword);
		//stmt->execute();
		if($stmt->execute())
		{
			echo "Õnnestus!";
		}
		else
		{
			echo "Ebaõnnestus!" . $stmt->error;
		}
		$stmt->close();
		$mysqli->close();
	}
	//tekitame sünnipäeva valiku
	$signupDaySelectHTML = "";
	$signupDaySelectHTML .= '<select name="signupBirthDay">' ."\n";
	$signupDaySelectHTML .= '<option value="" selected disabled>päev</option>' ."\n";
	for ($i = 1; $i < 32; $i ++)
	{
		if($i == $signupBirthDay)
		{
			$signupDaySelectHTML .= '<option value="' .$i .'" selected>' .$i .'</option>' ."\n";
		}
		else 
		{
			$signupDaySelectHTML .= '<option value="' .$i .'">' .$i .'</option>' ." \n";
		}
		
	}
	$signupDaySelectHTML.= "</select> \n";
	//tekitame sünnikuu valiku
	$monthNamesEt = ["jaanuar", "veebruar", "märts", "aprill", "mai", "juuni", "juuli", "august", "september", "oktoober", "november", "detsember"];
	$signupMonthSelectHTML = "";
	$signupMonthSelectHTML .= '<select name="signupBirthMonth">' . "\n";
	$signupMonthSelectHTML .= '<option value="" selected disabled>kuu</option>' . "\n";
	foreach($monthNamesEt as $key=>$month)
	{
		if($key+1 === $signupBirthMonth)
		{
			$signupMonthSelectHTML .= '<option value = "' . ($key + 1) . '" selected>' . $month . '</option> \n';
		}
		else
		{
			$signupMonthSelectHTML .= '<option value = "' . ($key + 1) . '">' . $month . '</option> \n';
		}	
	}
	$signupMonthSelectHTML .= "</select> \n";
	//tekitame sünniaasta valiku
	$signupYearSelectHTML = "";
	$signupYearSelectHTML .= '<select name="signupBirthYear">' ."\n";
	$signupYearSelectHTML .= '<option value="" selected disabled>aasta</option>' ."\n";
	$yearNow = date("Y");
	for ($i = $yearNow; $i > 1900; $i --)
	{
		if($i == $signupBirthYear)
		{
			$signupYearSelectHTML .= '<option value="' .$i .'" selected>' .$i .'</option>' ."\n";
		} 
		else 
		{
			$signupYearSelectHTML .= '<option value="' .$i .'">' .$i .'</option>' ."\n";
		}
		
	}
	$signupYearSelectHTML.= "</select> \n";
?>
<!DOCTYPE html>
<html lang="et">
<head>
	<meta charset="utf-8">
	<title>Sisselogimine või uue kasutaja loomine</title>
</head>
<body>
	<h1>Logi sisse!</h1>
	<p>Siin harjutame sisselogimise funktsionaalsust.</p>
	
	<form method="POST">
		<label>Kasutajanimi (E-post): </label><br>
		<input name="loginEmail" type="email" value="<?php echo $loginEmail; ?>"><br>
		<label>Parool: </label><br>
		<input name="loginPassword" type="password"><br>
		<input type="submit" value="Logi sisse"><br>
	</form>
	
	<h1>Loo kasutaja</h1>
	<p>Kui pole veel kasutajat....</p>
	
	<form method="POST">
		<label>Eesnimi </label><br>
		<input name="signupFirstName" type="text" value="<?php echo $signupFirstName; ?>"><br>
		<span><?php echo $signupFirstNameError; ?></span>
		<br>
		<label>Perekonnanimi </label><br>
		<input name="signupFamilyName" type="text" value="<?php echo $signupFamilyName; ?>"><br>
		<span><?php echo $signupFamilyNameError; ?></span>
		<br>
		<label>Palun määra oma sünnikuupäev</label><br>
		<?php
			echo $signupDaySelectHTML . $signupMonthSelectHTML . $signupYearSelectHTML;
		?>
		<span><?php echo $signupBirthDayError; ?></span>
		<br><br>
		<label>Sugu</label><br><span>
		<input type="radio" name="gender" value="1" <?php if ($gender == '1') {echo 'checked';} ?>><label>Mees</label> <!-- Kõik läbi POST'i on string!!! -->
		<input type="radio" name="gender" value="2" <?php if ($gender == '2') {echo 'checked';} ?>><label>Naine</label><br>
		<span><?php echo $signupGenderError; ?></span>		
		<label>Kasutajanimi (E-post)</label><br>
		<input name="signupEmail" type="email" value="<?php echo $signupEmail; ?>"><br> 
		<span><?php echo $signupEmailError; ?></span>	
		<label>Parool: </label><br>
		<input name="signupPassword" type="password"><br>
		<span><?php echo $signupPasswordError; ?></span>
		<br>		
		<input type="submit" value="Loo kasutaja"><br>
	</form>
		
</body>
</html>