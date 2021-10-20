<?php

	include "dbHelper.php";

	session_start();

	$dbObj = new DBHelper();

	/*if ($_SESSION["status"] !== "active") {
		session_unset();
		header('Location: login.php');
	}*/

	if (isset($_POST["logout"])) {
		session_unset();
		header('Location: login.php');
	}

	$issuesH = $dbObj->getIssues();
?>
<!Doctype html>
<html>
	<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>SECRET INFORMER</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <link rel='stylesheet' type='text/css' href='css/navAndFooter.css' />
    </head>
	<body>
		<form action="?" method="POST">
			<button name="logout">Log Out</button>
		</form>
		<span style="display: block; margin-bottom: 5em;"></span>
        <div class="d-flex justify-content-center align-items-center" style="font-size: 32px; font-weight: bold;">
            <p id="textHere" class="text-center">ISSUES LIVE</p>
        </div>
        <div class="d-flex justify-content-center align-items-center" style="font-size: 32px; font-weight: bold;">
            <hr style="width: 80%;">
        </div>
        <?php 
            $iter = 0;
            while ($iter < count($issuesH)) {
                echo '<div class="d-flex justify-content-center align-items-center" style="font-size: 32px; font-weight: bold;">';
                echo '  <div class="card bg-light shadow-lg px-3 border rounded" style="width: 80%;">';
                echo '      <div class="card-body">';
				echo '			<form action="showIssue.php" method="GET">';
                echo '          <h5 class="card-title">' . $issuesH[$iter][1] . '</h5>';
                echo '          <div id="colap' . $iter . '" class="collapse">';
                echo '              <p class="card-text" style="font-size: 15px;">' . $issuesH[$iter][0] . '</p>';
                echo '          </div>';
                echo '          <button data-toggle="collapse" data-target="#colap' . $iter . '" type="button" class="btn btn-dark mt-3">SEE ALL</button>';
				echo '			<button type="submit" name="showIssue" value="' . $issuesH[$iter][1] . '" class="btn btn-danger mt-3">VIEW</button>';
				echo '			</form>';
                echo '      </div>';
                echo '  </div>';
                echo '</div><br>';
                $iter += 1;
            }
        ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>

	</body>
</html>
