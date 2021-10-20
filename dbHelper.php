<?php
	
	//include_once "deconnect.php";

	class DBHelper {
		public $returnValue = NULL;

		public function __construct() {
			//include "deconnect.php";
		}

		public function loginClient($email, $password) {
			include "deconnect.php";

			$returnValue = "unsuccess";
			$passwordH = sha1($password);
			$sql_login = "select email, password from users where email = '" . $email . "' and password = '" . $passwordH . "'";
			$result = $conn->query($sql_login);
			if ($result->num_rows > 0) {
				$returnValue = "success";
			}
			return $returnValue;
		}

		public function registerClient($name, $email, $phno, $password) {
			include "deconnect.php";

			$returnValue = "unsuccess";
			$sql_register = "insert into users(name, email, phno, password) values(?, ?, ?, ?)";
			$stmt = $conn->prepare($sql_register);
			$passwordH = sha1($password);
			$stmt->bind_param("ssss", $name, $email, $phno, $passwordH);
			if ($stmt->execute()) {
				$returnValue = "success";
			}
			return $returnValue;
		}

		public function registerIssue($email, $issue) {
			include "deconnect.php";

			$returnValue = "unsuccess";
			$sql_issue = "insert into complains(complain, email) values(?, ?)";
			$stmt = $conn->prepare($sql_issue);
			$stmt->bind_param("ss", $issue, $email);
			if ($stmt->execute()) {
				$returnValue = "success";
			}
			return $returnValue;
		}

		public function loginMaintainer($email, $password) {
			include "deconnect.php";

			$passwordH = sha1($password);
			$sql_login = "select email, password from maintainers where email = '" . $email . "' and password = '" . $passwordH . "'";
			$result = $conn->query($sql_login);
			return ($result->num_rows > 0);
		}

		public function getIssues() {
			include "deconnect.php";

			$returnValue = array();
			$sql = "select complain, email from complains;";
			$result = $conn->query($sql);
			
			if ($result->num_rows > 0) {
				while ($rows = $result->fetch_assoc()) {
					array_push($returnValue, array($rows["complain"], $rows["email"]));
				}
			}

			return $returnValue;
		}
	}	
?>
