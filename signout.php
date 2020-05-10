

<?php
include 'header.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_destroy();
    header('index.php');
}

?>
<script>function loadSDK() {
    //https://www.nivas.hr/blog/2016/10/29/proper-way-include-facebook-sdk-javascript-jquery/
    $(document).ready(function () {
        $.ajaxSetup({
            cache: true
        });
        $.getScript('https://connect.facebook.net/en_US/sdk.js', function () {
            FB.init({
                appId:  '<?php echo $appid;?>' ,
                xfbml : true,
                version : 'v6.0'
            });
            FB.getLoginStatus(function (response) {
                console.log("User response status is " + response.status);
                if (response.status === 'connected') {

                    var uid = response.authResponse.userID;
                    var accessToken = response.authResponse.accessToken;
                    console.log("Logging out");
                    FB.api('/' + uid + '/permissions', 'delete', function (response) {});
                    window.location.href = 'index.php';
                     <?php
                    session_destroy();
                    header('index.php');
                     ?>
                    console.log("Session destroyed");
                } else if (response.status === 'not_authorized') {
                    console.log("Logged into facebook but not authorised");
                } else {
                    console.log("User isnt logged into facebook");
                }
            });

        });
    });
}

</script>

<div class="w3-container" style="max-width: 1400px; margin-top: 80px">

	<div id="fb-root"></div>



	<button class="logout" id="logout" onclick="loadSDK();"
		class="w3-button  w3-blue w3-round-xxlarge"
		style="height: 20%; width: 30%">Logout</button>

	<br>
	<script async defer crossorigin="anonymous"
		src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v6.0&appId=529847264357591&autoLogAppEvents=1"></script>
	<!-- 	<div class="fb-login-button" onlogin="fetchUserDetail();" -->
	<!-- 		auto_logout_link="true" data-size="large" data-use-continue-as="true" -->
	<!-- 		data-button-type="continue_with" data-layout="default" -->
	<!-- 		data-auto-logout-link="false" data-use-continue-as="false" -->
	<!-- 		data-width=""></div> -->
</div>
<?php include 'footer.php'; ?>
