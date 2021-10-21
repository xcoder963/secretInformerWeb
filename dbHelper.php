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

		public function registerIssue($email, $issue, $lat, $longi) {
			include "deconnect.php";

			$returnValue = "unsuccess";
			$sql_issue = "insert into complains(complain, email, locationFromUser) values(?, ?, ?)";
			$stmt = $conn->prepare($sql_issue);
			$location = $lat . "," . $longi;
			$stmt->bind_param("sss", $issue, $email, $location);
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
			include "encdec.php";

			$returnValue = array();
			$sql = "select id, complain, email from complains;";
			$result = $conn->query($sql);
			
			if ($result->num_rows > 0) {
				while ($rows = $result->fetch_assoc()) {
					array_push($returnValue, array(AesCipher::decrypt($rows["complain"]), $rows["email"], $rows["id"]));
				}
			}

			return $returnValue;
		}

		public function getIssueInfo($values) {
			include "deconnect.php";
			include "encdec.php";
			
			$returnValue = array();

			$valuesH = explode(",", $values);
			
			$sql = "select name, phno from users where email = '" . $valuesH[0] . "';";
			$results = $conn->query($sql);
			
			if ($results->num_rows > 0) {
				//$returnValue = array("das", "dsad", "dsda", "dsad");
				while ($row = $results->fetch_assoc()) {
					array_push($returnValue, $row["name"]);
					array_push($returnValue, $row["phno"]);
					array_push($returnValue, $valuesH[0]);
				}
			}

			$sql = "select complain, locationFromUser from complains where email = '" . $valuesH[0] . "' and id = '" . $valuesH[1] ."';";
			$results = $conn->query($sql);

			if ($results->num_rows > 0) {
				while ($row = $results->fetch_assoc()) {
					array_push($returnValue, AesCipher::decrypt($row["complain"]));
					array_push($returnValue, $row["locationFromUser"]);
				}
			}
			
			return $returnValue;
		}
	}	
?>
