<?php
include 'config.php';
if (! isset($_SESSION)) {
    session_start();
}

$loggedin = 0;
if (isset($_SESSION['access_token'])) {
    $uid = $_SESSION['uid'];
    $accesstoken = $_SESSION['access_token'];
    $loggedin = 1;
    echo ("<script>console.log('Logged in, accesstoken is: " . $accesstoken . "');</script>");
    echo ("<script>console.log('User id is: " . $uid . "');</script>");
    // echo("<script> FB.getLoginStatus(function(response) { console.log(\"User response status is \"+ response.status);});</script>");
} else {
    echo ("<script>console.log('Logged out');</script>");
    $loggedin = 0;
}

?>

<!DOCTYPE html>
<html>
<title>Petbook</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet"
	href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
<link rel='stylesheet'
	href='https://fonts.googleapis.com/css?family=Open+Sans'>
<link rel="stylesheet"
	href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!--Facebook api-->
<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<style>
html, body, h1, h2, h3, h4, h5 {
	font-family: "Open Sans", sans-serif
}
</style>
<body class="w3-theme-l5">


	<div style="margin-bottom: 30px;" class="w3-top">
		<div style="margin-bottom: 30px height:30px"
			class="w3-bar w3-theme-d2 w3-left-align w3-large">

			<a
				href="<?php if($loggedin ==1) { echo 'home.php';} else { echo 'index.php';}?>"
				class="w3-bar-item w3-button w3-padding-large w3-theme-d4"><i
				class="w3-margin-right"></i><i class="fa fa-home w3-margin-right"></i>PetBook</a>


			<a href="profile.php"
				class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white"
				title="View profile">Profile <i class="fa fa-user"></i></a> 
			

			<a href="#"
				class="w3-bar-item w3-button w3-hide-small w3-right w3-padding-large w3-hover-white"
				title="My Account"> </a> 
				<a
				class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white"
				id="events" href="events.php">Events</a> <a
				class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white"
				href="signup.php">Register dog </a>
				<a
				class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white"
				id="signin" href="signout.php">Sign out</a> 

<?php

if (isset($_SESSION['user_name'])) {
    echo "<div class='w3-right' id=\"status\">logged in as ".$_SESSION['user_name']."</div>";
} else {
    echo "<div class='w3-right' id=\"status\">not logged in</div>";
}

?>
			

		</div>
	</div>