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
<head>
    <title>Petbook</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script
	src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700, 900|Vollkorn:400i" rel="stylesheet">
  

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">

    <link rel="stylesheet" href="css/jquery.fancybox.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">

 

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/style.css">
    
  </head>
    
	<header class="site-navbar js-sticky-header site-navbar-target" role="banner" >

      <div class="container">
        <div class="row align-items-center" style="padding-top: 25px;">
          
          <div class="col-6 col-xl-2">
            <h1 class="mb-0 site-logo"><a href="<?php if($loggedin ==1) { echo 'home.php';} else { echo 'index.php';}?>" class="h2 mb-0"><strong>Pet</strong>Book<span class="text-primary">.</span> </a></h1>
          </div>



        </div>
      </div>
      
    </header>

			

		</div>
	</div>
	
