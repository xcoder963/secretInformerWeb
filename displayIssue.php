<?php
	
	include "dbHelper.php";

	$infoNeeded = NULL;
	$dbObj = new DBHelper();

	if (isset($_POST["logout"])) {
		session_unset();
		header('Location: login.php');
	}

	if (isset($_GET["showIssue"])) {
		$infoNeeded = $dbObj->getIssueInfo($_GET["showIssue"]);
		//echo $_GET["showIssue"];
	}/* else {
		header('Location: login.php');
	}*/
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
		<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ==" crossorigin=""/>
        <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js" integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw==" crossorigin=""></script>
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
			//print_r($infoNeeded);
			//echo $infoNeeded[4];
			$locations = explode(",", $infoNeeded[4]);
			//print_r($locations);
			echo '<p>Name:- ' . $infoNeeded[0] . '</p>';
			echo '<p>Phone No:- ' . $infoNeeded[1] . '</p>';
			echo '<p>Email:- ' . $infoNeeded[2] . '</p>';
			echo '<p>Issues:- ' . $infoNeeded[3] . '</p>';
			echo '<p>Lat:- ' . $locations[0] . '</p>';
			echo '<p>Longitude:- ' . $locations[1] . '</p>';
		?>
		<!--<div id="googleMap" style="width:100%;height:460px;"></div>-->
		<!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRPy3eSKSGqyD2OXp3oZz4yJiT6GDoi7M&callback=myMap"></script>-->
		<div id="mapDiv" style="width: 800px; height: 500px"></div>
        <script>
            // position we will use later
            var lat = <?php echo $locations[0];?>;
            var lon = <?php echo $locations[1]?>;

            // initialize map
            map = L.map('mapDiv').setView([lat, lon], 13);

            // set map tiles source
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors', 
                maxZoom: 18,
            }).addTo(map);

            // add marker to the map
            marker = L.marker([lat, lon]).addTo(map);
        </script>
	</body>
</html>
