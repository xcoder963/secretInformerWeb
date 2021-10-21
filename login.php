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
		<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
	</head>
	<body>
		<div class="container p-5">
            	<div class="col bg-light shadow-lg border rounded py-3">
                 	<h2 class="text-center" style="color: #F94552;">Login</h2><br>
                    <form action="?" method="POST">
                    <div class="form-group">
                    	<label for="_email">Email</label>
                        <input type="text" name="email" id="_email" class="form-control" placeholder="Email" required>
                     </div>
                     <div class="form-group">
                     	<label for="_pass">Password</label>
                        <input type="password" name="password" id="_pass" class="form-control" placeholder="Password" required>
                     </div>
                     <div class="d-flex justify-content-center align-items-center" style="font-size: 27px; font-weight: bold;">
                      	<button type="submit" name="login" class="btn btn-danger mt-3">Login</button>
                     </div>
        			</form>
				</div>
			</div>
	</body>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
</html>


