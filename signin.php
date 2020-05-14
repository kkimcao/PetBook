<script>
    function fetchUserDetail()
    {
        FB.api('/me', function(response) {
                alert("Name: "+ response.name );
            });
    }
</script>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous"
	src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v6.0&appId=529847264357591&autoLogAppEvents=1"></script>
<div class="fb-login-button" onlogin="fetchUserDetail();"
	auto_logout_link="true" data-size="large" data-use-continue-as="true"
	data-button-type="continue_with" data-layout="default"
	data-auto-logout-link="false" data-use-continue-as="false"
	data-width=""></div>