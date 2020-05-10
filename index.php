<?php
include 'config.php';
include 'header.php';
?>

<script type="text/javascript">
$(document).ready(function () {

    //https://www.nivas.hr/blog/2016/10/29/proper-way-include-facebook-sdk-javascript-jquery/

    $.ajaxSetup({
        cache: true
    });
    $.getScript('https://connect.facebook.net/en_US/sdk.js', function () {
        FB.init({
            appId:  <?php echo $appid; ?> ,
            xfbml : true,
            version : 'v6.0'
        });
 
        });
    });

    function statusChangeCallback(response) {
        console.log(response);
        if (response.status === 'connected') {
            var accessToken = response.authResponse.accessToken;
            var uid = response.authResponse.userID;
            
            $.ajax({

                url: 'fb_login.php',
                type: 'POST',
                data: {
                    accessToken: response.authResponse.accessToken,
                    uid: response.authResponse.userID
                },
                success: function (result) {

                    console.log("Created accesstoken succesfully " + result);
                    window.location.href = 'home.php';

                },
                error: function (result) {
                    console.log('Connected error');
                    console.log(result);
                }

            });

        } else if (response.status === 'not_authorized') {
            console.log("logged into face book but not the app");
        }

    }
   
    function checkLoginState() { // Called when a person is finished with the Login Button.
        FB.getLoginStatus(function (response) { // See the onlogin handler
            statusChangeCallback(response);
        });
    }



</script>
<div class="w3-container" style="max-width: 1400px; margin-top: 80px">
	<div onlogin='checkLoginState()' class="fb-login-button"
		data-size="large" data-button-type="continue_with"
		data-layout="rounded" data-auto-logout-link="false"
		data-use-continue-as="true" data-width=""></div>
	<button class="w3-button w3-round"></button>
</div>
<br>
<?php include 'footer.php'; ?>
