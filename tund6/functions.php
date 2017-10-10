<?php
	$database = "if17_kaarkalm_3";
	$userfirstName = "";
	$userlastName = "";
	//alustan sessiooni
	session_start();
	
	//sisselogimise funktsioon
	function signIn($email, $password){
		$notice = "";
		//andmebaasi ühendus
		$mysqli = new mysqli("localhost", "if17", "if17", "if17_kaarkalm_3");
//		$mysqli = new mysqli("127.0.0.1", "root", "", "vpusers");
		$stmt = $mysqli->prepare("SELECT id, firstname, lastname, email, password FROM vpusers WHERE email = ?");
		$stmt->bind_param("s", $email);
		$stmt->bind_result($id, $firstnameFromDb, $lastnameFromDb, $emailFromDb, $passwordFromDb);
		$stmt->execute();
		
		//kontrollin vastavust
		if($stmt->fetch()){
			$hash = hash("sha512", $password);
			if($hash == $passwordFromDb){
				$notice = "Kõik õige! Logisite sisse!";
				
				//määrame sessioonimuutujad
				$_SESSION["userId"] = $id;
				$_SESSION["userEmail"] = $emailFromDb;
				$_SESSION["userFirstName"] = $firstnameFromDb;
				$_SESSION["userLastName"] = $lastnameFromDb;
				//liigume pealehele
				header("Location: main.php");
				exit();
			} else {
				$notice = "Vale salasõna!";
			}
		} else {
			$notice = "Sellist kasutajat (" .$email .") ei leitud!";
		}
		$stmt->close();
		$mysqli->close();
		return $notice; 
	}
	function createTable()
	{
		$_SESSION["table"] = "<p><table><tr><th>Eesnimi</th><th>Perekonnanimi</th><th>Sunnipaev</th><th>Sugu</th><th>Email</th></tr>";
		//andmebaasi ühendus
//		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
//		$mysqli = new mysqli("127.0.0.1", "root", "", "vpusers");
		$mysqli = new mysqli("localhost", "if17", "if17", "if17_kaarkalm_3");
		$stmt = $mysqli->prepare("SELECT firstname, lastname, birthday, gender, email FROM vpusers");
//		$stmt->bind_param("s", $email);
		$stmt->bind_result($firstnameFromDb, $lastnameFromDb, $birthdayFromDb, $genderFromDb, $emailFromDb);
		$stmt->execute();
		
		//kontrollin vastavust
		while($stmt->fetch())
		{
			if($genderFromDb == 1)
			{
				$genderFromDb = "Mees";
			}
			else if($genderFromDb == 2)
			{
				$genderFromDb = "Naine";
			}
			$_SESSION["table"] .= "<tr><th>" . $firstnameFromDb . "</th><th>" . $lastnameFromDb . "</th><th>" . $birthdayFromDb . "</th><th>" . $genderFromDb . "</th><th>" . $emailFromDb . "</th></tr>";

		}
		$_SESSION["table"] .= "</table></p>";
		$stmt->close();
		$mysqli->close();
		echo $_SESSION["table"];
	}
	//kasutaja andmebaasi salvestamine
	function signUp($signupFirstName, $signupFamilyName, $signupBirthDate, $gender, $signupEmail, $signupPassword){
		//loome andmebaasiühenduse
		
//		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
//		$mysqli = new mysqli("127.0.0.1", "root", "", "vpusers");
		$mysqli = new mysqli("localhost", "if17", "if17", "if17_kaarkalm_3");
		//valmistame ette käsu andmebaasiserverile
		$stmt = $mysqli->prepare("INSERT INTO vpusers (firstname, lastname, birthday, gender, email, password) VALUES (?, ?, ?, ?, ?, ?)");
		echo $mysqli->error;
		//s - string
		//i - integer
		//d - decimal
		$stmt->bind_param("sssiss", $signupFirstName, $signupFamilyName, $signupBirthDate, $gender, $signupEmail, $signupPassword);
		//$stmt->execute();
		if ($stmt->execute()){
			echo "\n Õnnestus!";
		} else {
			echo "\n Tekkis viga : " .$stmt->error;
		}
		$stmt->close();
		$mysqli->close();
	}
	
	//sisestuse testimise funktsioon
	function test_input($data){
		$data = trim($data);//eemaldab lõpust tühikud, TAB jne
		$data = stripcslashes($data);//eemaldab "\"
		$data = htmlspecialchars($data); //eemaldab keelatud märgid
		return $data;
	}
	
	/*$x = 4;
	$y = 9;
	echo "Esimene summa on: " .($x + $y);
	addValues();
	
	function addValues(){
		echo "Teine summa on: " .($x + $y);
		echo "Kolmas summa on: " .($GLOBALS["x"] + $GLOBALS["y"]);
		$a = 1;
		$b = 2;
		echo "Neljas summa on: " .($a + $b);
	}
	echo "Viies summa on: " .($a + $b);*/
?>