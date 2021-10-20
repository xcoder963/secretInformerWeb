<?php
	//include "deconnect.php";
	include "dbHelper.php";

	$dbObject = new DBHelper(); 

	if (isset($_POST["login"])) {
		if ($dbObject->loginMaintainer($_POST["email"], $_POST["password"])) {
			$_SESSION["email"] = $_POST["email"];
			$_SESSION["status"] = "active";
			header('Location: dashboard.php');
		}
	}
?>
<!Doctype html>
<html>
	<head>
	</head>
	<body>
		<form action="?" method="POST">
			<input type="email" name="email" placeholder="Enter your email:-" />
			<input type="password" name="password" placeholder="Enter your password:-" />
			<button name="login">Login</button>
		</form>
	</body>
</html>
