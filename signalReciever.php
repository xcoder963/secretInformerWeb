<?php
	
	include_once "dbHelper.php";

	$returnVal = NULL;
	$dbHelper = new DBHelper();
	$signalType = $_POST["actionType"];

	switch ($signalType) {
		case "login":
			$email = $_POST["email"];
			$password = $_POST["password"];
			$returnVal = $dbHelper->loginClient($email, $password);
			break;
		case "register":
			$name = $_POST["name"];
			$email = $_POST["email"];
			$phno = $_POST["phno"];
			$password = $_POST["password"];
			$returnVal = $dbHelper->registerClient($name, $email, $phno, $password);
			break;
		case "submitComplain":
			//will take other things later
			$email = $_POST["email"];
			$issue = $_POST["complain"];
			$returnVal = $dbHelper->registerIssue($email, $issue);
			break;
	}

	//will return the result back to the app
	echo "" . $returnVal . "";
?>
